<?
namespace ZojTools\dbBase;

class dbBase {
    public static function get_row($db_link, $_query) {
        $_table = mysqli_query($db_link, $_query);
        $_row = mysqli_fetch_array($_table, MYSQLI_ASSOC);
        return($_row);
    }

    public static function get_field($db_link, $_query, $_field) {
        $_row = self::get_row($db_link, $_query);
        $_value=$_row[$_field];
        return($_value);
    }
}

?>