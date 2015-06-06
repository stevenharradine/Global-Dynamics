<?php
	require_once ('ViewModel.php');

	class ButtonView extends View {
		public function render ($data) {
			$label = $data->getLabel();
			$class = $data->getClass();
			$href = $data->getHref();

			$output = "<a href=\"$href\" class=\"$class button\">$label</a>";

			return $output;
		}
	}