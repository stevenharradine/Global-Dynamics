<?php
	require_once ('ViewModel.php');

	class IconView extends View {
		public function render ($data) {
			$icon_id = $data->getIconId();
			$label = $data->getLabel();

			return <<<EOD
	<span class='icon'>
		<span class='icon-actual icon-$icon_id' title="$label"></span>
		<span class='icon-label'>$label</span>
	</span>
EOD;
		}
	}