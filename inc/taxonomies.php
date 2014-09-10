<?php
/**
 * File for registering custom taxonomies.
 *
 * @package    Directory
 * @subpackage Includes
 * @since      1.0.0
 * @author     Marty Helmick <justin@martyhelmick.com>
 * @copyright  Copyright (c) 2013 - 2014, Marty Helmick
 * @link       https://github.com/m-e-h/directory
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Register taxonomies on the 'init' hook. */
add_action( 'init', 'doc_agencies_register_taxonomies' );
add_action( 'init', 'doc_document_types_register_taxonomies' );

/**
 * Register taxonomies for the plugin.
 *
 * @since  1.0.0
 * @access public
 * @return void.
 */
function doc_agencies_register_taxonomies() {

	/* Register the Agency taxonomy. */

	register_taxonomy(
		'agency',
		array( 'department' ),
		array(
			'public'            => true,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_admin_column' => true,
			'hierarchical'      => true,
			'query_var'         => 'agency',

			/* Capabilities. */
			// 'capabilities' => array(
			// 	'manage_terms' => 'manage_agencies',
			// 	'edit_terms'   => 'manage_agencies',
			// 	'delete_terms' => 'manage_agencies',
			// 	'assign_terms' => 'edit_agencies',
			// ),

			/* The rewrite handles the URL structure. */
			'rewrite' => array(
				'slug'         => 'agency',
				'with_front'   => false,
				'hierarchical' => true,
				'ep_mask'      => EP_NONE
			),

			/* Labels used when displaying taxonomy and terms. */
			'labels' => array(
				'name'                       => __( 'Agencies',             'hybrid-base' ),
				'singular_name'              => __( 'Agency',              'hybrid-base' ),
				'menu_name'                  => __( 'Agencies',             'hybrid-base' ),
				'name_admin_bar'             => __( 'Agency',              'hybrid-base' ),
				'search_items'               => __( 'Search Agencies',      'hybrid-base' ),
				'popular_items'              => __( 'Popular Agencies',     'hybrid-base' ),
				'all_items'                  => __( 'All Agencies',         'hybrid-base' ),
				'edit_item'                  => __( 'Edit Agency',         'hybrid-base' ),
				'view_item'                  => __( 'View Agency',         'hybrid-base' ),
				'update_item'                => __( 'Update Agency',       'hybrid-base' ),
				'add_new_item'               => __( 'Add New Agency',      'hybrid-base' ),
				'new_item_name'              => __( 'New Agency Name',     'hybrid-base' ),
				'parent_item'                => __( 'Parent Agency',       'hybrid-base' ),
				'parent_item_colon'          => __( 'Parent Agency:',      'hybrid-base' ),
				'separate_items_with_commas' => null,
				'add_or_remove_items'        => null,
				'choose_from_most_used'      => null,
				'not_found'                  => null,
			)
		)
	);
}

function doc_document_types_register_taxonomies() {

    /* Register the Document Type taxonomy. */

    register_taxonomy(
        'document_type',
        array( 'department' ),
        array(
            'public'            => true,
            'show_ui'           => true,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => true,
            'show_admin_column' => true,
            'hierarchical'      => true,
            'query_var'         => 'document_type',

            /* Capabilities. */
            // 'capabilities' => array(
            //  'manage_terms' => 'manage_document_types',
            //  'edit_terms'   => 'manage_document_types',
            //  'delete_terms' => 'manage_document_types',
            //  'assign_terms' => 'edit_document_types',
            // ),

            /* The rewrite handles the URL structure. */
            'rewrite' => array(
                'slug'         => 'document_type',
                'with_front'   => false,
                'hierarchical' => true,
                'ep_mask'      => EP_NONE
            ),

            /* Labels used when displaying taxonomy and terms. */
            'labels' => array(
                'name'                       => __( 'Document Types',             'hybrid-base' ),
                'singular_name'              => __( 'Document Type',              'hybrid-base' ),
                'menu_name'                  => __( 'Document Types',             'hybrid-base' ),
                'name_admin_bar'             => __( 'Document Type',              'hybrid-base' ),
                'search_items'               => __( 'Search Document Types',      'hybrid-base' ),
                'popular_items'              => __( 'Popular Document Types',     'hybrid-base' ),
                'all_items'                  => __( 'All Document Types',         'hybrid-base' ),
                'edit_item'                  => __( 'Edit Document Type',         'hybrid-base' ),
                'view_item'                  => __( 'View Document Type',         'hybrid-base' ),
                'update_item'                => __( 'Update Document Type',       'hybrid-base' ),
                'add_new_item'               => __( 'Add New Document Type',      'hybrid-base' ),
                'new_item_name'              => __( 'New Document Type Name',     'hybrid-base' ),
                'parent_item'                => __( 'Parent Document Type',       'hybrid-base' ),
                'parent_item_colon'          => __( 'Parent Document Type:',      'hybrid-base' ),
                'separate_items_with_commas' => null,
                'add_or_remove_items'        => null,
                'choose_from_most_used'      => null,
                'not_found'                  => null,
            )
        )
    );
}