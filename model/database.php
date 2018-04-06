/**
* Created by IntelliJ IDEA.
* User: Tom
* Date: 06/04/2018
* Time: 16:03
*/

<?php

class database {

    private $DBNAME;
    private $HOST;
    private $USERNAME;
    private $PASSWORD;

    private $connection = null;

    /*
     * Constructs new database object, with a connection to the relevant MySQL database.
     */
    public function __construct($db, $host, $username, $password) {
        $this->DBNAME = $db;
        $this->HOST = $host;
        $this->USERNAME = $username;
        $this->PASSWORD = $password;
        $this->connection = new dbConnection($db, $host, $username, $password);
    }

    /*
     * Closes database connection.
     */
    public function __destruct()
    {
        $this->connection = null;
    }
}
?>