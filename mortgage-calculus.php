<?php
/**
 * Plugin Name:       Mortgage Calculus
 * Description:       This calculates your mortgage for you
 * Requires at least: 6.5
 * Requires PHP:      8.0
 * Version:           1.0.0
 * Author:            Oken Chinonso
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mortgagecalculus
 *
 * @package MortgageCalculus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit('I am only a plugin. I can\'t do anything without WordPress'); // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function register_mortgage_calculus() {
	register_block_type( __DIR__ . '/build' );

	// // Get the registry instance
	// $registry = WP_Block_Type_Registry::get_instance();

	// // Get all registered blocks as an array
	// $registered_blocks = $registry->get_all_registered();

	// print_r($registered_blocks['mortgage/calculus']->parameter);
	// exit();
}

add_action( 'init', 'register_mortgage_calculus' );
