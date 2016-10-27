var _label_max = 'Maximize';
var _label_min = 'Restore'; 

var innerHTML = '<button class="collapse-sidebar cryout-expand-sidebar button-secondary" aria-expanded="true" aria-label="' + _label_max + '" href="#">\
        <span class="collapse-sidebar-arrow"></span>\
        <span class="collapse-sidebar-label">' + _label_max + '</span>\
</button> ';


jQuery( document ).ready(function( jQuery ) {

	jQuery('#customize-theme-controls .customize-control-description').each(function() {
		jQuery(this).insertAfter(jQuery(this).parent().children('.customize-control-content, select, input:not(input[type=checkbox])'));
	});
	
	jQuery('#customize-footer-actions').append(innerHTML);

	jQuery('.collapse-sidebar:not(.cryout-expand-sidebar)').on( 'click', function( event ) {
			if ( jQuery('.wp-full-overlay').hasClass('cryout-maximized') ) {
				jQuery('.wp-full-overlay').removeClass( 'cryout-maximized' );
				jQuery('a.cryout-expand-sidebar span.collapse-sidebar-label').html(_label_max);
			}
			
	});
	jQuery('.cryout-expand-sidebar').on( 'click', function( event ) {
			var label = jQuery('.cryout-expand-sidebar span.collapse-sidebar-label');
			if (jQuery(label).html() == _label_max) {
					jQuery(label).html(_label_min);
					jQuery('.wp-full-overlay').removeClass( 'collapsed' ).addClass( 'expanded' ).addClass( 'cryout-maximized' );
			} else {
					jQuery(label).html(_label_max);
					jQuery('.wp-full-overlay').removeClass( 'collapsed' ).addClass( 'expanded' ).removeClass( 'cryout-maximized' );
			}
			event.preventDefault();
	});

	
});