<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBConnection
 *
 * @author Mahder
 */
class DBConnection {

    public static function connect()
    {
        $server = "localhost";
        $username = "root";
        $password = "root";
        @$connection = mysql_pconnect($server, $username, $password);
        return $connection;
    }

    public static function executeQuery($query)
    {
        $dbConnection = DBConnection::connect();
        mysql_select_db("dbstaff_ld", $dbConnection);
        $result = mysql_query($query);
        return $result;
    }

    public static function readFromDatabase($query)/*returns the records read from the database*/
    {
        $result = DBConnection::executeQuery($query);
        return $result;
    }
}//end class
?>
