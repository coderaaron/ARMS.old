(function( $ ) {
	'use strict';

	$(document).ready(function() {
		if ( $('#pet-type').val() == 'c' ) {
			$('#dog-primary-breed-row, #dog-secondary-breed-row').hide();
		} else{
			$('#cat-primary-breed-row, #cat-secondary-breed-row, #declawed-row').hide();
		}
		$('#pet-type').on('change', function() {
			if ( $(this).val() == 'c' ) {
				$('#cat-primary-breed-row, #cat-secondary-breed-row, #declawed-row').show();
				$('#dog-primary-breed-row, #dog-secondary-breed-row').hide();
			} else {
				$('#cat-primary-breed-row, #cat-secondary-breed-row, #declawed-row').hide();
				$('#dog-primary-breed-row, #dog-secondary-breed-row').show();
			}
		});
	});		

})( jQuery );
