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

// Require post types file.
require_once 'resources.php';

// Do the rewrite for resources.
try {

	$resource_resource_type = new \WPS\Rewrite\PostTypeByTaxonomy( array(
		'post_type' => 'resource',
		'taxonomy'  => 'resource_type',
	) );
	$resource_resource_type->set_order( [
		'%post_type%',
		'%term%',
	] );
	$resource_resource_type->add_all_rewrites();

} catch ( \Exception $e ) {
	// do nothing right now.
	// @todo Maybe do something.
}

require_once 'landing-pages.php';

// Do the rewrite for landing pages.
try {

	$landing_page_campaign_type = new \WPS\Rewrite\PostTypeByTaxonomy( array(
		'post_type' => 'landing_page',
		'taxonomy'  => 'campaign_type',
	) );

	$landing_page_campaign_type->set_order( [
		'%term%',
		'%post_type%',
	] );


} catch ( \Exception $e ) {
	// do nothing right now.
	// @todo Maybe do something.
}

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
	register_tax_resource_topic();
	register_tax_library_tag();
	register_cpt_resource();

	// Videos.
	register_cpt_video();

	// Flush the rules.
	flush_rewrite_rules();

}