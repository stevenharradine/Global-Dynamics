(function () {
	jQuery ("section.search input[type='submit']").hide();

	jQuery ("section.search form").bind ("submit", function ( e ) {
		e.preventDefault();
	});

	jQuery ("section.search").hide();
	jQuery ("header a.search").bind ("click", function ( e ) {
		e.preventDefault();

		var delay = 500;
		var $search = jQuery ("section.search");

		if ($search.css("display") === "none") {
			$search.slideDown(delay).find("input[type=text]").focus();
		} else {
			$search.slideUp(delay);
		}
	});

	jQuery ("section.search input[type='text']").bind ("change keyup", function ( e ) {
		var inputValue = jQuery (this).val().toLowerCase();
		var target = jQuery ("section.search input[type='hidden']").val();
		var $row = jQuery("section." + target + " table").find("tr");
		
		if (inputValue == "") {
			$row.show();
		} else {
			$row.hide();
			$row.each(function () {
				jQuery (this).find("td").each(function () {
					if (jQuery(this).find("a").html().toLowerCase().indexOf(inputValue) >= 0 || jQuery(this).find("a").attr("href").toLowerCase().indexOf(inputValue) >= 0) {
						jQuery(this).parent().show();
					}
				});
			});
		}
	});

}) ();