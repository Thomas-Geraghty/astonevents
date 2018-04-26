<?php
/**
 * Author: Tom Geraghty
 * Date: 09/04/2018
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/model/Database.php';

class Config {

    const dbName = "astonevents";
    const dbHost = "127.0.0.1";
    const username = "root";
    const password = "geraghty";
    private static $database = null;

    /*
     * Constructs a database object accessible through this
     * class and its methods.
     */
    public function __construct() {
        $this->setupDB();
    }

    static function setupDB() {
        self::$database = new Database (
            self::dbName,
            self::dbHost,
            self::username,
            self::password
        );
    }

    /*
     * Returns database.
     */
    public static function getDatabase() {
        if (self::$database == null) {
            self::setupDB();
        }
        return self::$database;
    }
}
?>