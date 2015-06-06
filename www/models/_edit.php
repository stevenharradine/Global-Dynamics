<?php
	class EditView {
		private $id;
		private $title;
		private $action;
		private $submitPage;
		private $custom_id;
		private $row;
		private $seek_index;

		function __construct ($title, $action, $id, $submitPage='./', $custom_id='') {
			$this->id = $id;
			$this->title = $title;
			$this->action = $action;
			$this->submitPage = $submitPage;
			$this->custom_id = $custom_id . (strlen($custom_id) > 1 ? '_' : '');

			$this->row = array ();
			$this->seek_index = 0;
		}

		function addRow ($html_id, $label, $value, $attr = null) {
			$this->row[] = [
				'html_id' => $html_id,
				'label' => $label,
				'type' => 'text',
				'value' => $value,
				'attr' => $attr
			];
		}

		function addOptionBox ($html_id, $label, $options, $selected) {
			$this->row[] = [
				'html_id' => $html_id,
				'label' => $label,
				'type' => 'option',
				'options' => $options,
				'selected' => $selected
			];
		}

		function addTextarea ($html_id, $label, $value, $attr = null) {
			$this->row[] = [
				'html_id' => $html_id,
				'label' => $label,
				'type' => 'textarea',
				'value' => $value,
				'attr' => $attr
			];
		}

		function hasMore () {
			return count ( $this->row ) > $this->seek_index ? true : false;
		}

		function getTitle () {
			return $this->title;
		}
		function getAction () {
			return $this->action;
		}
		function getId () {
			return $this->id;
		}
		function getSubmitPage () {
			return $this->submitPage;
		}
		function getCustomId () {
			return $this->custom_id;
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