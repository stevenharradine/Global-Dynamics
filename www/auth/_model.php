<?php
	class AuthManager {
		public function changePassword ($current_password, $new_password) {
			global $sessionManager;
			$USER_ID = $sessionManager->getUserId();

			// if the supplied password ($current_password) is correct
			if (hash (AuthManager::getHashingAlgorithm(), $current_password . AuthManager::getSalt()) == AuthManager::getPasswordHash()) {
				$hashing = AuthManager::createNewHash($password);
				$new_salt = $hashing['salt'];
				$new_hash_algorithm = $hashing['hash_algorithm'];
				$new_hash = $hashing['hash'];
				$new_salt_database = $hashing['salt_database'];

				$sql = <<<EOD
	UPDATE
		`sarah`.`users`
	SET
		`password` = '$new_hash',
		`salt` = '$new_salt_database',
		`hash_algorithm` = '$new_hash_algorithm'
	WHERE
		`USER_ID`='$USER_ID'
EOD;
				return mysql_query($sql) or die(mysql_error());
			}
			
			return NULL;
		}

		public function updateRecord ($id=null, $user_type, $username, $new_password) {
			global $sessionManager;
			$USER_ID = ($id != null) ? $id : $sessionManager->getUserId();

			if ($new_password != '') {
				$hashing = AuthManager::createNewHash($new_password);
				$salt = $hashing['salt'];
				$hash_algorithm = $hashing['hash_algorithm'];
				$hash = $hashing['hash'];
				$salt_database = $hashing['salt_database'];

				$password_clause = ", `hash_algorithm` = '$hash_algorithm', `salt` = '$salt_database', `password` = '$hash'";
			}

			$sql = <<<EOD
	UPDATE
		`sarah`.`users`
	SET
		`user_type` = '$user_type',
		`username` = '$username'
		$password_clause
	WHERE
		`USER_ID`='$USER_ID'
EOD;

			return mysql_query($sql) or die(mysql_error());
		}

		public function deleteUser ($id) {
			$sql = <<<EOD
	DELETE FROM
		`sarah`.`users`
	WHERE
		`USER_ID`='$id'
EOD;

			return mysql_query($sql) or die(mysql_error());
		}

		public function getSalt ($id=null) {
			return base64_decode(AuthManager::getData ('salt', $id));
		}
		public function getPasswordHash ($id=null) {
			return AuthManager::getData ('password', $id);
		}
		public function getHashingAlgorithm ($id=null) {
			return AuthManager::getData ('hash_algorithm', $id);
		}

		// pull single column from database for current user (unless user specified)
		private function getData ($data, $id=null) {
			global $sessionManager;
			$USER_ID = ($id != null) ? $id : $sessionManager->getUserId();

			$sql = <<<EOD
	SELECT
		`$data`
	FROM
		`sarah`.`users`
	WHERE
		`USER_ID`='$USER_ID'
EOD;

			$query_data = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_array( $query_data );

			$extract_data = $row["$data"];
			
			return $extract_data;
		}

		public function addUser ($user_type, $username, $password) {
			// check if user name exists
			$usercount_sql = <<<EOD
	SELECT
		COUNT(*)
	FROM
		`sarah`.`users`
	WHERE
		`username`='$username'
EOD;
			$usercount_data = mysql_query($usercount_sql) or die(mysql_error());
			$usercount_row = mysql_fetch_array( $usercount_data );

			if ($usercount_row['COUNT(*)'] == 0) {
				$hashing = AuthManager::createNewHash($password);
				$salt = $hashing['salt'];
				$hash_algorithm = $hashing['hash_algorithm'];
				$hash = $hashing['hash'];
				$salt_database = $hashing['salt_database'];

				$sql = <<<EOD
	INSERT INTO
		`sarah`.`users` (
			`user_type`,
			`username`,
			`hash_algorithm`,
			`salt`,
			`password`
		) VALUES (
			'$user_type',
			'$username',
			'$hash_algorithm',
			'$salt_database',
			'$hash'
		)
EOD;

				return mysql_query($sql) or die(mysql_error());
			} else {
				return null;
			}
		}

		// required during login to pull the logging in users salt, hash, and hashing algorithm
		public function getIdFromUsername ($username) {
			$sql = <<<EOD
	SELECT
		`USER_ID`
	FROM
		`sarah`.`users`
	WHERE
		`username`='$username';
EOD;
			$query_data = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_array( $query_data );

			$extract_data = $row['USER_ID'];
			
			return $extract_data;
		}

		public function checkLogin ($username, $password) {
			$USER_ID = AuthManager::getIdFromUsername ($username);

			if (!is_null ($USER_ID)) {	// if the user exists
				$hash = hash (			// generate hash from provided password
					AuthManager::getHashingAlgorithm($USER_ID),	// hashing algorithm
					$password . AuthManager::getSalt($USER_ID)	// salted password
				);

				$sql	= <<<EOD
	SELECT
		`user_type`
	FROM
		users
	WHERE
		username='$username'
			AND
		password='$hash'
			AND
		USER_ID='$USER_ID'
EOD;
				// compare the password has against whats in the database
				$result	= mysql_query($sql);
				$count = mysql_num_rows($result);

				// If there is only 1 user found
				if ($count == 1) {
					$row = mysql_fetch_array($result);

					// return the user details
					return array (
						'count' => $count,
						'USER_ID' => $USER_ID,
						'user_type' => $row['user_type']
					);
				} else {	// password incorrect or multiple accounts found
					return array ('count' => 0);
				}
			} else {		// username not found
				return array ('count' => 0);
			}
		}

		private function createNewHash ($password, $saltSize = 64, $hash_algorithm = 'SHA256') {
			$salt = mcrypt_create_iv ($saltSize);

			return array (
				'salt' => $salt,
				'hash_algorithm' => $hash_algorithm,
				'hash' => hash ($hash_algorithm, $password . $salt),
				'salt_database' => base64_encode($salt)
			);
		}
	}