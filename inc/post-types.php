<?php
/**
 * File for registering custom post types.
 *
 * @package    Directory
 * @subpackage Includes
 * @since      1.0.0
 * @author     Marty Helmick <justin@martyhelmick.com>
 * @copyright  Copyright (c) 2013 - 2014, Marty Helmick
 * @link       https://github.com/m-e-h/directory
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Register custom post types on the 'init' hook. */
add_action( 'init', 'doc_employees_register_post_types' );
add_action( 'init', 'doc_departments_register_post_types' );
add_action( 'init', 'doc_documents_register_post_types' );

/* Filter post updated messages for custom post types. */
//add_filter( 'post_updated_messages', 'doc_post_updated_messages' );

/* Filter the "enter title here" text. */
add_filter( 'enter_title_here', 'doc_enter_title_here', 10, 2 );

/**
 * Registers post types needed by the plugin.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function doc_employees_register_post_types() {

    /* Register the Employee post type. */

    register_post_type(
        'employee',
        array(
            'description'         => '',
            'public'              => true,
            'publicly_queryable'  => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-id',
            'can_export'          => true,
            'delete_with_user'    => false,
            'hierarchical'        => false,
            'has_archive'         => 'employees',
            'query_var'           => 'employee',
            'capability_type'     => 'page',
            'map_meta_cap'        => true,

            /* Capabilities. */
            // 'capabilities' => array(

            //     // meta caps (don't assign these to roles)
            //     'edit_post'              => 'edit_employee',
            //     'read_post'              => 'read_employee',
            //     'delete_post'            => 'delete_employee',

            //     // primitive/meta caps
            //     'create_posts'           => 'create_employees',

            //     // primitive caps used outside of map_meta_cap()
            //     'edit_posts'             => 'edit_employees',
            //     'edit_others_posts'      => 'manage_employees',
            //     'publish_posts'          => 'manage_employees',
            //     'read_private_posts'     => 'read',

            //     // primitive caps used inside of map_meta_cap()
            //     'read'                   => 'read',
            //     'delete_posts'           => 'manage_employees',
            //     'delete_private_posts'   => 'manage_employees',
            //     'delete_published_posts' => 'manage_employees',
            //     'delete_others_posts'    => 'manage_employees',
            //     'edit_private_posts'     => 'edit_employees',
            //     'edit_published_posts'   => 'edit_employees'
            // ),

            /* The rewrite handles the URL structure. */
            'rewrite' => array(
                'slug'       => 'employees',
                'with_front' => false,
                'pages'      => true,
                'feeds'      => true,
                'ep_mask'    => EP_PERMALINK,
            ),

            /* What features the post type supports. */
            'supports' => array(
                'title',
                'editor',
                'author',
                'thumbnail'
            ),

            /* Taxonomies of the post type. */
            // 'taxonomies'  => array( 
            //     'department' 
            // ),

            /* Labels used when displaying the posts. */
            'labels' => array(
                'name'               => __( 'Employees',                   'hybrid-base' ),
                'singular_name'      => __( 'Employee',                    'hybrid-base' ),
                'menu_name'          => __( 'Employees',                   'hybrid-base' ),
                'name_admin_bar'     => __( 'Employee',                    'hybrid-base' ),
                'add_new'            => __( 'Add New',                     'hybrid-base' ),
                'add_new_item'       => __( 'Add New Employee',            'hybrid-base' ),
                'edit_item'          => __( 'Edit Employee',               'hybrid-base' ),
                'new_item'           => __( 'New Employee',                'hybrid-base' ),
                'view_item'          => __( 'View Employee',               'hybrid-base' ),
                'search_items'       => __( 'Search Employees',            'hybrid-base' ),
                'not_found'          => __( 'No employees found',          'hybrid-base' ),
                'not_found_in_trash' => __( 'No employees found in trash', 'hybrid-base' ),
                'all_items'          => __( 'Employees',                   'hybrid-base' ),
            )
        )
    );
}

function doc_departments_register_post_types() {

    /* Register the Department post type. */

    register_post_type(
        'department',
        array(
            'description'         => '',
            'public'              => true,
            'publicly_queryable'  => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-groups',
            'can_export'          => true,
            'delete_with_user'    => false,
            'hierarchical'        => false,
            'has_archive'         => 'departments',
            'query_var'           => 'department',
            'capability_type'     => 'page',
            'map_meta_cap'        => true,

            /* Capabilities. */
            // 'capabilities' => array(

            //     // meta caps (don't assign these to roles)
            //     'edit_post'              => 'edit_department',
            //     'read_post'              => 'read_department',
            //     'delete_post'            => 'delete_department',

            //     // primitive/meta caps
            //     'create_posts'           => 'create_departments',

            //     // primitive caps used outside of map_meta_cap()
            //     'edit_posts'             => 'edit_departments',
            //     'edit_others_posts'      => 'manage_departments',
            //     'publish_posts'          => 'manage_departments',
            //     'read_private_posts'     => 'read',

            //     // primitive caps used inside of map_meta_cap()
            //     'read'                   => 'read',
            //     'delete_posts'           => 'manage_departments',
            //     'delete_private_posts'   => 'manage_departments',
            //     'delete_published_posts' => 'manage_departments',
            //     'delete_others_posts'    => 'manage_departments',
            //     'edit_private_posts'     => 'edit_departments',
            //     'edit_published_posts'   => 'edit_departments'
            // ),

            /* The rewrite handles the URL structure. */
            'rewrite' => array(
                'slug'       => 'departments',
                'with_front' => false,
                'pages'      => true,
                'feeds'      => true,
                'ep_mask'    => EP_PERMALINK,
            ),

            /* What features the post type supports. */
            'supports' => array(
                'title',
                'editor',
                'author',
                'thumbnail'
            ),

            /* Taxonomies of the post type. */
            'taxonomies'  => array( 
                'agency' 
            ),

            /* Labels used when displaying the posts. */
            'labels' => array(
                'name'               => __( 'Departments',                   'hybrid-base' ),
                'singular_name'      => __( 'Department',                    'hybrid-base' ),
                'menu_name'          => __( 'Departments',                   'hybrid-base' ),
                'name_admin_bar'     => __( 'Department',                    'hybrid-base' ),
                'add_new'            => __( 'Add New',                     'hybrid-base' ),
                'add_new_item'       => __( 'Add New Department',            'hybrid-base' ),
                'edit_item'          => __( 'Edit Department',               'hybrid-base' ),
                'new_item'           => __( 'New Department',                'hybrid-base' ),
                'view_item'          => __( 'View Department',               'hybrid-base' ),
                'search_items'       => __( 'Search Departments',            'hybrid-base' ),
                'not_found'          => __( 'No departments found',          'hybrid-base' ),
                'not_found_in_trash' => __( 'No departments found in trash', 'hybrid-base' ),
                'all_items'          => __( 'Departments',                   'hybrid-base' ),
            )
        )
    );
}

function doc_documents_register_post_types() {

    /* Register the Document post type. */

    register_post_type(
        'document',
        array(
            'description'         => '',
            'public'              => true,
            'publicly_queryable'  => true,
            'show_in_nav_menus'   => false,
            'show_in_admin_bar'   => true,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-media-document',
            'can_export'          => true,
            'delete_with_user'    => false,
            'hierarchical'        => false,
            'has_archive'         => 'documents',
            'query_var'           => 'document',
            'capability_type'     => 'page',
            'map_meta_cap'        => true,

            /* Capabilities. */
            // 'capabilities' => array(

            //     // meta caps (don't assign these to roles)
            //     'edit_post'              => 'edit_document',
            //     'read_post'              => 'read_document',
            //     'delete_post'            => 'delete_document',

            //     // primitive/meta caps
            //     'create_posts'           => 'create_documents',

            //     // primitive caps used outside of map_meta_cap()
            //     'edit_posts'             => 'edit_documents',
            //     'edit_others_posts'      => 'manage_documents',
            //     'publish_posts'          => 'manage_documents',
            //     'read_private_posts'     => 'read',

            //     // primitive caps used inside of map_meta_cap()
            //     'read'                   => 'read',
            //     'delete_posts'           => 'manage_documents',
            //     'delete_private_posts'   => 'manage_documents',
            //     'delete_published_posts' => 'manage_documents',
            //     'delete_others_posts'    => 'manage_documents',
            //     'edit_private_posts'     => 'edit_documents',
            //     'edit_published_posts'   => 'edit_documents'
            // ),

            /* The rewrite handles the URL structure. */
            'rewrite' => array(
                'slug'       => 'documents',
                'with_front' => false,
                'pages'      => true,
                'feeds'      => true,
                'ep_mask'    => EP_PERMALINK,
            ),

            /* What features the post type supports. */
            'supports' => array(
                'title',
                'editor',
                'author',
                'thumbnail'
            ),

            /* Taxonomies of the post type. */
            'taxonomies'  => array( 
                'agency' 
            ),

            /* Labels used when displaying the posts. */
            'labels' => array(
                'name'               => __( 'Documents',                   'hybrid-base' ),
                'singular_name'      => __( 'Document',                    'hybrid-base' ),
                'menu_name'          => __( 'Documents',                   'hybrid-base' ),
                'name_admin_bar'     => __( 'Document',                    'hybrid-base' ),
                'add_new'            => __( 'Add New',                     'hybrid-base' ),
                'add_new_item'       => __( 'Add New Document',            'hybrid-base' ),
                'edit_item'          => __( 'Edit Document',               'hybrid-base' ),
                'new_item'           => __( 'New Document',                'hybrid-base' ),
                'view_item'          => __( 'View Document',               'hybrid-base' ),
                'search_items'       => __( 'Search Documents',            'hybrid-base' ),
                'not_found'          => __( 'No documents found',          'hybrid-base' ),
                'not_found_in_trash' => __( 'No documents found in trash', 'hybrid-base' ),
                'all_items'          => __( 'Documents',                   'hybrid-base' ),
            )
        )
    );
}


/**
 * Custom "enter title here" text.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $title
 * @param  object  $post
 * @return string
 */
function doc_enter_title_here( $title, $post ) {

    if ( 'employee' === $post->post_type || 'department' === $post->post_type )
        $title = __( 'Name to be displayed on the website', 'directory' );

    return $title;
}