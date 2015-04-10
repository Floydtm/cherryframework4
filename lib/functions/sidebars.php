<?php
/**
 * Helper functions for working with the WordPress sidebar system. Currently, the framework creates a
 * simple function for registering HTML5-ready sidebars instead of the default WordPress unordered lists.
 *
 * @package    Cherry_Framework
 * @subpackage Functions
 * @author     Cherry Team <support@cherryframework.com>
 * @copyright  Copyright (c) 2012 - 2015, Cherry Team
 * @link       http://www.cherryframework.com/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Wrapper function for WordPress' register_sidebar() function. This function exists so that theme authors
 * can more quickly register sidebars with an HTML5 structure instead of having to write the same code
 * over and over. Theme authors are also expected to pass in the ID, name, and description of the sidebar.
 * This function can handle the rest at that point.
 *
 * @since  4.0.0
 * @param  array   $args
 * @return string  Sidebar ID.
 */
function cherry_register_sidebar( $args ) {

	// Set up some default sidebar arguments.
	$defaults = array(
		'id'            => '',
		'name'          => '',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	);

	/**
	 * Filteras the default sidebar arguments
	 *
	 * @since 4.0.0
	 * @param array $defaults
	 */
	$defaults = apply_filters( 'cherry_sidebar_defaults', $defaults );

	// Parse the arguments.
	$args = wp_parse_args( $args, $defaults );

	/**
	 * Filters the sidebar arguments.
	 *
	 * @since 4.0.0
	 * @param array $args
	 */
	$args = apply_filters( 'cherry_sidebar_args', $args );

	/**
	 * Register the sidebar.
	 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	return register_sidebar( $args );
}