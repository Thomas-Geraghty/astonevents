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
        // Data is array of tuple / key pair value.
        // INSERT INTO (table)((query) ) VALUES((values) )

        $fields = "";
        $values = "";
        $dataLength = count($data);
        $iterator = 0;

        foreach ($data as $key => $value) {
            $iterator++;
            $fields .= $key;
            $values .= $value;

            if($iterator < $dataLength) {
                $fields .= ", ";
                $values .= ", ";
            }
        }

        $sql = "INSERT INTO ".$table."(".$fields.") VALUES(".$values.")";

        $this->dbConnection->run($sql);
    }

    public function removeData($table, $data) {
        // Data array of tuple / key pair value.
        // DELETE FROM (table) WHERE (query) = (value)

        $filters = "";
        $dataLength = count($data);
        $iterator = 0;

        foreach ($data as $key => $value) {
            $filters .= $key."=".$value;
            if($iterator < $dataLength) {
                $filters .= ", ";
            }
        }

        $sql = "DELETE FROM ".$table." WHERE ".$filters;
        $this->dbConnection->run($sql);
    }
}
?>