<?php
	abstract class Application {
		// bool: returns if the current applications databace has been created
		abstract public function isInitialized ();

		// null: creates the current applications database
		abstract public function createDB ();

		// null: checks if its the admin and if so checks and if needed creates the applications database
		public function initDB ($child) {
			global $sessionManager;
			$usertype = $sessionManager->getUserType();

			if ($usertype == 'ADMIN') {
				if (!$child->isInitialized()) {
					$child->createDB();
				}
			}
		}
	}