<?
namespace zoj-tools\farsiTools;

class farsiNumber {
    private static $fa_num = array('۱','۲','۳','۴','۵','۶','۷','۸','۹','۰');
    private static $en_num = array('1','2','3','4','5','6','7','8','9','0');

    public static function number_fa2en($number) {
        $number=str_replace(self :: $fa_num, self :: $en_num, $number);
        $number=str_replace("<sub>/</sub>",".",$number);
        $number=str_replace("/",".",$number);
        return($number);
    }

    public static function number_en2fa($number, $point_change = true) {
        $number=str_replace(self :: $en_num, self :: $fa_num, $number);
        if ($point_change)
            $number=str_replace(".","<sub>/</sub>",$number);
        return($number);
    }
}

?>