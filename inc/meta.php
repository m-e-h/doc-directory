<?php


add_filter( 'cmb2_meta_boxes', 'cmb2_staff_metaboxes' );

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
// function cmb2_hide_if_no_cats( $field ) {
// 	// Don't show this field if not in the cats category
// 	if ( ! has_tag( 'cats', $field->object_id ) ) {
// 		return false;
// 	}
// 	return true;
// }


/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_staff_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_doc_';


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
				'name' => __( 'First Name', 'cmb2' ),
				'id'   => $prefix . 'emp_first_name',
				'type' => 'text_medium',
				'attributes'  => array(
        		'placeholder' => 'First',
    		),
			),
			array(
				'name' => __( 'Last Name', 'cmb2' ),
				'id'   => $prefix . 'emp_last_name',
				'type' => 'text_medium',
				'attributes'  => array(
                'placeholder' => 'Last',
            ),
			),

            array(
                'name' => __( 'Phone', 'cmb2' ),
                'id'          => 'phone_group',
                'type'        => 'group',
                'options'     => array(
                    'group_title'   => __( '{#}', 'cmb2' ), // {#} gets replaced by row number
                    'add_button'    => __( 'Add Another Phone', 'cmb2' ),
                    'remove_button' => __( 'Remove Phone', 'cmb2' ),
                    'sortable'      => true, // beta
                ),
                'fields'      => array(

            array(
                'name'    => __( 'Type', 'cmb2' ),
                'id'      => 'phone_type_select',
                'type'    => 'select',
                'options' => array(
                    'fa-phone' => __( 'Office', 'cmb2' ),
                    'fa-mobile'   => __( 'Mobile', 'cmb2' ),
                    'none'     => __( 'Other', 'cmb2' ),
                ),
            ),

			array(
				'name' => __( 'Number', 'cmb2' ),
				'id'   => 'emp_phone',
				'type' => 'text_medium',
                'add_button' => __( 'Add Another Phone', 'cmb2' ),
                'attributes'  => array(
                'placeholder' => '704-###-####',
            ),
				//'repeatable' => true,
			),
                ),
                ),
			array(
				'name' => __( 'Email', 'cmb2' ),
				'id'   => $prefix . 'emp_email',
				'type' => 'text_email',
                'attributes'  => array(
                'placeholder' => '@charlottediocese.org',
            ),
				'repeatable' => true,
			),
		),
	);


    /**
     * Repeatable Field Groups
     */
    $meta_boxes['documents_group'] = array(
        'id'           => 'documents_group',
        'title'        => __( 'Department Documents', 'cmb2' ),
        'object_types' => array( 'document', ),
        'fields'       => array(
            array(
                'id'          => $prefix . 'document_group',
                'type'        => 'group',
                'options'     => array(
                    'group_title'   => __( 'Document {#}', 'cmb2' ), // {#} gets replaced by row number
                    'add_button'    => __( 'Add Another Document', 'cmb2' ),
                    'remove_button' => __( 'Remove Document', 'cmb2' ),
                    'sortable'      => true, // beta
                ),
                // Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
                'fields'      => array(
                    array(
                        'name' => 'Document Title',
                        'id'   => 'title',
                        'type' => 'text',
                        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
                    ),
                    array(
                        'name' => 'Description',
                        'id'   => 'description',
                        'type' => 'textarea_small',
                    ),
                    array(
                        'name' => 'Document Upload',
                        'id'   => 'doc_file',
                        'type' => 'file',
                    ),
                ),
            ),
        ),
    );

	// Add other metaboxes as needed

	return $meta_boxes;
}