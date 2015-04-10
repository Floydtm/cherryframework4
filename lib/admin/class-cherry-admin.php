<?php
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

/**
 * Sets up the admin functionality for the framework.
 *
 * @package   Cherry_Framework
 * @version   4.0.0
 * @author    Cherry Team <support@cherryframework.com>
 * @copyright Copyright (c) 2012 - 2015, Cherry Team
 * @link      http://www.cherryframework.com/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

class Cherry_Admin {

	/**
	 * Holds the instances of this class.
	 *
	 * @since 4.0.0
	 * @var   object
	 */
	private static $instance = null;

	/**
	 * Initialize the loading admin scripts & styles. Adding the meta boxes.
	 *
	 * @since 4.0.0
	 */
	public function __construct() {

		// Register admin javascript and stylesheet.
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ), 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_styles' ), 1 );

		// Load admin javascript and stylesheet.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );

		// Load post meta boxes on the post editing screen.
		add_action( 'load-post.php',     array( $this, 'load_post_meta_boxes' ) );
		add_action( 'load-post-new.php', array( $this, 'load_post_meta_boxes' ) );
	}

	/**
	 * Register admin-specific javascript.
	 *
	 * @since 4.0.0
	 */
	public function register_admin_scripts() {
		wp_register_script( 'admin-interface', trailingslashit( CHERRY_URI ) . 'admin/assets/js/admin-interface.js', array( 'jquery' ), CHERRY_VERSION, true );
	}

	/**
	 * Register admin-specific stylesheet.
	 *
	 * @since 4.0.0
	 */
	public function register_admin_styles() {
		wp_register_style( 'admin-interface', trailingslashit( CHERRY_URI ) . 'admin/assets/css/admin-interface.css', array(), CHERRY_VERSION, 'all' );
		wp_register_style( 'cherry-ui-elements', trailingslashit( CHERRY_URI ) . 'admin/assets/css/cherry-ui-elements.css', array(), CHERRY_VERSION, 'all' );
	}

	/**
	 * Enqueue admin-specific javascript.
	 *
	 * @since 4.0.0
	 */
	public function enqueue_admin_scripts( $hook_suffix ) {
		if ( 'toplevel_page_cherry-options' == $hook_suffix ) {
			wp_enqueue_script( 'admin-interface' );
		}
	}

	/**
	 * Enqueue admin-specific stylesheet.
	 *
	 * @since 4.0.0
	 */
	public function enqueue_admin_styles( $hook_suffix ) {
			wp_enqueue_style( 'admin-interface' );
			wp_enqueue_style( 'cherry-ui-elements' );
	}

	/**
	 * Loads custom meta boxes.
	 *
	 * @since 4.0.0
	 */
	public function load_post_meta_boxes() {
		$screen    = get_current_screen();
		$post_type = $screen->post_type;

		if ( !empty( $post_type ) && post_type_supports( $post_type, 'cherry-grid-type' ) ) {
			require_once( trailingslashit( CHERRY_ADMIN ) . 'class-cherry-grid-type.php' );
		}

		if ( !empty( $post_type ) && post_type_supports( $post_type, 'cherry-layouts' ) ) {
			require_once( trailingslashit( CHERRY_ADMIN ) . 'class-cherry-layouts.php' );
		}

		if ( !empty( $post_type ) && post_type_supports( $post_type, 'cherry-post-style' ) ) {
			require_once( trailingslashit( CHERRY_ADMIN ) . 'class-cherry-post-style.php' );
		}
	}

	/**
	 * Returns the instance.
	 *
	 * @since  4.0.0
	 * @return object
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}

Cherry_Admin::get_instance();