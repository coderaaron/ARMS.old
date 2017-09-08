<?php

class ARMS {
	private static $initiated = false;

	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	/**
	 * Initializes WordPress hooks
	 */
	private static function init_hooks() {
		self::$initiated = true;

		self::register_post_type();
		add_filter( 'rwmb_meta_boxes', array( 'ARMS', 'arms_get_meta_box' ) );
		add_filter( 'enter_title_here', array( 'ARMS', 'arms_change_title_text' ) );
	}

	public static function arms_change_title_text( $title ){
		 $screen = get_current_screen();
	  
		 if  ( 'pet' == $screen->post_type ) {
			  $title = 'Enter pet name';
		 }
	  
		 return $title;
	}
  


	public static function register_post_type() {
		$labels = array(
			'name'               => _x( 'Pets', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Pet', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Pets', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Pet', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'pet', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Pet', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Pet', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Pet', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Pet', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Pets', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Pets', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Pets:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No pets found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No pets found in Trash.', 'your-plugin-textdomain' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'your-plugin-textdomain' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			/*'rewrite'            => array( 'slug' => 'pet' ),*/
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => 'dashicons-heart',
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
		);

		register_post_type( 'pet', $args );
	}

	public static function arms_get_meta_box( $meta_boxes ) {
		$prefix = 'arms-';

		$meta_boxes[] = array(
			'id' => 'untitled',
			'title' => esc_html__( 'Pet Information', 'arms' ),
			'post_types' => array( 'pet', 'post' ),
			'context' => 'advanced',
			'priority' => 'default',
			'autosave' => false,
			'fields' => array(
				array(
					'id' => 'pet_id',
					'type' => 'number',
					'name' => 'Legacy Pet ID',
				),
				array(
					'id' => 'tagNum',
					'type' => 'text',
					'name' => 'Tag Number',
				),
				array(
					'id' => 'new_pet_descrip',
					'type' => 'wysiwyg',
					'name' => 'new_pet_descrip',
				),
				array(
					'id' => 'pet_status',
					'type' => 'select',
					'name' => 'Primary Pet Status',
					'placeholder' => 'Select a status',
					'options' => array(
						'c' => 'Created',
						'q' => 'Quarantined',
						'v' => 'Available',
						's' => 'Sidelined',
						'a' => 'Adopted',
						'd' => 'Deceased',
						'r' => 'Other',
						'p' => 'Adoption Pending',
						't' => 'Transferred Out of KAR',
						'u' => 'Returned to Relinquisher',
					),
				),
				array(
					'id' => 'pet_status2',
					'type' => 'select',
					'name' => 'Secondary Pet Status',
					'options' => array(
						'n' => 'None',
						'e' => 'Euthanized',
						'm' => 'Medical',
						'a' => 'Application Screening',
						'i' => 'Incomplete/Missing Info',
						'o' => 'Other',
					),
				),
				array(
					'id' => 'adoptFee',
					'type' => 'number',
					'name' => 'Adoption Fee',
				),
				array(
					'id' => 'pet_type',
					'type' => 'select',
					'name' => 'pet_type',
					'options' => array(
						'c' => 'Cat',
						'd' => 'Dog',
					),
				),
				array(
					'id' => 'pet_mom',
					'type' => 'user',
					'name' => 'Pet Parent (Primary)',
					'field_type' => 'select_advanced',
				),
				array(
					'id' => 'pet_mom2',
					'type' => 'user',
					'name' => 'Pet Parent (Secondary)',
					'field_type' => 'select_advanced',
				),
				array(
					'id' => 'pet_sex',
					'type' => 'radio',
					'name' => 'Pet Sex',
					'options' => array(
						'm' => 'Male',
						'f' => 'Female',
					),
				),
				array(
					'id' => 'pf_age',
					'type' => 'radio',
					'name' => 'pf_age',
					'options' => array(
						'y' => 'Yes',
						'n' => 'No',
					),
				),
				array(
					'id' => 'pet_DOB',
					'type' => 'date',
					'name' => 'Date of Birth',
				),
				array(
					'id' => 'declawed',
					'type' => 'radio',
					'name' => 'Declawed',
					'options' => array(
						'y' => 'Yes',
						'n' => 'No',
					),
				),
				array(
					'id' => 'rabiesVac',
					'type' => 'radio',
					'name' => 'Rabies Vacination',
					'options' => array(
						'y' => 'Yes',
						'n' => 'No',
					),
				),
				array(
					'id' => 'microchipped',
					'type' => 'radio',
					'name' => 'Microchipped',
					'options' => array(
						'y' => 'Yes',
						'n' => 'No',
					),
				),
				array(
					'id' => 'microchipBrand',
					'type' => 'text',
					'name' => 'Microchip Brand',
				),
				array(
					'id' => 'microchipID',
					'type' => 'text',
					'name' => 'Microchip ID',
				),
				array(
					'id' => 'primaryBreed',
					'type' => 'number',
					'name' => 'primaryBreed',
				),
				array(
					'id' => 'secondaryBreed',
					'type' => 'number',
					'name' => 'secondaryBreed',
				),
				array(
					'id' => 'pet_mixed',
					'type' => 'radio',
					'name' => 'pet_mixed',
					'options' => array(
						'y' => 'Yes',
						'n' => 'No',
					),
				),
				array(
					'id' => 'pet_size',
					'type' => 'radio',
					'name' => 'pet_size',
					'options' => array(
						'y' => 'Yes',
						'n' => 'No',
					),
				),
				array(
					'id' => 'hasShots',
					'type' => 'radio',
					'name' => 'hasShots',
					'options' => array(
						'y' => 'Yes',
						'n' => 'No',
					),
				),
				array(
					'id' => 'altered',
					'type' => 'radio',
					'name' => 'Spayed/Neutered',
					'options' => array(
						'y' => 'Yes',
						'n' => 'No',
					),
				),
				array(
					'id' => 'noCats',
					'type' => 'radio',
					'name' => 'No Cats',
					'options' => array(
						'y' => 'Yes',
						'n' => 'No',
					),
				),
				array(
					'id' => 'noDogs',
					'type' => 'radio',
					'name' => 'No Dogs',
					'options' => array(
						'y' => 'Yes',
						'n' => 'No',
					),
				),
				array(
					'id' => 'noKids',
					'type' => 'radio',
					'name' => 'No Kids',
					'options' => array(
						'y' => 'Yes',
						'n' => 'No',
					),
				),
				array(
					'id' => 'housebroken',
					'type' => 'radio',
					'name' => 'Housebroken',
					'options' => array(
						'y' => 'Yes',
						'n' => 'No',
					),
				),
				array(
					'id' => 'spec_need',
					'type' => 'radio',
					'name' => 'Special Needs',
					'options' => array(
						'y' => 'Yes',
						'n' => 'No',
					),
				),
				array(
					'id' => 'spec_descrip',
					'type' => 'mediumwysiwyg',
					'name' => 'Special Needs description',
				),
				array(
					'id' => 'last_update',
					'type' => 'datetime',
					'name' => 'last_update',
				),
				array(
					'id' => 'entry_date',
					'type' => 'date',
					'name' => 'entry_date',
				),
				array(
					'id' => 'adopted_date',
					'type' => 'date',
					'name' => 'Adopted Date',
				),
				array(
					'id' => 'pending',
					'type' => 'number',
					'name' => 'pending',
				),
				array(
					'id' => 'vol_comments',
					'type' => 'wysiwyg',
					'name' => 'Volunteer Comments',
				),
				array(
					'id' => 'pet_origin',
					'type' => 'text',
					'name' => 'Pet Origin',
				),
				array(
					'id' => 'born_to',
					'type' => 'text',
					'name' => 'born_to',
				),
				array(
					'id' => 'offsite',
					'type' => 'text',
					'name' => 'offsite',
				),
				array(
					'id' => 'camp_ravenwood',
					'type' => 'number',
					'name' => 'camp_ravenwood',
				),
				array(
					'id' => 'adopted_date2',
					'type' => 'date',
					'name' => 'adopted_date2',
				),
				array(
					'id' => 'adopted_date3',
					'type' => 'date',
					'name' => 'adopted_date3',
				),
				array(
					'id' => 'pet_returned',
					'type' => 'date',
					'name' => 'pet_returned',
				),
				array(
					'id' => 'transfer_date',
					'type' => 'date',
					'name' => 'transfer_date',
				),
				array(
					'id' => 'at_office',
					'type' => 'number',
					'name' => 'at_office',
				),
				array(
					'id' => 'black_friday',
					'type' => 'number',
					'name' => 'black_friday',
				),
				array(
					'id' => 'origin_reason',
					'type' => 'wysiwyg',
					'name' => 'origin_reason',
				),
				array(
					'id' => 'pets_number',
					'type' => 'number',
					'name' => 'pets_number',
				),
				array(
					'id' => 'pet_DOD',
					'type' => 'date',
					'name' => 'pet_DOD',
				),
				array(
					'id' => 'video',
					'type' => 'video',
					'name' => 'video',
				),
				array(
					'id' => 'bissell',
					'type' => 'tinynumber',
					'name' => 'bissell',
				),
				array(
					'id' => 'cafe',
					'type' => 'tinynumber',
					'name' => 'cafe',
				),
				array(
					'id' => 'barn',
					'type' => 'tinynumber',
					'name' => 'barn',
				),
				array(
					'id' => 'ready_to_fix',
					'type' => 'tinynumber',
					'name' => 'ready_to_fix',
				),

			),
		);

		return $meta_boxes;
	}

	/**
	 * Attached to activate_{ plugin_basename( __FILES__ ) } by register_activation_hook()
	 * @static
	 */
	public static function plugin_activation() {
		return true;
	}

	/**
	 * Removes all connection options
	 * @static
	 */
	public static function plugin_deactivation() {
		return true;
	}
}
