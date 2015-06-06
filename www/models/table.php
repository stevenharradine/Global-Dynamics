<?php
	require_once ('LinkedList.php');
	require_once $relative_base_path . 'views/table.php';

	class TableModel extends LinkedList {
		private $title;
		private $section_id;
		private $title_weight;

		function __construct ($title=null, $section_id=null) {
			parent::__construct();
			$this->title = $title;
			$this->section_id = $section_id;

			$this->title_weight = 'h2';
		}

		function getTitleWeight () {
			return $this->title_weight;
		}
		function setTitleWeight ($new_weight) {
			$this->title_weight = $new_weight;
		}

		function addRow ($row) {
			$this->row[] = $row;
		}

		function getTitle () {
			return $this->title;
		}

		function getSectionId () {
			return $this->section_id;
		}
	}