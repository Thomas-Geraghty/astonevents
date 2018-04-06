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

    private $dbConnection = null;

    /*
     * Constructs new database object, with a connection to the relevant MySQL database.
     */
    public function __construct($db, $host, $username, $password) {
        $this->DBNAME = $db;
        $this->HOST = $host;
        $this->USERNAME = $username;
        $this->PASSWORD = $password;
        $this->dbConnection = new dbConnection($db, $host, $username, $password);
    }

    /*
     * Closes database connection.
     */
    public function __destruct()
    {
        $this->dbConnection = null;
    }

    public function addData($table, $data) {
        // Data is tuple / key pair value.
        // INSERT INTO (table)((query) ) VALUES((values) )

        $fields = "";
        $values = "";

        foreach ($data as $key => $value) {
            $fields .= $key;
            $values .= $value;

            $fields .= ", ";
            $values .= ", ";
        }

        $command = "INSERT INTO".$table."(".$fields.") VALUES(".$values.")";

        $this->dbConnection->run($command);
    }
}
?>