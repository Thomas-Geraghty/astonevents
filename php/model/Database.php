<?php
/**
 * Author: Tom Geraghty
 * Date: 06/04/2018
 */

require 'php/model/DBConnection.php';

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
    public function addRecord($table, $data) {
        // Data is array of tuple / key pair value.
        // INSERT INTO (table)((query) ) VALUES((values) )

        $fields = "";
        $values = "";
        $dataLength = count($data);
        $iterator = 0;

        foreach ($data as $key => $value) {
            $iterator++;
            $fields .= $key;
            $values .="'".$value."'";

            if($iterator < $dataLength) {
                $fields .= ", ";
                $values .= ", ";
            }
        }

        $query = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";

        $this->dbConnection->run($query);
    }

    /*
     * Updates record info in database.
     */
    public function updateRecord($table, $ID, $data) {
        $dataLength = count($data);
        $iterator = 0;
        $fields = "";

        foreach ($data as $key => $value) {
            $iterator++;
            $fields .= $key." = ".$value;
            if($iterator < $dataLength) {
                $fields .= ", ";
            }
        }

        $sql = "UPDATE ".$table. " SET " .$fields." WHERE ID = ".$ID;
        $this->dbConnection->run($sql);
    }

    public function fetchRecord()

    /*
     * Removes data into table, data array must be passed as a tuple (key => value)
     * First parameter is for the table, second is for the data array.
     */
    public function deleteRecord($table, $ID) {
        // Data array of tuple / key pair value.
        // DELETE FROM (table) WHERE (query) = (value)

        $sql = "DELETE FROM ".$table." WHERE ID = ".$ID;
        $this->dbConnection->run($sql);
    }

}
?>