(function () {	
	jQuery ("html").addClass ("js");

	jQuery ("header .icon-hamburger").bind ("click", function ( e ) {
		$nav = jQuery ("nav ul");
		duration = 500;

		if ($nav.css("display") === "none") {
			$nav.slideDown ( duration );
		} else {
			$nav.slideUp ( duration );
		}
	});

	title = jQuery("h1").html();
	
	jQuery ("nav li a").each( function () {
		if (jQuery(this).html() == title) {
			jQuery(this).parent().addClass("active");
		}
	});
}) ();