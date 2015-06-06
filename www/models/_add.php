<?php
	class AddView {
		private $title;
		private $page_action;
		private $action;
		private $row;
		private $seek_index;

		function __construct ($title, $page_action, $action='#') {
			$this->title = $title;
			$this->page_action = $page_action;
			$this->action = $action;

			$this->row = array ();
			$this->seek_index = 0;
		}

		function addRow ($html_id, $label, $default_value = null, $placeholder = null) {
			$this->row[] = [
				'html_id' => $html_id,
				'label' => $label,
				'type' => 'text',
				'default_value' => $default_value,
				'placeholder' => $placeholder
			];
		}

		function addOptionBox ($html_id, $label, $options) {
			$this->row[] = [
				'html_id' => $html_id,
				'label' => $label,
				'type' => 'option',
				'options' => $options
			];
		}

		function hasMore () {
			return count ( $this->row ) > $this->seek_index ? true : false;
		}

		function getTitle () {
			return $this->title;
		}
		function getPageAction () {
			return $this->page_action;
		}
		function getAction () {
			return $this->action;
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