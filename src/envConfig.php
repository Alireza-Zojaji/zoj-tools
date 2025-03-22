<?
namespace ZojTools;

class envConfig {
    private $db_host = "";
    private $db_user="";
    private $db_password="";
    private $db_name="";
    public $db_link;
    
    public static function init() {
        if (self::$db_link === null) {
            self::$db_link = mysqli_connect(self::$db_host, self::$db_user, self::$db_password, self::$db_name);

            if (self::$db_link->connect_error) {
                die("Database connection failed: " . self::$db_link->connect_error);
            }
        }
    }
    
    public static $smtp_host = "";
    public static $smtp_user_name = "";
    public static $smtp_user_password = "";
    public static $smtp_port = 465;
    public static $smtp_secure = 'tls';
    
    public static $sms_api_key = '7965525139574B4A683835633633504B392B4774564E33546C4B4F7868526339656B714472624A716B51493D';
    public static $sms_sender_number='10002174385000';
}

?>