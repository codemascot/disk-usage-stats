<?php # -*- coding: utf-8 -*-

namespace TheDramatist\DiskUsageStats\AdminPages\Sections\SettingsPage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use TheDramatist\DiskUsageStats\AdminPages\Sections;

/**
 * Class SettingsSection
 *
 * @package TheDramatist\DiskUsageStats\AdminPages\Sections\SettingsPage
 */
class SettingsSection extends Sections\AbstractPage {
	
	/**
	 * SettingsSection constructor.
	 */
	public function __construct() {
		$this->id       = 'settings';
		$this->label    = __( 'Settings', 'disk-usage-stats' );
	}
	
	/**
	 *
	 */
	public function init() {
		add_filter( 'dus_settings_page_tabs_array', [ $this, 'tabs_array' ] );
		add_action( 'dus_settings_save_' . $this->id, [ $this, 'save_data' ] );
		add_action(
			'dus_settings_page_sections_settings',
			[ $this, 'render' ]
		);
	}
	
	/**
	 *
	 */
	public function render() {
		parent::output_fields( $this->get_settings() );
	}
	
	/**
	 * Get settings array.
	 *
	 * @return array
	 */
	public function get_settings() {
		$settings = [
			[
				'title' => __( 'Worker Time', 'disk-usage-stats' ),
				'type'  => 'title',
				'id'    => $this->id . 'worker_time',
			],
			[
				'title'    => __( 'Time Value', 'disk-usage-stats' ),
				'desc'     => __( 'In minutes', 'disk-usage-stats' ),
				'id'       => $this->id . 'time_value',
				'type'     => 'text',
				'css'      => '',
				'autoload' => false,
				'desc_tip' => false,
			],
			[
				'type'      => 'sectionend',
				'id'        => $this->id . 'worker_time',
			],
			[
				'type'          => 'submit_button',
				'display_text'  => __( 'Save Options', 'disk-usage-stats' ),
				'name'          => 'save',
				'class'         => '',
			],
			[
				'type'      => 'nonce',
				'nonce_key' => 'disk-usage-stats',
			],
		];
		return apply_filters( 'dus_get_settings_' . $this->id, $settings );
	}
	
	/**
	 * Save settings.
	 */
	public function save_data() {
		$settings = $this->get_settings();
		parent::save_fields( $settings );
	}
}
