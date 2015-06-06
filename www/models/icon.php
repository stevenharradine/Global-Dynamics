<?php
	require_once ($relative_base_path . 'views/icon.php');

	class IconModel {
		private $icon_id;
		private $label;

		// $class deprecated
		function __construct ($icon_id=null, $label=null) {
			$this->icon_id = $icon_id;
			$this->label = $label;
		}

		function getIconId () {
			return $this->icon_id;
		}
		function getLabel () {
			return $this->label;
		}
	}