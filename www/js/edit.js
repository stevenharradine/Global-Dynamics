// Edit
jQuery("a.edit").bind ("click", function (e) {
	e.preventDefault();
	
	$parent = jQuery (this).parent().parent().parent().parent().parent();
	$edit = jQuery (this).parent().parent().parent().parent().parent().parent().find("section.edit");
	
	jQuery.ajax({
		url: jQuery(this).attr("href")
	}).done( function(data) {

		// only draw one section.edit on the page
		if ($edit.length >= 1) {
			$edit.html( data );
			$edit.show();
		} else {
			$parent.before( "<section class=\"edit\">" + data + "</section>");

			$edit = $parent.parent().find("section.edit");
		}
		$edit.prepend("<a class='close' href='#'>Close</a>");
		$edit.find("a.close").bind ("click", function (e) {
			e.preventDefault();
			jQuery (this).parent().hide();
		});
		$edit.css ("top", e.pageY + "px");

		$('html, body').scrollTop ($("#editTitle").offset().top - 90);
	});
});