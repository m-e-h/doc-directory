<?php
/**
 * Core functions file for the plugin.  This file sets up default actions/filters and defines other functions 
 * needed within the plugin.
 *
 * @package    Directory
 * @subpackage Includes
 * @since      1.0.0
 * @author     Marty Helmick <justin@martyhelmick.com>
 * @copyright  Copyright (c) 2013 - 2014, Marty Helmick
 * @link       https://github.com/m-e-h/directory
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Add custom image sizes (for menu listing in admin). */
add_action( 'init', 'doc_add_image_sizes' );


/**
 * Gets a number of posts and displays them as options
 * @param  array $query_args Optional. Overrides defaults.
 * @return array             An array of options that matches the CMB options array
 */
function cmb2_get_post_options( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type' => 'employee',
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
                   $post_options[] = array(
                       'name' => $post->post_title,
                       'value' => $post->ID
                   );
        }
    }

    return $post_options;
}



/**
 * Adds a custom image size for viewing in the admin edit posts screen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function doc_add_image_sizes() {
	add_image_size( 'directory-thumbnail', 100, 75, true );
}

function my_connection_types() {
    p2p_register_connection_type( array(
        'name' => 'employees_to_departments',
        'from' => 'employee',
        'to' => 'department'
    ) );
}
add_action( 'p2p_init', 'my_connection_types' );