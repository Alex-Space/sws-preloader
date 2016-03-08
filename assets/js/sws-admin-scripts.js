(function( $ ) {
 
    /**
	 * Add Color Picker to options page
	 */
    $(function() {
        $('.sws-color-picker').wpColorPicker();
    });

    /**
     * Select 2 to select for choose preloader
     */
	$(function() {

		function swsColorBox(name) {
		  if ( ! name.id || name.element.className === 'sws-no-bg-preloader' ) { return name.text; }
		  var $name = $('<span class="sws-select-color-box ' + name.element.className + '">' + name.text + '</span>');
		  return $name;
		};

		$('.sws-pleloader-choose-select').select2({
			placeholder: 'Select a preloader',
			templateResult: swsColorBox,
			templateSelection: swsColorBox,
			minimumResultsForSearch: -1
		});
	});

	/**
	 * Upload button
	 */
	$(function() {
		$('.sws-button-select-file').on('click', function(event) {
			event.preventDefault();
			$('#sws-preloader-custom-file').trigger('click');
		});
		$('#sws-preloader-custom-file').on('change', function(event) {
			$('.condition').text( $(this).val() );
		});
	});
})( jQuery );