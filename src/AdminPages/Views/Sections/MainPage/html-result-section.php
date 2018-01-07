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