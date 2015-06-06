<?php
	require_once ($relative_base_path . 'views/button.php');

	class ButtonModel {
		private $label;
		private $class;
		private $href;

		// $class deprecated
		function __construct ($label=null, $href=null, $class=null) {
			$this->label = $label;
			$this->class = $class;
			$this->href = $href;
		}

		function getLabel () {
			return $this->label;
		}
		function getClass () {
			return $this->class;
		}
		function getHref () {
			return $this->href;
		}
	}