<?php
	class SessionManager {
		private $USER_ID;
		private $user_type;
		private $username;
		private $isAuthorized = true;

		function __construct ($USER_ID, $user_type = '', $username = '') {
			if ( $USER_ID == null ) {
				$this->isAuthorized = false;
			} else {
				$this->USER_ID = $USER_ID;
				$this->user_type = $user_type;
				$this->username = $username;
			}
		}

		public function getUserId () {
			return $this->USER_ID;
		}
		public function getUserType () {
			return $this->user_type;
		}
		public function getUserName () {
			return $this->username;
		}

		// TODO: for future use for view/state based control
		public function isAuthorized () {
			return $this->isAuthorized;
		}
	}