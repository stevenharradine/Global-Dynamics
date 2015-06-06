<?php
	class TableView {
		private $headings;
		private $editable;
		private $row;
		private $seek_index;

		function __construct ($headings) {
			$this->headings = $headings;

			$this->row = array ();
			$this->seek_index = 0;
		}

		function addRow ($row) {
			$this->row[] = $row;
		}
		public function createCell ($html_id, $data) {
			return [
				'html_id' => $html_id,
				'data' => $data
			];
		}
		public function createEdit ($id) {
			return TableView::createCell ('edit', '<a class="edit" href="edit.php?id=' . $id . '">Edit</a>');
		}

		function getHeadings () {
			return $this->headings;
		}

		// Seek functions
		// TODO this should be abstracted and extended where needed.
		function hasMore () {
			return count ( $this->row ) > $this->seek_index ? true : false;
		}
		function getCurrentRow () {
			return $this->row[$this->seek_index];
		}
		function seekNext () {
			$this->seek_index++;
		}
		function seekTo ($index) {
			$this->seek_index = $index;
		}
	}