 <?php 
require_once('baseDeDonnees.class.php');

class BDDLocale extends BaseDeDonnees {
    
    //Instance statique du singleton
    private static $handle = null;
    
    public function __construct() {
        parent::__construct('localhost', 'travelExpress', 'root', 'root');
        parent::connect();
    }
    
    public static function getInstance() {
        if (is_null(self::$handle)) {
            self::$handle = new BDDLocale();
        }
        return self::$handle;
    }
}