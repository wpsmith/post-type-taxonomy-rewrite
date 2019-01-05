<?php
/**
 * Post Type and Taxonomy Registration.
 *
 * Video Post Type.
 *
 * @package WPS\Plugins\Rewrite
 * @author  Travis Smith <t@wpsmith.net>
 * @license GPL-2.0+
 * @link    https://wpsmith.net/
 */

namespace WPS\Plugins\Rewrite\PostTypeTaxonomy;

add_action( 'init', '\WPS\Plugins\Rewrite\PostTypeTaxonomy\register_cpt_videos' );
/**
 * Register the Video Post Type.
 */
function register_cpt_videos() {

	$labels = array(
		'name'          => __( 'Videos', 'wps' ),
		'singular_name' => __( 'Video', 'wps' ),
	);

	$args = array(
		'label'                 => __( 'Videos', 'wps' ),
		'labels'                => $labels,
		'description'           => '',
		'public'                => true,
		'publicly_queryable'    => true,
		'show_ui'               => true,
		'delete_with_user'      => false,
		'show_in_rest'          => true,
		'rest_base'             => '',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'has_archive'           => 'videos',
		'show_in_menu'          => true,
		'show_in_nav_menus'     => true,
		'exclude_from_search'   => true,
		'capability_type'       => 'post',
		'map_meta_cap'          => true,
		'hierarchical'          => false,
		'rewrite'               => array( 'slug' => 'video', 'with_front' => true ),
		'query_var'             => true,
		'menu_position'         => 5,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'           => 'dashicons-video-alt3',
	);

	register_post_type( 'video', $args );

}