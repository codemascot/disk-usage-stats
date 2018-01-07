<?php # -*- coding: utf-8 -*-

namespace TheDramatist\DiskUsageStats\Assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Class AssetsEnqueue
 *
 * @package TheDramatist\DiskUsageStats\Assets
 */
class AssetsEnqueue {

	/**
	 * AssetsEnqueue constructor.
	 */
	public function __construct() {

	}

	/**
	 * Enqueueing scripts and styles.
	 * @return void
	 */
	public function init() {
		add_action( 'admin_enqueue_scripts', [ $this, 'styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'scripts' ] );
	}

	/**
	 * Enqueueing styles.
	 * @return void
	 */
	public function styles() {
		wp_register_style(
			'disk-usage-stats-css',
			plugin_dir_url( __FILE__ ) . '../../assets/css/style.css',
			null,
			'1.0.0',
			'all'
		);
	}

	/**
	 * Enqueueing scripts.
	 * @return void
	 */
	public function scripts() {
		// Registering the script.
		wp_register_script(
			'disk-usage-stats-js',
			plugin_dir_url( __FILE__ ) . '../../assets/js/system.js',
			[ 'jquery' ],
			'1.0.0',
			true
		);
		// Local JS data
		$local_js_data = array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'home_url' => home_url(),
			'site_url' => site_url(),
		);
		// Pass data to system.js on page load
		wp_localize_script(
			'disk-usage-stats-js',
			'DiskUsageStatsAjaxObj',
			$local_js_data
		);
	}
}
