<?php
/**
 * Created by PhpStorm.
 * User: wassim
 * Date: 25/01/18
 * Time: 15:59
 */

require_once __DIR__ . "/../../models/Session.php";
require_once __DIR__ . "/../../models/importTwig.php";

session_start();

// in case of incompleted submission
/*
if (isset($_SESSION["id"]) && isset($_SESSION["title"]) && isset($_SESSION["content"]) && isset($_SESSION["coverLink"])) {
    //User content update was interrupted..
    //TODO : change to server domain
    if (Session::LoadSession()) {
        header("Location: http://localhost/blog/updatecontent");
    }
    else {
        echo "you were trying to  submit an article .. contrinue ?";
    }

    return;
}
*/


//verify DB configuration instance
DB::setupConnector();


// create connection instance
$dbh = $_SESSION["dbc"]->establishConnection(PWD);

//TODO : continue from here ! 

$query = "SELECT coun FROM article order by creation_date desc LIMIT 0,3" ;

echo TwigLib::bind("home.html",array());

if (Session::LoadSession()) {

    echo "<a href='logout'>you can logout </a>";
}
