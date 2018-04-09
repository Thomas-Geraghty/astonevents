/**
* Author: Tom Geraghty
* Date: 06/04/2018
*/

<?php

class database {

    private $dbConnection = null;

    /*
     * Constructs new database object, with a connection to the relevant MySQL database.
     */
    public function __construct($name, $host, $username, $password) {
        $this->dbConnection = new DBConnection($name, $host, $username, $password);
    }

    /*
     * Closes database connection.
     */
    public function __destruct() {
        $this->dbConnection = null;
    }

    /*
     * Adds data into table, data array must be passed as a tuple (key => value)
     * First parameter is for the table, second is for the data array.
     */
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

    /*
     * Removes data into table, data array must be passed as a tuple (key => value)
     * First parameter is for the table, second is for the data array.
     */
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