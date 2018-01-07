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
		?>
		<table>
			<thead>
			<th><?php esc_html_e( 'File', 'dis-usage-stats' ); ?></th>
			<th><?php esc_html_e( 'Size', 'dis-usage-stats' ); ?></th>
			</thead>
			<?php foreach ( $data['files'] as $name => $size ) : ?>
			<tr>
				<td><?php echo $name; ?></td>
				<td>
					<?php echo $disk_stats->add_units( $size ); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<?php
	}
}