/**
* Author: Tom Geraghty
* Date: 05/04/2018
*/

<?php

/**
 * Class database
 * Generates a connection to the database,
 */
class dbConnection {
    const HOST = "127.0.0.1";
    const DBNAME = "astonevents";
    const USERNAME = "tom";
    const PASSWORD = "geraghty";

    private $connection;

    /*
     * Intializes connection
     */
    public function __construct() {
        $host = self::HOST;
        $db = self::DBNAME;
        $username = self::USERNAME;
        $password = self::PASSWORD;
        $this->connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);
    }

    /*
     * Returns this connection.
     */
    public function getConnection() {
        return $this->connection;
    }

    /*
     * Deletes connection
     */
    public function closeConnection() {
        $this->connection = null;
    }

    /*
     * Kills connection upon all object references being removed,
     */
    public function __destruct()
    {
        $this->closeConnection();
    }
}
?>