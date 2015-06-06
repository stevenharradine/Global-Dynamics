<?php
	require_once ('ViewModel.php');

	class TableView2 extends View {
		public function render ($tableView) {
			$title = $tableView->getTitle ();
			$section_id = $tableView->getSectionId ();
			$title_weight = $tableView->getTitleWeight ();

			$output = $section_id != null ? "<section class=\"$section_id\">" : '';

			$output .= $title != null ? "<$title_weight>$title</$title_weight>" : '';

			$output  .= '<table>';

			while ( $tableView->hasMore() ) {
				$cells = $tableView->getCurrentRow();

				$output .= '		<tr>';
				foreach ($cells as $cell) {
					$html_id = $cell['html_id'];
					$data = $cell['data'];
					$cell_type = $cell['cell_type'];

					$output .= "			<$cell_type class=\"$html_id\">$data</$cell_type>";
				}
				$output .= '		</tr>';

				$tableView->seekNext();
			}
			$output .= '</table>';
			$output .= $section_id != null ? '</section>' : '';

			return $output;
		}

		public function createCell ($html_id='', $data='', $cell_type='td') {
			return [
				'html_id' => $html_id,
				'data' => $data,
				'cell_type' => $cell_type
			];
		}

		public function createEdit ($id, $url='edit.php') {
			return TableView2::createCell('edit', "<a class=\"edit\" href=\"$url?id=$id\">Edit</a>");
		}
	}