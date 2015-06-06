jQuery ("table.sEdit td.editable").each( function () {
	var id = jQuery(this).parent().attr("data-id");
	
	var editable_dom = jQuery(this).children().html();
	var static_dom = jQuery(this).find("input[type='text']").val();
	
	jQuery(this).children().html(static_dom);
	jQuery(this).parent().find(".delete").addClass("hide");
	
	jQuery (this).bind("click", function () {
	// close all other editing boxes
	jQuery ("table.sEdit td.editable").each(function () {
		if (id != jQuery(this).parent().attr("data-id")) {
			jQuery(this).children().html (jQuery(this).find("input[type='text']").val());
		}
	});
	
	// make the clicked cell editable
	if (jQuery(this).attr ("data-sEdit-status") != "edit") {
	  jQuery (this).attr ("data-sEdit-status", "edit");
	  
	  jQuery(this).children().html (editable_dom);
	  jQuery(this).parent().find(".delete").removeClass("hide");
	}
	});
});