<?
namespace zjTools\numberTools;

class formatNumber {
    public static function split($number, $separator = ',') {
        $numStr = (string)$number;
        $parts = explode('.', $numStr);
        $integerPart = $parts[0];
        $decimalPart = $parts[1] ?? '';
        $reversed = strrev($integerPart);
        $chunked = chunk_split($reversed, 3, $separator);
        $formattedInteger = strrev(rtrim($chunked, $separator));
        return $decimalPart !== '' ? $formattedInteger . '.' . $decimalPart : $formattedInteger;
    }
}

?>