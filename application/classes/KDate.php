<?php

class KDate {

	// Constants for date formats
	const FMT_SMALL = 'small';
	const FMT_MEDIUM = 'medium';
	const FMT_LARGE = 'large';
	const FMT_FULL = 'full';
	const FMT_DATE_TIME = 'datetime';

	// Constants for countries
	const CNT_FR = 'fr';
	const CNT_EN = 'en';

	private $second = 60;
	private $minute = 60;
	private $hour = 24;
	private $month = 12;

	// All dates formats
	// @see: http://php.net/manual/fr/function.date.php
	private static function formats() {
		$formats = array(
		self::FMT_SMALL => array(
		self::CNT_EN => 'm, D d',
		self::CNT_FR => 'D d m',
		),
		self::FMT_MEDIUM => array(
		self::CNT_EN => 'm/d',
		self::CNT_FR => 'd/m',
		),
		self::FMT_LARGE => array(
		self::CNT_EN => 'm/d/Y',
		self::CNT_FR => 'd/m/Y',
		),
		self::FMT_FULL => array(
		self::CNT_EN => 'F, l d Y',
		self::CNT_FR => 'l, d F Y',
		),
		self::FMT_DATE_TIME => array(
		self::CNT_EN => 'm/d/Y H:i',
		self::CNT_FR => 'd/m/Y H:i',
		),
		);
		return $formats;
	}

	// Display timestamp
	public static function display($timestamp, $format, $country = self::CNT_EN) {
		// Timestamp must be an integer
		$timestamp = is_int($timestamp) ? $timestamp : 0;

		// Get formats
		$formats = self::formats();

		// Default format if not found
		$format = isset($formats[$format]) ? $format : self::FMT_SMALL;

		// Default country if not found
		$country = isset($formats[$format][$country]) ? $country : self::CNT_EN;

		return date($formats[$format][$country], $timestamp);
	}

	public static function difference($timestamp_begin, $timestamp_end) {
		if ($timestamp_end == FALSE) $timestamp_end = time();
		return round ((($timestamp_end - $timestamp_begin))/(86400*30)) . " " . __("Month(s)");
	}
}

