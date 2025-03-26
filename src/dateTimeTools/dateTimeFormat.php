<?
// 11 Jun 2011; Added str2time function which first correct the order of the text and then call strtotime.
// 19 Jun 2011; Added str2date function which correct the order of the text.
// 12 Jul 2011; Fixed a problem in str2date function.
// 24 Jul 2011; Fixed a bug with time in str2time function
// 15 Nov 2014: Addes function get_farsi_date.
// 09 Dec 2014: Added parameter $is_input_string to get_farsi_date function.
// 22 Feb 2015: Fixed a bug in get_farsi_date function.
// 05 Apr 2015: Fixed a bug in get_farsi_date function. (null date)
// 16 Sep 2015: Added get_farsi_time function.
// 30 Jan 2016: Added new parameter $order to shtom function.
// 30 Jan 2016: Added get_date_time function.
// 02 Feb 2016: Added $input_reverse_order to shtom function.
// 03 Feb 2016: Added is_hegira_date function.
// 03 Feb 2016: Added get_farsi_date_time function.
// 03 Feb 2016: Fixed Thursday farsi name in day_of_week function.
// 10 Feb 2016: Fixed some problems in get_farsi_date_time function.
// 10 Feb 2016: Added $farsi parameter to get_farsi_date function.
// 10 Feb 2016: Added $is_input_string parameter to get_farsi_time function.
// 03 Apr 2016: Fixed a bug in get_farsi_date function related to show farsi date characters.
// 17 Dec 2016: Added show_date_month_input function.
// 17 Dec 2016: Fixed a bug in show_date_input function related to start year.
// 02 Oct 2018: Added onchange parameter to show_date_input function.
// 12 Mar 2025: Chnaged for utf-8 character set.
// 14 Mar 2025: Fixed date and time for MySqli data types.
// 16 Mar 2025: Migrated from PHP 5.x to PHP 8.2 .
// 22 Mar 2025: Changed to composer compatible.

namespace ZojTools\dateTimeTools;

use ZojTools\farsiTools\farsiNumber;
use ZojTools\dateTimeTools\shamsiDate;

class dateTimeFormat extends shamsiDate {
    
    public static function get_farsi_date_time($field_value, $farsi = false) {
    	if ($field_value == "") return ("");
    	$time_stamp = self::str_to_time($field_value);
    	$dow = date("w", $time_stamp);
    	$farsi_dow = self::day_of_week($dow);
    	$farsi_date = self::get_farsi_date($time_stamp, false, $farsi);
    	$farsi_time = self::get_farsi_time($time_stamp, false, $farsi);
    	return ("$farsi_dow $farsi_date ساعت $farsi_time");
    }
    
    public static function is_hegira_date($HegiraDate) {
    	//  return(ereg("^[1-9][3-4][0-9][0-9]/[]+$",$email));
    	$y = substr($HegiraDate, 0, strpos($HegiraDate, '/'));
    	$m = substr($HegiraDate, strpos($HegiraDate, '/') + 1, strpos($HegiraDate, '/', strpos($HegiraDate, '/') + 1) - strpos($HegiraDate, '/') - 1);
    	$d = substr($HegiraDate, strpos($HegiraDate, '/', strpos($HegiraDate, '/') + 1) + 1, 4);
    	if ($y < 1300 || $y > 1499 || $m < 1 || $m > 12 || $d < 1 || $d > 31) return (false);
    	else return (true);
    }
    
    public static function get_date_time($HegiraDate, $Time24) {
    	return (self::shtom($HegiraDate, 'ymd', '/', false) . ' ' . $Time24);
    }
    
    public static function get_farsi_date($time_input, $farsi = true) //set is_input_string to false when input is timestamp
    {
    	$timestamp = strtotime($time_input);
    	if ($timestamp < 0 || $time_input == "0000-00-00 00:00:00") 
    	    return ("");
    	if (strpos($_SERVER["HTTP_USER_AGENT"], "MSIE") !== false) 
    	    $date_str = self::mtosh(date("Y-m-d", $timestamp));
    	else 
    	    $date_str = self::mtosh(date("Y-m-d", $timestamp) , true);
    	if ($farsi) {
    		$date_str = farsiNumber::number_en2fa($date_str);
    	}
    	return ($date_str);
    }
    
    public static function get_farsi_time($time_input, $farsi = true) {
    	$timestamp = strtotime($time_input);
    	if ($timestamp < 0 || $time_input == "0000-00-00 00:00:00") 
    	    return ("");
    	$time_str = date("H:i", $timestamp);
    	if ($farsi) {
    		$time_str = farsiNumber::number_en2fa($time_str);
    	}
    	return ($time_str);
    }
    
    public static function m_to_sh($miladi) {
    	//  $time_stamp=self::str_to_time($miladi);
    	//  $date_str=mtosh(date("Y-m-d",$time_stamp));
    	$_date = self::strtodate($miladi);
    	$date_str = self::mtosh($_date);
    	return ($date_str);
    }
    
    public static function _today() {
    	$time_stamp = time();
    	$month_day = date("md", $time_stamp);
    	//  if ($month_day>"0921" || $month_day<"0221")
    	//    $time_stamp=$time_stamp-12600;
    	//  else
    	//    $time_stamp=$time_stamp-9000;
    	return (date("Y-m-d", $time_stamp));
    }
    
    public static function month_number($month) {
    	switch ($month) {
    		case 'Jan':
    		case 'jan':
    			$mm = '01';
    		break;
    		case 'Feb':
    		case 'feb':
    			$mm = '02';
    		break;
    		case 'Mar':
    		case 'mar':
    			$mm = '03';
    		break;
    		case 'Apr':
    		case 'apr':
    			$mm = '04';
    		break;
    		case 'May':
    		case 'may':
    			$mm = '05';
    		break;
    		case 'Jun':
    		case 'jun':
    			$mm = '06';
    		break;
    		case 'Jul':
    		case 'jul':
    			$mm = '07';
    		break;
    		case 'Aug':
    		case 'aug':
    			$mm = '08';
    		break;
    		case 'Sep':
    		case 'sep':
    			$mm = '09';
    		break;
    		case 'Oct':
    		case 'oct':
    			$mm = '10';
    		break;
    		case 'Nov':
    		case 'nov':
    			$mm = '11';
    		break;
    		case 'Dec':
    		case 'dec':
    			$mm = '12';
    		break;
    		default:
    			$mm = 0;
    	}
    	return ($mm);
    }
    
    public static function month_name($m) {
    	switch ($m) {
    		case 1:
    			$month = 'Jan';
    		break;
    		case 2:
    			$month = 'Feb';
    		break;
    		case 3:
    			$month = 'Mar';
    		break;
    		case 4:
    			$month = 'Apr';
    		break;
    		case 5:
    			$month = 'May';
    		break;
    		case 6:
    			$month = 'Jun';
    		break;
    		case 7:
    			$month = 'Jul';
    		break;
    		case 8:
    			$month = 'Aug';
    		break;
    		case 9:
    			$month = 'Sep';
    		break;
    		case 10:
    			$month = 'Oct';
    		break;
    		case 11:
    			$month = 'Nov';
    		break;
    		case 12:
    			$month = 'Dec';
    		break;
    		default:
    			$month = '';
    	}
    	return ($month);
    }
    
    public static function strtodate($str) {
    	list($m, $d, $y) = preg_split('/\s+/', $str);
    	switch (strtolower($m)) {
    		case 'jan':
    		case 'january':
    			$mm = 1;
    		break;
    		case 'feb':
    		case 'february':
    			$mm = 2;
    		break;
    		case 'mar':
    		case 'march':
    			$mm = 3;
    		break;
    		case 'apr':
    		case 'april':
    			$mm = 4;
    		break;
    		case 'may':
    			$mm = 5;
    		break;
    		case 'jun':
    		case 'june':
    			$mm = 6;
    		break;
    		case 'jul':
    		case 'july':
    			$mm = 7;
    		break;
    		case 'aug':
    		case 'august':
    			$mm = 8;
    		break;
    		case 'sep':
    		case 'september':
    			$mm = 9;
    		break;
    		case 'oct':
    		case 'october':
    			$mm = 10;
    		break;
    		case 'nov':
    		case 'november':
    			$mm = 11;
    		break;
    		case 'dec':
    		case 'december':
    			$mm = 12;
    		break;
    		default:
    			$mm = 0;
    	}
    	if (strlen($mm) == 1) $mm = '0' . $mm;
    	if (strlen($d) == 1) $d = '0' . $d;
    	return ("$y-$mm-$d");
    }
    
    public static function str_to_time($str) {
    	$time_stamp = strtotime($str);
    	//  $month_day=date("md",$time_stamp);
    	//  if ($month_day>"0921" || $month_day<"0221")
    	//    return ($time_stamp-12600);
    	//  else
    	//    return ($time_stamp-9000);
    	return ($time_stamp);
    }

    public static function str2date($timestr) {
    	//echo $timestr;
    	$items = preg_split('/-/', $timestr);
    	reset($items);
    	foreach ($items as $key => $val) {
    		if (strlen($val) == 4) $y = $val;
    		if (strlen($val) == 3) $m = $val;
    		if (strlen($val) == 2 || strlen($val) == 1) $d = $val;
    		if ($key >= 3) $t = $val;
    	}
    	return ("$y $m $d");
    	//  return("$m $d $y");
    	
    }
    
    public static function str2time($timestr) {
    	//  $items=preg_split('/-/',$timestr);
    	$itemss = preg_split('/\s+/', $timestr);
/*
    	reset($itemss);
    	foreach ($itemss as $key => $val) {
    		if (strlen($val) == 4) $y = $val;
    		if (strlen($val) == 3) $m = $val;
    		if (strlen($val) == 2 || strlen($val) == 1) $d = $val;
    		if ($key >= 3) $t = $val;
    	}
    	//  return(strtotime("$y $m $d $t"));
    	return (strtotime(strtotime("$m $d $y $t"));
*/
        return(strtotime($timestr));
    }
    
    public static function day_of_week($Day) {
    	switch ($Day) {
    		case 0:
    			return ("یکشنبه");
    		break;
    		case 1:
    			return ("دوشنبه");
    		break;
    		case 2:
    			return ("سه‌شنبه");
    		break;
    		case 3:
    			return ("چهارشنبه");
    		break;
    		case 4:
    			return ("پنجشنبه");
    		break;
    		case 5:
    			return ("جمعه");
    		break;
    		case 6:
    			return ("شنبه");
    		break;
    		default:
    			return ("");
    	}
    }
    
    public static function mtosh($HegiraDate, $reverse = false) {
    	$YY = substr($HegiraDate, 0, 4);
    	$MM = substr($HegiraDate, 5, 2);
    	$DD = substr($HegiraDate, 8, 2);
    	self::m2sh($YY, $MM, $DD);
    	if (strlen($MM) == 1) $MM = "0" . $MM;
    	if (strlen($DD) == 1) $DD = "0" . $DD;
    	if ($reverse) return ($YY . "/" . $MM . "/" . $DD);
    	else return ($DD . "/" . $MM . "/" . $YY);
    }
    
    public static function shtom($HegiraDate, $order = "mdy", $separator = "/", $input_reverse_order = true) {
    	if ($input_reverse_order) {
    		$DD = substr($HegiraDate, 0, strpos($HegiraDate, $separator));
    		$MM = substr($HegiraDate, strpos($HegiraDate, $separator) + 1, strpos($HegiraDate, $separator, strpos($HegiraDate, $separator) + 1) - strpos($HegiraDate, $separator) - 1);
    		$MM = substr($HegiraDate, strpos($HegiraDate, $separator, strpos($HegiraDate, $separator) + 1) + 1, 4);
    	}
    	else {
    		$YY = substr($HegiraDate, 0, strpos($HegiraDate, $separator));
    		$MM = substr($HegiraDate, strpos($HegiraDate, $separator) + 1, strpos($HegiraDate, $separator, strpos($HegiraDate, $separator) + 1) - strpos($HegiraDate, $separator) - 1);
    		$DD = substr($HegiraDate, strpos($HegiraDate, $separator, strpos($HegiraDate, $separator) + 1) + 1, 4);
    	}
    	if (strlen($YY) <= 2) $YY = "13" . $YY;
    	self::sh2m($YY, $MM, $DD);
    	if (strlen($MM) == 1) $MM = "0" . $MM;
    	if (strlen($DD) == 1) $DD = "0" . $DD;
    	$order = strtolower($order);
    	if ($order == "mdy") return ($MM . $separator . $DD . $separator . $YY);
    	else if ($order == "dmy") return ($DD . $separator . $MM . $separator . $YY);
    	else if ($order == "ymd") return ($YY . $separator . $MM . $separator . $DD);
    	else if ($order == "ydm") return ($YY . $separator . $DD . $separator . $MM);
    }
    
    public static function mod($A, $B) {
    	while ($A >= $B) $A = $A - $B;
    	return $A;
    }
    
}

?>
