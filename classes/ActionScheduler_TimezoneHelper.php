<?php

/**
 * Class ActionScheduler_TimezoneHelper
 */
abstract class ActionScheduler_TimezoneHelper {
	private static $local_timezone = NULL;
	public static function get_local_timezone( $reset = FALSE ) {
		if ( $reset ) {
			self::$local_timezone = NULL;
		}
		if ( !isset(self::$local_timezone) ) {
			$tzstring = get_option('timezone_string');

			if ( empty($tzstring) ) {
				$gmt_offset = get_option('gmt_offset');
				if ( $gmt_offset == 0 ) {
					$tzstring = 'UTC';
				} else {
					$tzstring = timezone_name_from_abbr('', $gmt_offset * HOUR_IN_SECONDS);
				}
			}

			self::$local_timezone = new DateTimeZone($tzstring);
		}
		return self::$local_timezone;
	}
}
 