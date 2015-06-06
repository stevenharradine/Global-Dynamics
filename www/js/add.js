(function () {	
	jQuery ("section.add").hide();
	
	jQuery ("header a.add").bind ("click", function (e) {
		e.preventDefault();
		
		var delay = 500;
		var $add_form = jQuery ("section.add");
		
		if ($add_form.css("display") === "none") {
			$add_form.slideDown(delay).find("input[type='text']")[0].focus();;
		} else {
			$add_form.slideUp(delay);
		}
	});
}) ();