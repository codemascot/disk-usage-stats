<?php # -*- coding: utf-8 -*-

/**
 * Plugin Name: Disk Usage Stats
 * Description: This is a WordPress plugin developed for showing disk usage statistics.
 * Plugin URI:  https://github.com/rnaby/disk-usage-stats
 * Author:      TheDramatist
 * Author URI:  http://thedramatist.me
 * Version:     dev-master
 * License:     GPL-2.0
 * Text Domain: disk-usage-stats
 */

namespace TheDramatist\DiskUsageStats;

/**
 * Class Initialize
 *
 * @package TheDramatist\DiskUsageStats
 */
final class Initialize {

	// Hold an instance of the class
	private static $instance;

	/**
	 * Initialize constructor.
	 */
	private function __construct() {
		add_action( 'plugins_loaded', [ $this, 'initialize' ] );
		add_action(
			'disk-usage-stats_plugin_activate',
			[ $this, 'create_table' ]
		);
	}

	/**
	 * @return \TheDramatist\DiskUsageStats\Initialize
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Initialize a hook on plugin activation.
	 *
	 * @return void
	 */
	public static function activate() {
		do_action( 'disk-usage-stats_plugin_activate' );
	}

	/**
	 * Initialize a hook on plugin deactivation.
	 *
	 * @return void
	 */
	public function deactivate() {
		do_action( 'disk-usage-stats_plugin_deactivate' );
	}
	
	/**
	 * Method for creating DB table.
	 *
	 * @return void
	 */
	public function create_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'dus_data';
		$charset = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
  					id bigint(20) NOT NULL AUTO_INCREMENT,
  					created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  					user_id bigint(20) NOT NULL,
				  	report text NOT NULL,
				  	PRIMARY KEY  (id)
				) {$charset};";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
	
	/**
	 * Initialize all the plugin things.
	 *
	 * @return array|void
	 * @throws \Throwable
	 */
	public function initialize() {

		try {

			/**
			 * Checking if vendor/autoload.php exists or not.
			 */
			if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
				/** @noinspection PhpIncludeInspection */
				require_once __DIR__ . '/vendor/autoload.php';
			}
			
			/**
			 * Loading translations.
			 */
			load_plugin_textdomain(
				'disk-usage-stats',
				false,
				'/languages'
			);
			
			/**
			 * Calling modules.
			 */
			( new Assets\AssetsEnqueue() )->init();
			( new AdminPages\Bootstrap() )->init();
			( new DiskStats\AjaxHandler() )->init();
			
		} catch ( \Throwable $throwable ) {
			if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
				throw $throwable;
			}
			do_action( 'disk-usage-stats_error', $throwable );
		}
	}
}

// On activation
register_activation_hook(
	__FILE__,
	[ __NAMESPACE__ . '\\Initialize', 'activate' ]
);

// On deactivation
register_deactivation_hook(
	__FILE__,
	[ __NAMESPACE__ . '\\Initialize', 'deactivate' ]
);

/**
 * Initiating
 */
Initialize::get_instance();
