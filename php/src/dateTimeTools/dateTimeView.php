<?
// 19 Mar 2025: Detached from dateTimeFormat class.

namespace zoj_tools\dateTimeTools;

use zoj_tools\farsiTools\fasiNumber;

class dateTimeView extends shamsiDate {
    
    public static function show_date_input($name, $time_set, $start_year = - 1, $end_year = 1, $onchange = '') {
    	if ($time_set == "") $time_set = time();
    	$y = date("Y", $time_set);
    	$m = date("m", $time_set);
    	$d = date("d", $time_set);
    	self::m2sh($y, $m, $d);
    	$y_base = date("Y", time());
    	$m_base = date("m", time());
    	$d_base = date("d", time());
    	self::m2sh($y_base, $m_base, $d_base);
    ?>
<select size="1" name="<?=$name ?>_d" class="content" style="margin-left: 1"<?=($onchange != '' ? ' onchange="' . $onchange . '"' : '') ?>>
<option<?=($d == "01" ? " selected" : "") ?>>01</option>
<option<?=($d == "02" ? " selected" : "") ?>>02</option>
<option<?=($d == "03" ? " selected" : "") ?>>03</option>
<option<?=($d == "04" ? " selected" : "") ?>>04</option>
<option<?=($d == "05" ? " selected" : "") ?>>05</option>
<option<?=($d == "06" ? " selected" : "") ?>>06</option>
<option<?=($d == "07" ? " selected" : "") ?>>07</option>
<option<?=($d == "08" ? " selected" : "") ?>>08</option>
<option<?=($d == "09" ? " selected" : "") ?>>09</option>
<option<?=($d == "10" ? " selected" : "") ?>>10</option>
<option<?=($d == "11" ? " selected" : "") ?>>11</option>
<option<?=($d == "12" ? " selected" : "") ?>>12</option>
<option<?=($d == "13" ? " selected" : "") ?>>13</option>
<option<?=($d == "14" ? " selected" : "") ?>>14</option>
<option<?=($d == "15" ? " selected" : "") ?>>15</option>
<option<?=($d == "16" ? " selected" : "") ?>>16</option>
<option<?=($d == "17" ? " selected" : "") ?>>17</option>
<option<?=($d == "18" ? " selected" : "") ?>>18</option>
<option<?=($d == "19" ? " selected" : "") ?>>19</option>
<option<?=($d == "20" ? " selected" : "") ?>>20</option>
<option<?=($d == "21" ? " selected" : "") ?>>21</option>
<option<?=($d == "22" ? " selected" : "") ?>>22</option>
<option<?=($d == "23" ? " selected" : "") ?>>23</option>
<option<?=($d == "24" ? " selected" : "") ?>>24</option>
<option<?=($d == "25" ? " selected" : "") ?>>25</option>
<option<?=($d == "26" ? " selected" : "") ?>>26</option>
<option<?=($d == "27" ? " selected" : "") ?>>27</option>
<option<?=($d == "28" ? " selected" : "") ?>>28</option>
<option<?=($d == "29" ? " selected" : "") ?>>29</option>
<option<?=($d == "30" ? " selected" : "") ?>>30</option>
<option<?=($d == "31" ? " selected" : "") ?>>31</option>
</select>
<select size="1" name="<?=$name ?>_m" class="content" style="margin-left: 1; margin-right: 1">
<option value="01"<?=($m == "01" ? " selected" : "") ?>>فروردین</option>
<option value="02"<?=($m == "02" ? " selected" : "") ?>>اردیبهشت</option>
<option value="03"<?=($m == "03" ? " selected" : "") ?>>خرداد</option>
<option value="04"<?=($m == "04" ? " selected" : "") ?>>تیر</option>
<option value="05"<?=($m == "05" ? " selected" : "") ?>>مرداد</option>
<option value="06"<?=($m == "06" ? " selected" : "") ?>>شهریور</option>
<option value="07"<?=($m == "07" ? " selected" : "") ?>>مهر</option>
<option value="08"<?=($m == "08" ? " selected" : "") ?>>آبان</option>
<option value="09"<?=($m == "09" ? " selected" : "") ?>>آذر</option>
<option value="10"<?=($m == "10" ? " selected" : "") ?>>دی</option>
<option value="11"<?=($m == "11" ? " selected" : "") ?>>بهمن</option>
<option value="12"<?=($m == "12" ? " selected" : "") ?>>اسفند</option>
</select>
<select size="1" name="<?=$name ?>_y" class="content" style="margin-right: 1">
    <?
    	for ($i = $y_base + $start_year;$i <= $y_base + $end_year;$i++) echo '<option' . ($i == $y ? " selected" : "") . '>' . $i . '</option>';
    ?>
</select>
    <?
    }
    
    public static function show_date_month_input($name, $time_set, $start_year = - 1, $end_year = 1) {
    	if ($time_set == "") $time_set = time();
    	$y = date("Y", $time_set);
    	$m = date("m", $time_set);
    	$d = date("d", $time_set);
    	self::m2sh($y, $m, $d);
    	$y_base = date("Y", time());
    	$m_base = date("m", time());
    	$d_base = date("d", time());
    	self::m2sh($y_base, $m_base, $d_base);
    ?>
<select size="1" name="<?=$name ?>_m" class="content" style="margin-left: 1; margin-right: 1">
<option value="01"<?=($m == "01" ? " selected" : "") ?>>فروردین</option>
<option value="02"<?=($m == "02" ? " selected" : "") ?>>اردیبهشت</option>
<option value="03"<?=($m == "03" ? " selected" : "") ?>>خرداد</option>
<option value="04"<?=($m == "04" ? " selected" : "") ?>>تیر</option>
<option value="05"<?=($m == "05" ? " selected" : "") ?>>مرداد</option>
<option value="06"<?=($m == "06" ? " selected" : "") ?>>شهریور</option>
<option value="07"<?=($m == "07" ? " selected" : "") ?>>مهر</option>
<option value="08"<?=($m == "08" ? " selected" : "") ?>>آبان</option>
<option value="09"<?=($m == "09" ? " selected" : "") ?>>آذر</option>
<option value="10"<?=($m == "10" ? " selected" : "") ?>>دی</option>
<option value="11"<?=($m == "11" ? " selected" : "") ?>>بهمن</option>
<option value="12"<?=($m == "12" ? " selected" : "") ?>>اسفند</option>
</select>
<select size="1" name="<?=$name ?>_y" class="content" style="margin-right: 1">
    <?
    	for ($i = $y_base + $start_year;$i <= $y_base + $end_year;$i++) echo '<option' . ($i == $y ? " selected" : "") . '>' . $i . '</option>';
    ?>
</select>
    <?
    }
    
    public static function show_date_input_from_string($name, $time_set, $start_year = - 1, $end_year = 1) {
    	if ($time_set != "") {
    		$y = substr($time_set, 0, 4);
    		$m = substr($time_set, 5, 2);
    		$d = substr($time_set, 8, 2);
    		self::m2sh($y, $m, $d);
    	}
    	$yy = date("Y", time());
    	$mm = date("m", $time_set);
    	$dd = date("d", $time_set);
    	self::m2sh($yy, $mm, $dd);
    ?>
<select size="1" name="<?=$name ?>_d" class="content" style="margin-left: 1">
    <?
    	if ($time_set == "") {
    ?>
<option value="0" selected></option>
    <?
    	}
    ?>
<option<?=($d == "01" ? " selected" : "") ?>>01</option>
<option<?=($d == "02" ? " selected" : "") ?>>02</option>
<option<?=($d == "03" ? " selected" : "") ?>>03</option>
<option<?=($d == "04" ? " selected" : "") ?>>04</option>
<option<?=($d == "05" ? " selected" : "") ?>>05</option>
<option<?=($d == "06" ? " selected" : "") ?>>06</option>
<option<?=($d == "07" ? " selected" : "") ?>>07</option>
<option<?=($d == "08" ? " selected" : "") ?>>08</option>
<option<?=($d == "09" ? " selected" : "") ?>>09</option>
<option<?=($d == "10" ? " selected" : "") ?>>10</option>
<option<?=($d == "11" ? " selected" : "") ?>>11</option>
<option<?=($d == "12" ? " selected" : "") ?>>12</option>
<option<?=($d == "13" ? " selected" : "") ?>>13</option>
<option<?=($d == "14" ? " selected" : "") ?>>14</option>
<option<?=($d == "15" ? " selected" : "") ?>>15</option>
<option<?=($d == "16" ? " selected" : "") ?>>16</option>
<option<?=($d == "17" ? " selected" : "") ?>>17</option>
<option<?=($d == "18" ? " selected" : "") ?>>18</option>
<option<?=($d == "19" ? " selected" : "") ?>>19</option>
<option<?=($d == "20" ? " selected" : "") ?>>20</option>
<option<?=($d == "21" ? " selected" : "") ?>>21</option>
<option<?=($d == "22" ? " selected" : "") ?>>22</option>
<option<?=($d == "23" ? " selected" : "") ?>>23</option>
<option<?=($d == "24" ? " selected" : "") ?>>24</option>
<option<?=($d == "25" ? " selected" : "") ?>>25</option>
<option<?=($d == "26" ? " selected" : "") ?>>26</option>
<option<?=($d == "27" ? " selected" : "") ?>>27</option>
<option<?=($d == "28" ? " selected" : "") ?>>28</option>
<option<?=($d == "29" ? " selected" : "") ?>>29</option>
<option<?=($d == "30" ? " selected" : "") ?>>30</option>
<option<?=($d == "31" ? " selected" : "") ?>>31</option>
</select>
<select size="1" name="<?=$name ?>_m" class="content" style="margin-left: 1; margin-right: 1">
    <?
    	if ($time_set == "") {
    ?>
<option value="0" selected></option>
    <?
    	}
    ?>
<option value="01"<?=($m == "01" ? " selected" : "") ?>>فروردین</option>
<option value="02"<?=($m == "02" ? " selected" : "") ?>>اردیبهشت</option>
<option value="03"<?=($m == "03" ? " selected" : "") ?>>خرداد</option>
<option value="04"<?=($m == "04" ? " selected" : "") ?>>تیر</option>
<option value="05"<?=($m == "05" ? " selected" : "") ?>>مرداد</option>
<option value="06"<?=($m == "06" ? " selected" : "") ?>>شهریور</option>
<option value="07"<?=($m == "07" ? " selected" : "") ?>>مهر</option>
<option value="08"<?=($m == "08" ? " selected" : "") ?>>آبان</option>
<option value="09"<?=($m == "09" ? " selected" : "") ?>>آذر</option>
<option value="10"<?=($m == "10" ? " selected" : "") ?>>دی</option>
<option value="11"<?=($m == "11" ? " selected" : "") ?>>بهمن</option>
<option value="12"<?=($m == "12" ? " selected" : "") ?>>اسفند</option>
</select>
<select size="1" name="<?=$name ?>_y" class="content" style="margin-right: 1">
    <?
    	if ($time_set == "") {
    ?>
<option value="0" selected></option>
    <?
    	}
    	for ($i = $yy + $start_year;$i <= $yy + $end_year;$i++) echo '<option' . ($i == $y ? " selected" : "") . '>' . $i . '</option>';
    ?>
</select>
    <?
    }
    private static function sh2m(&$Y, &$M, &$D) {
    
    	$A[1] = 20;
    	$A[2] = 20;
    	$A[3] = 21;
    	$A[4] = 21;
    	$A[5] = 22;
    	$A[6] = 22;
    	$A[7] = 22;
    	$A[8] = 22;
    	$A[9] = 21;
    	$A[10] = 21;
    	$A[11] = 20;
    	$A[12] = 19;
    	$CM[1] = 31;
    	$CM[2] = 30;
    	$CM[3] = 31;
    	$CM[4] = 30;
    	$CM[5] = 31;
    	$CM[6] = 31;
    	$CM[7] = 30;
    	$CM[8] = 31;
    	$CM[9] = 30;
    	$CM[10] = 31;
    	$CM[11] = 31;
    	$CM[12] = 28;
    
    	if (($Y - 1375) % 4 == 0) for ($i = 1;$i <= 12;$i++) $A[$i] = $A[$i] - 1;
    	$D = $D + $A[(int)$M];
    	$M = $M + 2;
    	$Y = $Y + 621;
    
    	if ($D > $CM[$M - 2]) {
    		$D = $D - $CM[$M - 2];
    		$M = $M + 1;
    	}
    	if ($M > 12) {
    		$M = $M - 12;
    		$Y = $Y + 1;
    	}
    	return 1;
    }
    
    private static function m2sh(&$Y, &$M, &$D) {
    	$A[1] = 10;
    	$A[2] = 11;
    	$A[3] = 9;
    	$A[4] = 11;
    	$A[5] = 10;
    	$A[6] = 10;
    	$A[7] = 9;
    	$A[8] = 9;
    	$A[9] = 9;
    	$A[10] = 8;
    	$A[11] = 9;
    	$A[12] = 9;
    	$CM[1] = 30;
    	$CM[2] = 30;
    	$CM[3] = 29;
    	$CM[4] = 31;
    	$CM[5] = 31;
    	$CM[6] = 31;
    	$CM[7] = 31;
    	$CM[8] = 31;
    	$CM[9] = 31;
    	$CM[10] = 30;
    	$CM[11] = 30;
    	$CM[12] = 30;
    
    	if ($Y % 4 == 0) for ($i = 3;$i <= 12;$i++) $A[$i] = $A[$i] + 1;
    	if ($Y % 4 == 1) {
    		for ($i = 1;$i <= 3;$i++) $A[$i] = $A[$i] + 1;
    		$CM[3] = 30;
    	}
    	$D = $D + $A[(int)$M];
    	$M = $M + 9;
    	$Y = $Y - 622;
    	if ($D > $CM[$M - 9]) {
    		$D = $D - $CM[$M - 9];
    		$M = $M + 1;
    	}
    	if ($M > 12) {
    		$M = $M - 12;
    		$Y = $Y + 1;
    	}
    	return 1;
    }
}

?>
