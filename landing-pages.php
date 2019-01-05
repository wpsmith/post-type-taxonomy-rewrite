<?php
/**
 * Post Type and Taxonomy Registration.
 *
 * Landing Page Post Type & Campaign Type Taxonomy.
 *
 * @package WPS\Plugins\Rewrite
 * @author  Travis Smith <t@wpsmith.net>
 * @license GPL-2.0+
 * @link    https://wpsmith.net/
 */

namespace WPS\Plugins\Rewrite\PostTypeTaxonomy;

add_action( 'init', '\WPS\Plugins\Rewrite\PostTypeTaxonomy\register_cpt_landing_pages' );
function register_cpt_landing_pages() {

	/**
	 * Post Type: Landing Pages.
	 */

	$labels = array(
		'name'          => __( 'Landing Pages', 'wps' ),
		'singular_name' => __( 'Landing Page', 'wps' ),
	);

	$args = array(
		'label'                 => __( 'Landing Pages', 'wps' ),
		'labels'                => $labels,
		'description'           => '',
		'public'                => true,
		'publicly_queryable'    => true,
		'show_ui'               => true,
		'delete_with_user'      => false,
		'show_in_rest'          => true,
		'rest_base'             => '',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'has_archive'           => false,
		'show_in_menu'          => true,
		'show_in_nav_menus'     => true,
		'exclude_from_search'   => true,
		'capability_type'       => 'post',
		'map_meta_cap'          => true,
		'hierarchical'          => false,
//		'rewrite'               => array( 'slug' => '/', 'with_front' => true ),
		'rewrite'               => array( 'slug' => 'landing-page', 'with_front' => true ),
		'query_var'             => true,
		'menu_position'         => 5,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'campaign_type' ),
	);

	register_post_type( 'landing_page', $args );
}

add_action( 'init', '\WPS\Plugins\Rewrite\PostTypeTaxonomy\register_tax_campaign_type' );
function register_tax_campaign_type() {

	/**
	 * Taxonomy: Campaign Types.
	 */
	$labels = array(
		'name'          => __( 'Campaign Types', 'wps' ),
		'singular_name' => __( 'Campaign Type', 'wps' ),
	);

	$args = array(
		'label'                 => __( 'Campaign Types', 'wps' ),
		'labels'                => $labels,
		'public'                => true,
		'publicly_queryable'    => true,
		'hierarchical'          => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_nav_menus'     => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'campaign_type', 'with_front' => true, ),
		'show_admin_column'     => false,
		'show_in_rest'          => true,
		'rest_base'             => 'campaign_type',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_in_quick_edit'    => false,
	);
	register_taxonomy( 'campaign_type', array( 'landing_page' ), $args );

	// Make taxonomy single term only.
	// 'type' can be 'radio' or 'select' (default: radio)
	new \WPS\Taxonomies\SingleTermTaxonomy( 'campaign_type', array( 'landing_page' ), 'radio' );
}
