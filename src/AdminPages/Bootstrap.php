<?php # -*- coding: utf-8 -*-

namespace TheDramatist\DiskUsageStats\AdminPages;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Class Bootstrap
 *
 * @package TheDramatist\DiskUsageStats\AdminPages
 */
class Bootstrap {

	/**
	 * @var string
	 */
	private $main_page_slug;

	/**
	 * @var string
	 */
	private $sett_page_slug;

	/**
	 * AdminPages constructor.
	 */
	public function __construct() {
		$this->main_page_slug = 'disk-usage-stats-main';
		$this->sett_page_slug = 'disk-usage-stats-settings';
	}

	/**
	 *
	 */
	public function init() {
		add_action( 'admin_menu', [ $this, 'menu' ] );
		$this->modules();
	}

	/**
	 *
	 */
	public function menu() {
		
		/**
		 * Adding main menu page
		 */
		add_menu_page(
			__( 'Disk Usage Stats', 'disk-usage-stats' ),
			__( 'Disk Usage Stats', 'disk-usage-stats' ),
			'manage_options',
			$this->main_page_slug,
			[ $this, 'main_page_callback' ],
			'',
			null
		);
		
		/**
		 * Adding settings menu page
		 */
		add_submenu_page(
			$this->main_page_slug,
			__( 'Disk Usage Stats Settings', 'disk-usage-stats' ),
			__( 'Settings', 'disk-usage-stats' ),
			'manage_options',
			$this->sett_page_slug,
			[ $this, 'settings_page_callback' ]
		);
	}
	
	public function enqueue_scripts() {
		// Enqueuing CSS file.
		wp_enqueue_style( 'disk-usage-stats-css' );
		// Enqueueing JS file.
		wp_enqueue_script( 'disk-usage-stats-js' );
	}

	/**
	 *
	 */
	public function main_page_callback() {
		
		$this->enqueue_scripts();
		
		$current_tab = empty( $_GET['tab'] )
			? 'results' : sanitize_key( $_GET['tab'] );
		$args = [
			'module'      => 'main_page',
			'current_tab' => $current_tab,
			'page_slug'   => $this->main_page_slug,
		];
		$page_title = esc_html__(
			'Main Page - Disk Usage Stats',
			'disk-usage-stats'
		);
		require_once 'Views/html-base-page-layout.php';
	}

	public function settings_page_callback() {
		
		$this->enqueue_scripts();
		
		$current_tab = empty( $_GET['tab'] )
			? 'settings' : sanitize_key( $_GET['tab'] );
		$args = [
			'module'      => 'settings_page',
			'current_tab' => $current_tab,
			'page_slug'   => $this->sett_page_slug,
		];
		$page_title = esc_html__(
			'Settings Page - Disk Usage Stats',
			'disk-usage-stats'
		);
		require_once 'Views/html-base-page-layout.php';
	}

	/**
	 * Including necessary modules.
	 */
	public function modules() {
		$classes    = [
			( new Sections\MainPage\ResultSection() )->init(),
			( new Sections\MainPage\ControlSection() )->init(),
			( new Sections\SettingsPage\SettingsSection() )->init(),
		];
		
		return apply_filters(
			'dus_modules',
			$classes
		);
	}
}
