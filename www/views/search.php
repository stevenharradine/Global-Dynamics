<?php
	require_once ('ViewModel.php');

	class SearchView extends View {
		public function render ($data) {
			$target = $data->getTarget();
			
			$output = '';
			$output .= '<section class="search">';
			$output .= '	<h2>Search</h2>';
			$output .= '	<form>';
			$output .= "		<input type=\"hidden\" name=\"target\" value=\"$target\"/>";
			$output .= '		<input type="text" />';
			$output .= '		<input type="submit" />';
			$output .= '	</form>';
			$output .= '</section>';

			return $output;
		}
	}