/**
* Author: Tom Geraghty
* Date: 09/04/2018
*/

<?php

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
        return self::$database;
    }
}
?>