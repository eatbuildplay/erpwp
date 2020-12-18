<?php

/**
 * Plugin Name:     ERP WP
 * Description:     ERP system for WP.
 * Version:         0.0.1
 * Author:          Eat/Build/Play
 * License:         GPL-3.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:     erpwp
 *
 * @package         ERPWP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

namespace ERPWP;

// Define conts.
define('ERPWP_PLUGIN_NAME', 'ERP WP');
define('ERPWP_VERSION', '0.0.1');
define('ERPWP_PATH', plugin_dir_path(__FILE__));
define('ERPWP_URL', plugin_dir_url(__FILE__));

class Plugin {

	public function __construct() {

		$this->loader();

	}

	/*
	 * Init PHP loading
	 */
	public function loader() {

		spl_autoload_register([$this, 'autoload']);

    add_action('init', function() {
      $pt = new \ERPWP\Components\Goals\PostTypeGoal();
      $pt->register();
    });

	}

	public function autoload( $className ) {

		if ( 0 !== strpos( $className, 'ERPWP\\' ) ) {
      return;
    }

    $classNameParts = explode( '\\', $className );

    if( $classNameParts[1] == 'Components' ) {
      $dir = 'components/' . strtolower($classNameParts[2]);
      $className = $classNameParts[3];
    } else {
      $dir = 'lib';
      $className = $classNameParts[1];
    }

		// strip the namespace leaving only the final class name
		$className = str_replace('ERPWP\\', '', $className);
		require( ERPWP_PATH . $dir . '/' . $className . '.php' );

	}

  public static function activation() {

  }

}

// init plugin
new Plugin();

/*
 * Activation and deactivation hooks
 */
register_activation_hook(__FILE__, '\ERPWP\Plugin::activation');
