<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div class="wrap disk-usage-stats">
	<h2>
		<?php echo $page_title; ?>
	</h2>
	<form
		method="<?php
		echo esc_attr(
			apply_filters(
				'dus_form_method_tab_'
				. $args['current_tab'], 'post'
			)
		);
		?>"
		id="mainform"
		class="<?php
		echo apply_filters(
			'dus_'
			. $args['module']
			. '_'
			. $args['current_tab']
			. '_form_class',
			''
		);
		?>"
		action="<?php
		echo apply_filters(
			'dus_'
			. $args['module']
			. '_'
			. $args['current_tab']
			. '_form_action',
			''
		);
		?>"
		enctype="multipart/form-data"
	>

		<?php
		$tabs = apply_filters(
			'dus_' . $args['module'] . '_tabs_array',
			array()
		);
		?>

		<?php if ( ! empty( $tabs ) && 1 !== count( $tabs ) ) : ?>
			<h2 class = "nav-tab-wrapper wp-clearfix" >
				<?php
				foreach ( $tabs as $name => $label ) {
					echo '<a href="'
					. admin_url(
						'admin.php?page='
						. $args['page_slug']
						. '&tab='
						. $name )
					. '" class="nav-tab '
					. ( $args['current_tab'] === $name ? 'nav-tab-active' : '')
					. '">'
					. $label
						 . '</a>';
				}
				do_action( 'dus_' . $args['module'] . '_tabs' );
				?>
			</h2 >
		<?php endif; ?>

		<h1 class = "screen-reader-text" >
			<?php echo esc_html( $tabs[ $args['current_tab'] ] ); ?>
		</h1 >

		<?php
		do_action(
			'dus_' . $args['module'] . '_sections_' . $args['current_tab']
		);
		do_action(
			'dus_' . $args['module'] . '_' . $args['current_tab']
		);
		?>

	</form>
</div>
