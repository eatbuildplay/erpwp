<?php

namespace ERPWP\Components\Goals;
use \ERPWP\Components\Goals\PostTypeGoal;

class GoalController {

  public function __construct() {

    add_action('init', function() {

      $pt = new PostTypeGoal();
      $pt->register();

    });

    add_action('wp_ajax_goal_save', function() {

      $postId = sanitize_text_field( $_POST['postId'] );
      $dueDate = sanitize_text_field( $_POST['dueDate'] );

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

    });

  }

}
