<?php

/**
 * Author: Tom Geraghty
 * Date: 05/04/2018
 */
error_reporting(-1);
ini_set('display_error', 'On');


class DBConnection {
    private $connection;

    /*
     * Intializes connection
     */
    public function __construct($db, $host, $username, $password) {
        $this->connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);
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
        return $this->connection->prepare($sql)->execute();
    }

    /*
     * Deletes connection
     */
    public function closeConnection() {
        $this->connection = null;
    }
}
?>