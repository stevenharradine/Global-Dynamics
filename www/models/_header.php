<?php
	class HeaderView {
		private $title;
		private $script;
		private $link;
		private $style;
		private $meta;
		private $alt_menu;
		private $other;

		function __construct ($title) {
			$this->title = $title;
		}

		function getTitle () {
			return $this->title;
		}
		function getScript () {
			return $this->script;
		}
		function getLink () {
			return $this->link;
		}
		function getStyle () {
			return $this->style;
		}
		function getMeta () {
			return $this->meta;
		}
		function getAltMenu () {
			return $this->alt_menu;
		}
		function getOther () {
			return $this->other;
		}

		function setScript ($script) {
			$this->script = $script;
		}
		function setLink ($link) {
			$this->link = $link;
		}
		function setStyle ($style) {
			$this->style = $style;
		}
		function setMeta ($meta) {
			$this->meta = $meta;
		}
		function setAltMenu ($alt_menu) {
			$this->alt_menu = $alt_menu;
		}
		function setOther ($other) {
			$this->other = $other;
		}
	}