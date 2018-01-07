(function( $ ) {
	'use strict';
	$(function() {
		$( '.dus-main-page-controls-form' )
			.on(
				'click',
				'input.dus-init-analyzer-control-button',
				function( e ) {
					e.preventDefault();
					// Ajax code would be here.
				}
			);
	});
})(jQuery);