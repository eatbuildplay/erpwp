<?php

namespace ERPWP\Components\Sites;
use \ERPWP\Components\Goals\PostTypeSite;

class SiteController {

  public function __construct() {

    add_action('init', function() {

      $pt = new PostTypeSite();
      $pt->register();

    });

    add_action('wp_ajax_site_save', function() {

      $postId = sanitize_text_field( $_POST['postId'] );
      $dueDate = sanitize_text_field( $_POST['dueDate'] );

      update_post_meta( $postId, 'due_date', $dueDate );

      $response = new \stdClass();
      $response->code = 200;
      wp_send_json_success( $response );

    });

    add_filter( 'page_template', function( $page_template ) {
      if ( is_page( 'sites' ) ) {
        return ERPWP_PATH . 'components/sites/templates/page-sites.php';
      }
      return $page_template;
    });

    add_filter('single_template', function($single) {

      global $post;
      if ( $post->post_type == 'acfg_site' ) {
        return ERPWP_PATH . 'components/sites/templates/single-site.php';
      }

      return $single;

    });

    add_filter('wp_enqueue_scripts', function() {

      wp_enqueue_script(
  	    'erpwp-sites',
  	    ERPWP_URL . 'components/sites/ux/script.js',
  	    array('jquery', 'wp-util'),
  	    time(),
  	    true
  	  );

    });

  }

}
