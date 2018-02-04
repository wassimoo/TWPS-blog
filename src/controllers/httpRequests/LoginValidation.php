<?php
/**
 * Created by PhpStorm.
 * User: wassim
 * Date: 25/01/18
 * Time: 04:52
 */

require_once __DIR__ . "/../../models/dbConfig.php";
require_once __DIR__ . "/../../models/Queries.php";
require_once __DIR__ . "/../../models/Session.php";

class LoginValidation
{
    public static function validate()
    {
        if (Session::LoadSession()) {
           return true;
        }

        if (!isset($_POST['id']) || !isset($_POST['pwd'])) {
            return false;
        }

        DB::setupConnector();

        try {
            $dbh = $_SESSION["dbc"]->establishConnection(PWD);
            $query = "SELECT COUNT(username) AS COUNTS FROM admin WHERE username = ? AND password  = ? ";
            $rows = Queries::performQuery($dbh, $query, array($_POST['id'], $_POST['pwd']), "select");
            $dbh = null;
            if ($rows[0][0] == 1) {
                Session::resetSession($_POST['id']);
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Couldn't connect to database PDOException returned..", 2);
            return false;
        } catch (InvalidDataException $e) {
            error_log("couldn't continue performing query , Data is invalid ", 1);
            return false;
        }
    }
}
