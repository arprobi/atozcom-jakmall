<?php 

if (!function_exists('format_IDR')) {

    function format_IDR($number = 0)
    {
        return 'Rp' . number_format($number, 0, '', '.');
    }

}

if (!function_exists('formatNumber')) {

    function formatNumber($number = 0)
    {
        return number_format($number, 0, '', '.');
    }

}

if (!function_exists('randomString')) {

	function randomString() {
		$length = 8;
		$randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		return $randomString;
	}

}

 ?>