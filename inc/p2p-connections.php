<?php
/**
 * Sets up relational Custom Posts with the Posts to Posts library.
 *
 * @package    Directory
 * @subpackage Includes
 * @since      1.0.0
 * @author     Marty Helmick <justin@martyhelmick.com>
 * @copyright  Copyright (c) 2013 - 2014, Marty Helmick
 * @link       https://github.com/m-e-h/directory
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */



add_action( 'p2p_init', 'my_connection_types' );

add_filter( 'p2p_new_post_args', 'p2p_published_by_default', 10, 3 );



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
        'name' => 'departments_to_employees',
        'from' => 'department',
        'to' => 'employee',
        'admin_box' => array(
          'context' => 'advanced'
          ),
        'from_labels' => array(
        'create' => __( 'Add Department', 'my-textdomain' ),
        ),
        'to_labels' => array(
        'create' => __( 'Add Staff', 'my-textdomain' ),
        ),
        'cardinality' => 'one-to-many',
        'title' => array( 'from' => 'Staff', 'to' => 'Department' ),
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


function dept_to_doc_connection() {
    p2p_register_connection_type( array(
        'name' => 'departments_to_documents',
        'from' => 'department',
        'to' => 'document',
    ) );
}
add_action( 'p2p_init', 'dept_to_doc_connection' );




/**
 * Status PUBLISHED on connection creation.
 */
function p2p_published_by_default( $args, $ctype, $post_id ) {
    if ( 'departments_to_employees' == $ctype->name && 'to' == $ctype->get_direction() ) {
        $args['post_status'] = 'publish';
    }

    return $args;
}


