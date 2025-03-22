<?
namespace ZojTools;
class envConfig {
    // DB
    private static $db_host = "";
    private static $db_user="";
    private static $db_password="";
    private static $db_name="";
    public static $db_link;
    
    // SMTP
    public static $smtp_host = "";
    public static $smtp_user_name = "";
    public static $smtp_user_password = "";
    public static $smtp_port = 465;
    public static $smtp_secure = 'tls';
    
    // SMS
    public static $sms_api_key = '';
    public static $sms_sender_number='';

    public static function init() {
        if (self::$db_link === null) {
            self::$db_link = mysqli_connect(self::$db_host, self::$db_user, self::$db_password, self::$db_name);

            if (self::$db_link->connect_error) {
                die("Database connection failed: " . self::$db_link->connect_error);
            }
        }
    }
}

?>