<?php
	abstract class LinkedList {
		protected $row;
		protected $seek_index;

		public function __construct () {
			$this->row = array ();
			$this->seek_index = 0;
		}

		public function hasMore () {
			return count ( $this->row ) > $this->seek_index ? true : false;
		}
		public function getCurrentRow () {
			return $this->row[$this->seek_index];
		}
		public function seekNext () {
			$this->seek_index++;
		}
		public function seekTo ($index) {
			$this->seek_index = $index;
		}
	}