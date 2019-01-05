<?php
/**
 * Post Type and Taxonomy Registration.
 *
 * Resource Post Type & Resource Type Taxonomy.
 *
 * @package WPS\Plugins\Rewrite
 * @author  Travis Smith <t@wpsmith.net>
 * @license GPL-2.0+
 * @link    https://wpsmith.net/
 */

namespace WPS\Plugins\Rewrite\PostTypeTaxonomy;

add_action( 'init', '\WPS\Plugins\Rewrite\PostTypeTaxonomy\register_tax_resource_type' );
/**
 * Register the Resource Type taxonomy
 */
function register_tax_resource_type() {

	$labels = array(
		'name'                       => __( 'Resource Types', 'wps' ),
		'singular_name'              => __( 'Type', 'wps' ),
		'search_items'               => __( 'Search Types', 'wps' ),
		'popular_items'              => __( 'Popular Types', 'wps' ),
		'all_items'                  => __( 'All Types', 'wps' ),
		'parent_item'                => __( 'Parent Type', 'wps' ),
		'parent_item_colon'          => __( 'Parent Type:', 'wps' ),
		'edit_item'                  => __( 'Edit Type', 'wps' ),
		'update_item'                => __( 'Update Type', 'wps' ),
		'add_new_item'               => __( 'Add New Type', 'wps' ),
		'new_item_name'              => __( 'New Type', 'wps' ),
		'separate_items_with_commas' => __( 'Separate Types with commas', 'wps' ),
		'add_or_remove_items'        => __( 'Add or remove Types', 'wps' ),
		'choose_from_most_used'      => __( 'Choose from most used Types', 'wps' ),
		'menu_name'                  => __( 'Types', 'wps' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_tagcloud'     => false,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'resource-type', 'with_front' => false ),
		'query_var'         => true,
		'show_admin_column' => true,
	);

	register_taxonomy( 'resource_type', array( 'resource' ), $args );

}

add_action( 'init', '\WPS\Plugins\Rewrite\PostTypeTaxonomy\register_cpt_resource' );
/**
 * Register the custom post type
 */
function register_cpt_resource() {

	$labels = array(
		'name'               => __( 'Resources', 'wps' ),
		'singular_name'      => __( 'Resource', 'wps' ),
		'add_new'            => __( 'Add New', 'wps' ),
		'add_new_item'       => __( 'Add New Resource', 'wps' ),
		'edit_item'          => __( 'Edit Resource', 'wps' ),
		'new_item'           => __( 'New Resource', 'wps' ),
		'view_item'          => __( 'View Resource', 'wps' ),
		'search_items'       => __( 'Search Resources', 'wps' ),
		'not_found'          => __( 'No Resources found', 'wps' ),
		'not_found_in_trash' => __( 'No Resources found in Trash', 'wps' ),
		'parent_item_colon'  => __( 'Parent Resource:', 'wps' ),
		'menu_name'          => __( 'Resources', 'wps' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'author', 'comments', 'discussion', 'page-attributes' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array( 'slug' => 'resource', 'with_front' => false ),
		'menu_icon'           => 'dashicons-format-aside',
	);

	register_post_type( 'resource', $args );

}
