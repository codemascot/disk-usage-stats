<?php # -*- coding: utf-8 -*-

namespace TheDramatist\DiskUsageStats\AdminPages\Sections\MainPage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use TheDramatist\DiskUsageStats\AdminPages\Sections;
use TheDramatist\DiskUsageStats\DiskStats;

/**
 * Class ResultSection
 *
 * @package TheDramatist\DiskUsageStats\AdminPages\Sections
 */
class ResultSection extends Sections\AbstractPage {
	
	private $path;
	
	/**
	 * ResultSection constructor.
	 */
	public function __construct() {
		$this->id       = 'results';
		$this->label    = __( 'Results', 'disk-usage-stats' );
	}
	
	/**
	 *
	 */
	public function init() {
		add_filter( 'dus_main_page_tabs_array', [ $this, 'tabs_array' ] );
		add_action(
			'dus_main_page_sections_results',
			[ $this, 'render' ]
		);
	}
	
	/**
	 *
	 */
	public function render() {
		$disk_stats = new DiskStats\DiskStats( get_home_path() );
		$data = $disk_stats->dir_or_file_stats();
		require_once plugin_dir_path( __FILE__ )
		             . '../../Views/Sections/MainPage/html-result-section.php';
	}
}