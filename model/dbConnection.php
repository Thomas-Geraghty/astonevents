/**
* Author: Tom Geraghty
* Date: 05/04/2018
*/

<?php

/**
 * Class dbConnection
 * Generates a connection to the database,
 */
class dbConnection {
    private $connection;

    /*
     * Intializes connection
     */
    public function __construct($db, $host, $username, $password) {
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