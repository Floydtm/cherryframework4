<?php
/**
 * Dynamic CSS template
 *
 * @package    Cherry_Framework
 * @author     Cherry Team <support@cherryframework.com>
 * @copyright  Copyright (c) 2012 - 2015, Cherry Team
 * @link       http://www.cherryframework.com/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

$cherry_css_vars = cherry_get_css_varaibles();

?>

.cherry-btn-primary {
	background-color: <?php echo cherry_esc_value( $cherry_css_vars, 'color-primary' ); ?>;
	color: <?php echo cherry_contrast_color( cherry_esc_value( $cherry_css_vars, 'color-primary' ) ); ?>;
}
.cherry-btn-primary:hover{
	background-color: <?php echo cherry_esc_value( $cherry_css_vars, 'color-secondary' ); ?>;
}
.cherry-btn-link{
	color: <?php echo cherry_contrast_color( cherry_esc_value( $cherry_css_vars, 'color-primary' ) ); ?>;
}
.cherry-btn-link:hover{
	color: <?php echo cherry_esc_value( $cherry_css_vars, 'color-secondary' ); ?>;
}