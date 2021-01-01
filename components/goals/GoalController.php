<?php

namespace ERPWP\Components\Goals;
use \ERPWP\Components\Goals\PostTypeGoal;

class GoalController {

  public function __construct() {

    add_action( 'add_meta_boxes', [$this, 'addMetaboxes'] );
    add_action( 'save_post', [$this, 'saveMeta'], 10, 2 );

    add_action('init', function() {

      $pt = new PostTypeGoal();
      $pt->register();

    });

    add_action('wp_ajax_goal_save', function() {

      $postId = sanitize_text_field( $_POST['postId'] );
      $title = sanitize_text_field( $_POST['title'] );
      $dueDate = sanitize_text_field( $_POST['dueDate'] );

      if( !$postId ) {
        wp_insert_post(
          [
            'post_type' => 'acfg_goal',
            'post_title' => $title,
            'post_status' => 'publish'
          ]
        );
      }

      update_post_meta( $postId, 'due_date', $dueDate );

      $response = new \stdClass();
      $response->code = 200;
      wp_send_json_success( $response );

    });

    add_filter( 'page_template', function( $page_template ) {
      if ( is_page( 'goals' ) ) {
        return ERPWP_PATH . 'components/goals/templates/page-goals.php';
      }
      return $page_template;
    });

    add_filter('single_template', function($single) {

      global $post;
      if ( $post->post_type == 'acfg_goal' ) {
        return ERPWP_PATH . 'components/goals/templates/single-goal.php';
      }

      return $single;

    });

    add_filter('wp_enqueue_scripts', function() {

      wp_enqueue_script(
  	    'erpwp-goals',
  	    ERPWP_URL . 'components/goals/ux/script.js',
  	    array('jquery', 'wp-util'),
  	    time(),
  	    true
  	  );

      wp_enqueue_style(
  	    'erpwp-goals',
  	    ERPWP_URL . 'components/goals/ux/style.css',
  	    [],
  	    time()
  	  );

    });

  }

  public function addMetaboxes() {

    \add_meta_box(
      'erpwp-goal-data',
      'Goal Data',
      [$this, 'renderMetabox'],
      null,
      'advanced',
      'default'
    );

  }

  public function renderMetabox() {

    print wp_nonce_field( basename( __FILE__ ), 'erpwp_goal_nonce' );
    print '<input name="due_date" type="text" />';

  }

  public function saveMeta( $postId, $post ) {

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['erpwp_goal_nonce'] ) || !wp_verify_nonce( $_POST['erpwp_goal_nonce'], basename( __FILE__ ) ) )
      return $post_id;

    $post_type = get_post_type_object( $post->post_type );
    $value = sanitize_html_class( $_POST['due_date'] );
    update_post_meta( $postId, 'due_date', $value );

  }

}
