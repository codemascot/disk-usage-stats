<?php # -*- coding: utf-8 -*-

namespace TheDramatist\DiskUsageStats\AdminPages\Sections\MainPage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use TheDramatist\DiskUsageStats\AdminPages\Sections;

/**
 * Class ControlSection
 *
 * @package TheDramatist\DiskUsageStats\AdminPages\Sections
 */
class ControlSection extends Sections\AbstractPage {
	
	/**
	 * OrderProposal constructor.
	 */
	public function __construct() {
		$this->id       = 'controls';
		$this->label    = __( 'Controls', 'disk-usage-stats' );
	}
	
	/**
	 *
	 */
	public function init() {
		add_filter( 'dus_main_page_tabs_array', [ $this, 'tabs_array' ] );
		add_filter(
			'dus_main_page_controls_form_class',
			[ $this, 'add_form_class' ],
			10,
			1
		);
		add_action(
			'dus_main_page_sections_controls',
			[ $this, 'render' ]
		);
	}
	
	/**
	 * @param string $classes
	 *
	 * @return string
	 */
	public function add_form_class( $classes ) {
		$classes .= 'dus-main-page-controls-form';
		return $classes;
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
				'type'          => 'submit_button',
				'display_text'  => __( 'Run Analysis', 'disk-usage-stats' ),
				'name'          => 'save',
				'class'         => 'dus-init-analyzer-control-button',
			],
		];
		return apply_filters( 'dus_get_settings_' . $this->id, $settings );
	}
}
