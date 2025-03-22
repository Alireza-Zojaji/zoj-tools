<?
namespace ZojTools\stringTools;

class stringTools {
    public static function get_unique_id($digits=16, $type='hex') {
        mt_srand();
        if ($digits == 16 && $type == 'hex') {
            $id=md5(time() . '/' . microtime() . '/' . mt_rand(0, 10000000) . mt_rand(0, 10000000));
            return($id);
        } else {
            $id = '';
            for ($i = 1; $i <= $digits; $i ++) {
                $code = '';
                $max = self::get_max_limit($type);
                do
                    $code = floor(mt_rand(0, $max));
                while ($code == $max && $max>0);
                $char = self::get_char($code, $type);
                $id .= $char;
            }
        return($id);
        }
    }

    private static function get_max_limit($type) {
        $len = 0;
        switch ($type) {
            case 'hex':
                $len = 16;
            break;
            case 'Aa1':
                $len = 62;
            break;
            case 'a1':
            case 'A1':
                $len = 36;
            break;
            case 'Aa':
                $len = 52;
            break;
            case 'a':
            case 'A':
                $len = 26;
            break;
            case 'base64':
                $len = 64;
            break;
            case 'number':
            case '1':
                $len = 10;
            break;
        }
        return ($len);
    }    

    private static function get_char($code, $type) {
        $char = '';
        switch ($type) {
            case 'hex':
                if ($code >= 10) //number
                $char = chr($code + 48);
                else
                //a-f
                $char = chr($code + 87);
                break;
            case 'Aa1':
            case 'aA1':
                if ($code < 26) //capital letter
                $char = chr($code + 65);
                else if ($code < 52) //small letter
                $char = chr($code + 71);
                else
                //number
                $char = chr($code - 4);
                break;
            case 'a1':
                if ($code < 26) //small letter
                $char = chr($code + 97);
                else
                //number
                $char = chr($code + 22);
                break;
            case 'A1':
                if ($code < 26) //capital letter
                $char = chr($code + 65);
                else
                //number
                $char = chr($code + 22);
                break;
            case 'Aa':
                if ($code >= 26) //small letter
                $char = chr($code + 71);
                else
                //capital letter
                $char = chr($code + 65);
                break;
            case 'a':
                $char = chr($code + 97);
                break;
            case 'A':
                $char = chr($code + 65);
                break;
            case '1':
            case 'number':
                $char = chr($code + 48);
                break;
            case 'base64':
            case 'Aa1-_':
                if ($code < 26) //capital letter
                $char = chr($code + 65);
                else if ($code < 52) //small letter
                $char = chr($code + 71);
                else if ($code < 62) //number
                $char = chr($code - 4);
                else if ($code < 63) $char = '-';
                else $char = '_';
                break;
        }
        return ($char);
    }
}
?>