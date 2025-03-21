<?
// 19 Mar 2025: Detached from dateTimeFormat class.

namespace zoj-tools\dateTimeTools;

class shamsiDate {
    protected static function sh2m(&$Y, &$M, &$D) {
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
    
    protected static function m2sh(&$Y, &$M, &$D) {
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