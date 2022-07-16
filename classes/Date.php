<?php
date_default_timezone_set('Asia/Manila');
class Date
{

	public static function date_formmatted($date)
	{
		return date_format(date_create($date), 'M d, Y');
	}

	public static function time_format($date) 
	{

		return date('h:i A', strtotime($date));

	}

	public static function currentTimeAndDate() {
		return date('Y-m-d h:m:s');
	}
}
