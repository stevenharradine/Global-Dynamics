<?php
	function format_currency ($number) {
		if ( is_numeric ( $number ) ) {
			$abs_number = abs ($number);

			return ($number < 0 ? '-' : '' ) . '$&nbsp;' . number_format ($abs_number, 2);
		} else {
			return $number;
		}
	}

	function format_percent ($number) {
		return is_numeric( $number ) ? ($number * 100) . '%' : $number;
	}

	function leadingZero ($val) {
		return ($val < 10 ? '0' : '') . $val;
	}
	function formateTime ($time) {
		return leadingZero ($time['hours']) .':' . leadingZero ($time['minutes']) . ':' . leadingZero ($time['seconds']);
	}

	/*
		From http://snipplr.com/view/25/format-phone-number/ on 20131011 @ 2:44 EST
	*/
	function format_phone ($phone) {
		$phone = preg_replace("/[^0-9]/", "", $phone);
		
		if (strlen($phone) == 7) {
			return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
		} elseif (strlen($phone) == 10) {
			return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
		} elseif (strlen($phone) == 11) {
			return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "+$1 ($2) $3-$4", $phone);
		} else {
			return $phone;
		}
	}

	/*
		Takes a string timeformat "YYYY-MM-DD HH:MM:SS", HH is a 24 hour clock.
		Outputs a unix timestamp (ticks since epoch)
	*/
	function unix_timestamp_from_mysql_datetime ($datetime) {
		$datetimeSplit = explode (' ', $datetime);

		$date = explode ('-', $datetimeSplit[0]);
		$time = explode (':', $datetimeSplit[1]);

		$year = $date[0];
		$month = $date[1];
		$day = $date[2];
		$hour = $time[0];
		$minute = $time[1];
		$second = $time[2];

		return mktime($hour, $minute, $second, $month, $day, $year);
	}

	function percentToDecimal ($percent) {
		if (endsWith ($percent, '%')) {
			return rtrim ($percent, "%") / 100;
		}

		return $percent;
	}