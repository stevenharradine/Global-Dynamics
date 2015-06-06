<?php
	require_once ('ViewModel.php');

	class AddView2 extends View {
		public function render ($data) {
			$heading = $data->getTitle();
			$page_action = $data->getPageAction();

			$output = '';
			$output .= '<section class="add">';
			$output .= "	<h2>$heading</h2>";
			if ( isset ( $db_write_success ) && $db_write_success ) { echo "added"; }

			$output .= '<form action="' . $data->getAction() . '" method="post" id="add_stock" class="form">';

			if ( $page_action != null ) {
					$output .= "<input type=\"hidden\" name=\"action\" value=\"$page_action\" />";
			}

			while ( $data->hasMore() ) {
				$row = $data->getCurrentRow ();

				$html_id = $row['html_id'];
				$label = $row['label'];
				$type = $row['type'];

				if ($type == 'text') {
					$default_value = $row['default_value'] != null ? ' value="' . $row['default_value'] . '"' : '';
					$placeholder = $row['placeholder'] != null ? ' placeholder="' . $row['placeholder'] . '"' : '';

					$output .= "<div class=\"$html_id\"><label for=\"$html_id\">$label</label><input id=\"$html_id\" name=\"$html_id\" type=\"text\" $default_value $placeholder /></div>";
				} else if ($type == 'option') {
					$options = $row['options'];
					$output .= "<div class=\"$html_id\"><label for=\"$html_id\">$label</label><select name=\"$html_id\">";

					foreach ($options as $option) {
						$output .= "<option value=\"$option\">$option</option>";
					}
					$output .= '</select>';
				} else if ($type == 'radio') {
					$group_name = $row['group_name'];
					$attr = $row['attr'];

					$output .= "<div class=\"$html_id\"><input type=\"radio\" name=\"$group_name\" value=\"$html_id\" id=\"$html_id\" $attr /> <label for=\"$html_id\">$label</label></div>";
				}

				$data->seekNext();
			}
			$output .= '		<input type="submit" value="Add">';
			$output .= '	</form>';
			$output .= '</section>';

			return $output;
		}
	}