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
// function cmb2_get_post_options( $query_args ) {

//     $args = wp_parse_args( $query_args, array(
//         'post_type' => 'employee',
//     ) );

//     $posts = get_posts( $args );

//     $post_options = array();
//     if ( $posts ) {
//         foreach ( $posts as $post ) {
//                    $post_options[] = array(
//                        'name' => $post->post_title,
//                        'value' => $post->ID
//                    );
//         }
//     }

//     return $post_options;
// }



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


/**
 * Registers connections between employees and departments.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function my_connection_types() {
      // Make sure the Posts 2 Posts plugin is active.
    // if ( !function_exists( 'p2p_register_connection_type' ) )
    //     return;

    p2p_register_connection_type( array(
        'name' => 'employees_to_departments',
        'from' => 'employee',
        'to' => 'department',
        'admin_box' => array(
          'context' => 'advanced'
          ),
        'from_labels' => array(
        'create' => __( 'Add Staff', 'my-textdomain' ),
        ),
        'to_labels' => array(
        'create' => __( 'Add Department', 'my-textdomain' ),
        ),
        'cardinality' => 'many-to-one',
        'title' => array( 'from' => 'Department', 'to' => 'Staff' ),
        'fields' => array(
        'role' => array(
            'title' => 'Role/Title',
            'type' => 'text',
        ),
        'status' => array( 
            'title' => 'Status',
            'type' => 'select',
            'values' => array( 'Active', 'Retired', 'Deceased', 'On Leave' )
        ),
        )
    ) );



}
add_action( 'p2p_init', 'my_connection_types' );



/**
 * Status PUBLISHED on connection creation.
 */
function p2p_published_by_default( $args, $ctype, $post_id ) {
    if ( 'employees_to_departments' == $ctype->name && 'to' == $ctype->get_direction() ) {
        $args['post_status'] = 'publish';
    }

    return $args;
}

add_filter( 'p2p_new_post_args', 'p2p_published_by_default', 10, 3 );