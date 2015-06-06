<?php
	require_once ('LinkedList.php');
	require_once $relative_base_path . 'views/edit.php';

	class EditModel extends LinkedList {
		private $id;
		private $title;
		private $action;
		private $submitPage;
		private $custom_id;

		function __construct ($title, $action, $id, $submitPage='./', $custom_id='') {
			parent::__construct();

			$this->id = $id;
			$this->title = $title;
			$this->action = $action;
			$this->submitPage = $submitPage;
			$this->custom_id = $custom_id . (strlen($custom_id) > 1 ? '_' : '');
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

		function getTitle () {
			return $this->title;
		}
		function getAction () {
			return $this->action;
		}
		function getCustomId () {
			return $this->custom_id;
		}
		function getId () {
			return $this->id;
		}
		function getSubmitPage () {
			return $this->submitPage;
		}
	}