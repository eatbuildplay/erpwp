<?php

namespace ERPWP\Components\Recruiting;
use \ERPWP\Components\Recruiting\PostTypeRecruit;

class RecruitingController {

  public function __construct() {

    add_action('init', function() {

      $pt = new PostTypeRecruit();
      $pt->register();

    });

    add_action('wp_ajax_recruit_create', function() {

      $firstName = sanitize_text_field( $_POST['firstName'] );
      $lastName = sanitize_text_field( $_POST['lastName'] );


      $postTitle = $firstName . ' ' . $lastName;
      $postId = wp_insert_post([
        'post_type'   => 'acfg_recruit',
        'post_title'  => $postTitle,
        'post_status' => 'publish'
      ]);

      update_post_meta( $postId, 'first_name', $firstName );
      update_post_meta( $postId, 'last_name', $lastName );

      $response = new \stdClass();
      $response->code = 200;
      wp_send_json_success( $response );

    });

    add_action('wp_ajax_recruit_save', function() {

      $postId = sanitize_text_field( $_POST['postId'] );
      $dueDate = sanitize_text_field( $_POST['dueDate'] );

      update_post_meta( $postId, 'due_date', $dueDate );

      $response = new \stdClass();
      $response->code = 200;
      wp_send_json_success( $response );

    });

    add_filter( 'page_template', function( $page_template ) {
      if ( is_page( 'recruits' ) ) {
        return ERPWP_PATH . 'components/recruiting/templates/page-recruits.php';
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
  	    'erpwp-recruiting',
  	    ERPWP_URL . 'components/recruiting/ux/script.js',
  	    array('jquery', 'wp-util'),
  	    time(),
  	    true
  	  );

    });

  }

}
