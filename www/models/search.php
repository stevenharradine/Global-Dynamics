<?php
	require_once $relative_base_path . 'views/search.php';
	
	class SearchModel {
		private $target;

		function __construct ($target=null) {
			$this->target = $target;
		}

		public function getTarget () {
			return $this->target;
		}
	}