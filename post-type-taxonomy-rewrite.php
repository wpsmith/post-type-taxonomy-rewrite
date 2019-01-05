<?php
/**
 * Plugin Name:     WPS Post Type Taxonomy Rewrite
 * Plugin URI:      https://wpsmith.net
 * Description:     Rewrite for {taxonomy}/{postname} rewrites.
 * Author:          Travis Smith <t@wpsmith.net>
 * Author URI:      https://wpsmith.net
 * Text Domain:     wps-rewrite
 * Domain Path:     /languages
 * Version:         0.1.0
 */

/**
 * Plugin main file.
 *
 * @package WPS\Plugins\Rewrite
 * @author  Travis Smith <t@wpsmith.net>
 * @license GPL-2.0+
 * @link    https://wpsmith.net/
 */

namespace WPS\Plugins\Rewrite\PostTypeTaxonomy;

// Add autoloader.
require 'vendor/autoload.php';

/**
 * Does the resources rewrites.
 */
function do_resources() {
	// Require post types file.
	require_once 'resources.php';

	// Do the rewrite for resources.
	try {

		// Create the rewrite object connecting the post type and taxonomy.
		$resource_resource_type = new \WPS\Rewrite\PostTypeByTaxonomy( array(
			'post_type' => 'resource',
			'taxonomy'  => 'resource_type',
		) );

		// Set the order of the rewrite to `%post_type%/%term%`. Defaults to `%term%/%post_type%`.
		$resource_resource_type->set_order( [
			'%post_type%',
			'%term%',
		] );

		// Add all the rewrites. This includes the main, embed, feed, pagination, and date URLs.
		$resource_resource_type->add_all_rewrites();

	} catch ( \Exception $e ) {
		// do nothing right now.
		// @todo Maybe do something.
	}
}

// Do it!
do_resources();

/**
 * Does the landing-pages rewrites.
 */
function do_landing_pages() {
	// Require post types file.
	require_once 'landing-pages.php';

	// Do the rewrite for landing pages.
	try {

		// Create the rewrite object connecting the post type and taxonomy.
		$landing_page_campaign_type = new \WPS\Rewrite\PostTypeByTaxonomy( array(
			'post_type' => 'landing_page',
			'taxonomy'  => 'campaign_type',
		) );

		// Set the order of the rewrite to `%post_type%/%term%`. Defaults to `%term%/%post_type%`.
		$landing_page_campaign_type->set_order( [
			'%term%',
		] );

		// Add the feed/embed rewrite URLs.
		$landing_page_campaign_type->add_embed_rewrites();
		$landing_page_campaign_type->add_feed_rewrites();

	} catch ( \Exception $e ) {
		// do nothing right now.
		// @todo Maybe do something.
	}
}

// Do it!
do_landing_pages();

/**
 * Does the videos rewrites.
 */
function do_videos() {
	// Require post types file.
	require_once 'videos.php';

	// Do the rewrite for landing pages.
	try {

		// Create the rewrite object connecting the post type and taxonomy.
		$videos = new \WPS\Rewrite\PostTypeRewrite( array(
			'post_type' => 'video',
		) );

		// Add a prefix.
		$videos->set_prefix( 'my-prefix' );

		// Add all the rewrites. This includes the main, embed, feed, pagination, and date URLs.
		$videos->add_all_rewrites();


	} catch ( \Exception $e ) {
		// do nothing right now.
		// @todo Maybe do something.
	}
}

// Do it!
do_videos();

register_activation_hook( __FILE__, '\WPS\Plugins\Rewrite\PostTypeTaxonomy\on_activation' );
/**
 * Flush rules on activation.
 */
function on_activation() {

	// Register my taxonomies and custom post types.

	// Landing Pages.
	register_cpt_landing_pages();
	register_tax_campaign_type();

	// Resources.
	register_tax_resource_type();
	register_cpt_resource();

	// Videos
	register_cpt_videos();


	// Flush the rules.
	flush_rewrite_rules();

}