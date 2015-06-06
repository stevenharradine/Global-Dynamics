require(["jquery-1.6.2.min", "navigation-highlighting"], function() {

	$("a[target='_blank']").each(function () {
		$(this).click(function () {
			var href = $(this).attr("href");
			var name = $(this).attr("name");
			var width = $(this).attr("data-width");
			var height = $(this).attr("data-height");
			
			window.open(href, name, "'height: " + height + ", width: " + width + "'", true);
			
			return false;
		});
	});
	$ (".toggler").each (function () {
		$ (this).click(function () {
			$ ($ (this)).toggleClass("collapsed");
		});
	});

	// weather
	setTimeout (weather_heights, 1000);
	function weather_heights () {
		maxHeight = -1;
		$ ("#hourZZ .foreGlance").each (function (key, value) {
			if ($(this).height() > maxHeight) {
				maxHeight = $(this).height();
			}
		});
		$ ("#hourZZ .foreGlance").each (function (key, value) {
			$(this).height(maxHeight);
		});
		$ ("#hourZZ").height(maxHeight+30);
	}
});