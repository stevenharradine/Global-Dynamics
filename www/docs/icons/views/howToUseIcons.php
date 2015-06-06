<?php
	require_once ('../../views/ViewModel.php');

	class HowToUseIconsView extends View {
		public function render ($data) {
			return <<<EOD
	<h2>How to use icons</h2>
	<p>Icons require a label and id.  The label is used on larger break points when applicable.  The label is also used to provide context to the icon for accessibility.</p>
	<p>Using icons are very simple and there is a helper function already build for you.  These files are included in the global scope of SARAH and you simply need to invoke them.</p>
	<h3>To use:</h3>
	<p class="code code-php">IconView::render( new IconModel ('icon_id', 'icon label'));</p>
EOD;
		}
	}