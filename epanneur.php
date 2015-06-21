<?php 
/*
Plugin Name: E-panneur custom post type
Description: This plugin enables custom inputs.
Version: 1.0
Author: Eftakhairul Islam
Author URI: http://eftakhairul.com
Wordpress version supported: 3.0 and above
License: GPL2
*/

// register custom post type to work 
function epanneur_create_post_type() {
	// set up labels
	$labels = array(
 		'name'                  => 'Epanneur',
    	'singular_name'         => 'Epanneur date',
    	'add_new'               => 'Add New Epanneur date',
    	'add_new_item'          => 'Add New Epanneur date',
    	'edit_item'             => 'Edit epanneur date',
    	'new_item'              => 'New epanneur date',
    	'all_items'             => 'All epanneur date',
    	'view_item'             => 'View epanneur date',
    	'search_items'          => 'Search epanneur date',
    	'not_found'             =>  'No epanneur date Found',
    	'not_found_in_trash'    => 'No epanneur date found in Trash',
    	'parent_item_colon'     => '',
    	'menu_name'             => 'Epanneur Date',
    );

    //register post type
	register_post_type( 'epapnneur_date', array(
		'labels'                => $labels,
		'has_archive'           => true,
 		'public'                => true,
		'supports'              => array( 'title'),
		'exclude_from_search'   => false,
		'capability_type'       => 'post',
        'supports' 				=> array( 'title', 'custom-fields'),
		'rewrite'               => array( 'slug' => 'epanneur-date' ),
		)
	);
}

//enable in WP
add_action( 'init', 'epanneur_create_post_type' );
add_filter( 'manage_edit-epapnneur_date_columns', 'my_edit_epapnneur_date_columns' ) ;

//enable extra fields in admin panel 
function my_edit_epapnneur_date_columns( $columns ) {

	$columns = array(

		'title'         => __( 'Title' ),
        'max'           => __( 'Max Request' ),
        'start_time'    => __( 'Start Time' ),
		'end_time'      => __( 'End Time' ),
        'postal_code'   => __( 'Postal Code' )
	);

	return $columns;
}

add_action( 'manage_epapnneur_date_posts_custom_column', 'my_manage_epapnneur_date_columns', 10, 2 );

//Enable custom fields in admin planel 
function my_manage_epapnneur_date_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'max' colum' */
		case 'max' :			
			$max=  get_post_meta( $post_id, 'max', true);
			if ( empty( $max ) ) {
				echo '';
			} else {
				echo $max;
			}

			break;

		/* If displaying the 'start_date' colum' */
		case 'start_time' :			
			$start_time =  get_post_meta( $post_id, 'start_time', true);
			if ( empty( $start_time ) ) {
				echo '';
			} else {
				echo "" .$start_time;
			}
			break;

        /* If displaying the 'end_time' column. */
		case 'end_time' :
			$end_time =  get_post_meta( $post_id, 'end_time', true);
			if ( empty( $end_time ) ) {
				echo '';
			} else {
				echo "".$end_time;
			}
            break;

            /* If displaying the 'postal_code' column. */
		case 'postal_code' :
			$postal_code =  get_post_meta( $post_id, 'postal_code', true);
			if ( empty( $postal_code ) ) {
				echo '';
			} else {
				echo "".$postal_code;
			}
			break;

		/* Just break out of the switch statement for everything else. */
		default :
            echo '';
			break;
	}
}