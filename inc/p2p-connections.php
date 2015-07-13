<?php
/**
 * Sets up relational Custom Posts with the Posts to Posts library.
 *
 * @package    Directory
 * @subpackage Includes
 * @since      1.0.0
 * @author     Marty Helmick <info@martyhelmick.com>
 * @copyright  Copyright (c) 2015, Marty Helmick
 * @link       https://github.com/m-e-h/doc-directory
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */



add_action('p2p_init', 'doc_connections');

//add_filter( 'p2p_new_post_args', 'p2p_published_by_default', 10, 3 );



function doc_connections() {

    if (!function_exists('p2p_register_connection_type'))
        return;

    p2p_register_connection_type(array(
        'name'      => 'employees_to_departments',
        'from'      => 'employee',
        'to'        => 'department',
        'sortable'   => 'any',
        'admin_column' => 'from',
        'admin_dropdown' => 'from',
        'admin_box' => array(
          'context' => 'normal'
         ),
        'from_labels' => array(
        'create' => __('Add Personnel', 'doc-directory'),
        ),
        'to_labels' => array(
        'create' => __('Add Department', 'doc-directory'),
        ),
        'cardinality' => 'many-to-one',
        'title'       => array(
            'from' => 'Department',
            'to' => 'Personnel'
            ),
        'fields'      => array(
            'role' => array(
                'title' => 'Role/Title',
                'type'  => 'text',
                //'default_cb' => 'my_get_blurb',
            ),
        )
    ));

    p2p_register_connection_type(array(
        'name' => 'departments_to_documents',
        'from' => 'department',
        'to'   => 'document',
        'admin_column' => 'to',
        'admin_dropdown' => 'to',
    ));
}


function my_get_blurb( $connection, $direction ) {
    global $post;

    $key = ( 'from' == $direction ) ? 'department' : 'employee';

    $post = get_post( $connection->$key );
    setup_postdata( $post );

    return get_the_excerpt();
}


/**
 * Status PUBLISHED on connection creation.
 */
// function p2p_published_by_default( $args, $ctype, $post_id ) {
//     if ( 'departments_to_employees' == $ctype->name && 'to' == $ctype->get_direction() ) {
//         $args['post_status'] = 'publish';
//     }
//
//     return $args;
// }
