jQuery.fn.cssCheckbox = function () {

	jQuery("input[@type='checkbox'] + label", this)
		.each( function(){
			if ( jQuery(this).prev()[0].checked )
				jQuery(this).addClass("checked");
			else
				jQuery(this).addClass("unchecked");
		})
		.hover( 
			function() { jQuery(this).addClass("over"); },
			function() { jQuery(this).removeClass("over"); }
		)
		.click( function() {
			jQuery(this)
				.toggleClass("checked")
				.prev()[0].checked = !jQuery(this).prev()[0].checked;
			jQuery(this)
				.toggleClass("unchecked")
				.prev()[0].checked == jQuery(this).prev()[0].checked;
		})
		.prev().hide();
}
