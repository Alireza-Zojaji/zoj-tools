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
    
    public static $sms_api_key = '';
    public static $sms_sender_number='';
}

?>