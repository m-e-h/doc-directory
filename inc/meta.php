<?php

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function cmb2_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

add_filter( 'cmb2_meta_boxes', 'cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb2_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['emp_contact_info'] = array(
		'id'            => 'emp_contact_info',
		'title'         => __( 'Contact Information', 'cmb2' ),
		'object_types'  => array( 'employee', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'        => array(
			array(
				'name'       => __( 'Test Text', 'cmb2' ),
				'desc'       => __( 'field description (optional)', 'cmb2' ),
				'id'         => $prefix . 'test_text',
				'type'       => 'text',
				'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
				// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
				// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
				// 'on_front'        => false, // Optionally designate a field to wp-admin only
				// 'repeatable'      => true,
			),
			array(
				'name' => __( 'First Name', 'cmb2' ),
				// 'desc' => __( 'field description (optional)', 'cmb2' ),
				'id'   => $prefix . 'emp_first_name',
				'type' => 'text_medium',
				// 'repeatable' => true,
				'attributes'  => array(
        		'placeholder' => 'A small amount of text',
    		),
			),
			array(
				'name' => __( 'Last Name', 'cmb2' ),
				// 'desc' => __( 'field description (optional)', 'cmb2' ),
				'id'   => $prefix . 'emp_last_name',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name'     => __( 'Department', 'cmb2' ),
				// 'desc'     => __( 'field description (optional)', 'cmb2' ),
				'id'       => $prefix . 'emp_department_tax',
				'type'     => 'taxonomy_select',
				'taxonomy' => 'department', // Taxonomy Slug
			),
			array(
				'name' => __( 'Title', 'cmb2' ),
				// 'desc' => __( 'job title', 'cmb2' ),
				'id'   => $prefix . 'emp_title_text',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Phone', 'cmb2' ),
				'desc' => __( 'Office', 'cmb2' ),
				'id'   => $prefix . 'emp_phone',
				'type' => 'text_medium',
				'repeatable' => true,
			),
			array(
				'name' => __( 'Email', 'cmb2' ),
				'desc' => __( 'preferably your @charlottediocese.org address', 'cmb2' ),
				'id'   => $prefix . 'emp_email',
				'type' => 'text_email',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Profile Image', 'cmb2' ),
				'desc' => __( 'Upload an image or enter a URL.', 'cmb2' ),
				'id'   => $prefix . 'emp_image',
				'type' => 'file',
			),
		),
	);

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$meta_boxes['department_staff_metabox'] = array(
		'id'            => 'department_staff_metabox',
		'title'         => __( 'Department Staff', 'cmb2' ),
		'object_types'  => array( 'department', ), 
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		'fields' 		=> array(
			            array(
                'id'          => $prefix . 'repeat_group',
                'type'        => 'group',
                'options'     => array(
                    'group_title'   => __( '#{#}', 'cmb2' ), // {#} gets replaced by row number
                    'add_button'    => __( 'Add Another Employee', 'cmb2' ),
                    'remove_button' => __( 'Remove Employee', 'cmb2' ),
                    'sortable'      => true, ),

                // Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
                'fields'      => array(
            array(
                'name'    => __( 'Employee', 'cmb' ),
                'id'      => $prefix . 'employee_select',
                'type'    => 'select',
                'options' => cmb2_get_post_options(
                	array( 
                		'post_type' => 'employee',
                		) 
                	),
                'default' => 'custom',
                'attributes'  => array(
        			'placeholder' => 'Employees',
    			),
            ),
            ),
                ),
        )
	);


	// Add other metaboxes as needed

	return $meta_boxes;
}