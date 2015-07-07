<?php
/**
 * File for registering custom post types.
 *
 * @package    Directory
 * @subpackage Includes
 * @since      1.0.0
 * @author     Marty Helmick <info@martyhelmick.com>
 * @copyright  Copyright (c) 2013 - 2014, Marty Helmick
 * @link       https://github.com/m-e-h/doc-directory
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Employees
add_action('init', 'doc_employees_register_post_types');

// Departments
add_action('init', 'doc_departments_register_post_types');

// Documents
add_action('init', 'doc_documents_register_post_types');




# Register the Employee post type.
function doc_employees_register_post_types() {
    register_extended_post_type('employee', array(

        'enter_title_here' => 'Employee Name',

        # Add some custom columns to the admin screen:
        'admin_cols' => array(
            'featured_image' => array(
                'title'          => 'Profile Pic',
                'featured_image' => 'thumbnail',
            ),
            'published' => array(
                'title'       => 'Published',
                'meta_key'    => 'published_date',
                'date_format' => 'd/m/Y'
            ),
            'my_connection' => array(
                'title'      => 'Department',
                'connection' => 'employees_to_departments',
            ),
        ),
    ));
}




# Register the Department post type.
function doc_departments_register_post_types() {
    register_extended_post_type('department', array(

        'enter_title_here' => 'Department Name',

        # Add some custom columns to the admin screen:
        'admin_cols' => array(
            'featured_image' => array(
                'title'          => 'Dept Image',
                'featured_image' => 'thumbnail'
            ),
            'agency' => array(
                'title'          => 'Agencies',
                'taxonomy' => 'agency'
            ),
        ),

        # Add a dropdown filter to the admin screen:
        'admin_filters' => array(
            'agency' => array(
                'taxonomy' => 'agency'
            ),
        ),

    ));
}




#Register the Document post type.
function doc_documents_register_post_types() {
    register_extended_post_type('document', array(

        'enter_title_here' => 'Document Title',

        # Add some custom columns to the admin screen:
        'admin_cols' => array(
            'published' => array(
                'title'       => 'Published',
                'meta_key'    => 'published_date',
                'date_format' => 'd/m/Y'
            ),
            'my_connection' => array(
                'title'      => 'Owned by',
                'connection' => 'departments_to_documents',
            ),
        ),
    ));
}
