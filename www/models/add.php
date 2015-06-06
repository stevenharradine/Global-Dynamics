<?php
	require_once ('LinkedList.php');
	require_once ($relative_base_path . 'views/add.php');

	class AddModel extends LinkedList {
		private $title;
		private $page_action;
		private $action;

		function __construct ($title, $page_action, $action='#') {
			parent::__construct();
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

		function addRadioOption ($html_id, $label, $group_name, $attr='') {
			$this->row[] = [
				'html_id' => $html_id,
				'label' => $label,
				'type' => 'radio',
				'group_name' => $group_name,
				'attr' => $attr
			];
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
	}