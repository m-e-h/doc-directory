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



add_action('p2p_init', 'emp_to_dept_connection');

add_action('p2p_init', 'dept_to_doc_connection');

//add_filter( 'p2p_new_post_args', 'p2p_published_by_default', 10, 3 );



# Registers connections between employees and departments.
function emp_to_dept_connection() {

      // Make sure the Posts 2 Posts plugin is active.
    // if (!function_exists('p2p_register_connection_type'))
    //     return;

    p2p_register_connection_type(array(
        'name'      => 'employees_to_departments',
        'from'      => 'employee',
        'to'        => 'department',
        'admin_box' => array(
          'context' => 'advanced'
         ),
        'from_labels' => array(
        'create' => __('Add Staff', 'doc-directory'),
        ),
        'to_labels' => array(
        'create' => __('Add Department', 'doc-directory'),
        ),
        'cardinality' => 'one-to-many',
        'title'       => array(
            'from' => 'Staff',
            'to' => 'Department'
            ),
        'fields'      => array(
            'role' => array(
                'title' => 'Role/Title',
                'type'  => 'text',
            ),
            'status' => array(
                'title'  => 'Status',
                'type'   => 'select',
                'values' => array( 'Active', 'Retired', 'Deceased', 'On Leave' )
            ),
        )
    ));
}


function dept_to_doc_connection() {
    p2p_register_connection_type(array(
        'name' => 'departments_to_documents',
        'from' => 'department',
        'to'   => 'document',
    ));
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
