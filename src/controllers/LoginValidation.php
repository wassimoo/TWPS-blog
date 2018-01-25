<?php
/**
 * Created by PhpStorm.
 * User: wassim
 * Date: 25/01/18
 * Time: 04:52
 */

require_once __DIR__ . "../models/dbConfig.php";
require_once __DIR__ . "../models/Queries.php";

if (!isset($_POST['id']) || !isset($_POST['pwd'])) {
    echo false;
}

$port = 3306;
$socket = "";
$host = "127.0.0.1";
$username = "twpsAdmin";
$dbname = "twps";
$password = "AlphaSolutions1325FreeSight";

$_SESSION["dbc"] = new DB($port, $socket, $host, $username, $dbname);
try {
    $dbh = $_SESSION["dbc"]->establishConnection($password);
    $query = "SELECT COUNT(username) AS COUNTS FROM admin WHERE username = ? AND password  = ? ";
    $rows = Queries::performQuery($dbh, $query, Array($_POST['id'], $_POST['pwd']), "select");
    echo $rows[0][0] == 1;
} catch (PDOException $e) {
    echo false;
    error_log("Couldn't connect to database PDOException returned..", 2);
} catch (InvalidDataException $e) {
    echo false;
    error_log("couldn't continue performing query , Data is invalid ", 1);
}

