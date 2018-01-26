<?php
/**
 * Created by PhpStorm.
 * User: wassim
 * Date: 25/01/18
 * Time: 04:52
 */

require_once __DIR__ . "/../../models/dbConfig.php";
require_once __DIR__ . "/../../models/Queries.php";

class LoginValidation
{
    public static function validate()
    {
        if (isset($_SESSION["username"])) {
            return true;
        }

        if (!isset($_POST['id']) || !isset($_POST['pwd'])) {
            return false;
        }

        $port = 3306;
        $socket = "";
        $host = "127.0.0.1";
        $username = "twpsAdmin";
        $dbname = "twps";
        $password = "AlphaSolutions1325FreeSight";

        $db = new DB($port, $socket, $host, $username, $dbname);
        try {
            $dbh = $db->establishConnection($password);
            $query = "SELECT COUNT(username) AS COUNTS FROM admin WHERE username = ? AND password  = ? ";
            $rows = Queries::performQuery($dbh, $query, array($_POST['id'], $_POST['pwd']), "select");

            if ($rows[0][0] == 1) {
                $_SESSION["dbc"] = $db;
                $_SESSION["username"] = $_POST['id'];
                return true;
            } else {
                $db = null;
                return false;
            }
        } catch (PDOException $e) {
            return false;
            error_log("Couldn't connect to database PDOException returned..", 2);
        } catch (InvalidDataException $e) {
            return false;
            error_log("couldn't continue performing query , Data is invalid ", 1);
        }
    }
}
