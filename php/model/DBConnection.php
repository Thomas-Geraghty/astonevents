<?php

/**
 * Author: Tom Geraghty
 * Date: 05/04/2018
 */


/**
 * Class DBConnection
 * Generates a connection to the database,
 */
class DBConnection {
    private $connection;

    /*
     * Intializes connection
     */
    public function __construct($db, $host, $username, $password) {
        $this->connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /*
     * Kills connection upon all object references being removed,
     */
    public function __destruct()
    {
        $this->closeConnection();
    }

    /*
     * Returns this connection.
     */
    public function getConnection() {
        return $this->connection;
    }

    /*
     * Execute SQL statement.
     */
    public function run($sql) {
        $this->connection->exec($sql);
    }

    /*
     * Deletes connection
     */
    public function closeConnection() {
        $this->connection = null;
    }
}
?>