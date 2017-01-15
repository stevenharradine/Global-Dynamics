<?php
	// beginsWith taken from http://www.php.net/manual/en/ref.strings.php on 20140121 @ 08:30 EST from comments
	// returns true if $str begins with $sub
	function beginsWith( $str, $sub ) {
		return ( substr( $str, 0, strlen( $sub ) ) == $sub );
	}

	// endsWith taken from http://www.php.net/manual/en/ref.strings.php on 20140121 @ 08:30 EST from comments
	// return tru if $str ends with $sub
	function endsWith( $str, $sub ) {
		return ( substr( $str, strlen( $str ) - strlen( $sub ) ) == $sub );
	}