<?php
/**
 * Created by PhpStorm.
 * User: wassim
 * Date: 25/01/18
 * Time: 15:59
 */

require_once __DIR__ . "/../../models/Session.php";
require_once __DIR__ . "/../../models/importTwig.php";
require_once __DIR__ . "/../../models/Queries.php";



// in case of incompleted submission
/*
if (isset($_SESSION["id"]) && isset($_SESSION["title"]) && isset($_SESSION["content"]) && isset($_SESSION["coverLink"])) {
    //User content update was interrupted..
    //TODO : change to server domain
    if (Session::LoadSession()) {
        header("Location: http://localhost/updatecontent");
    }
    else {
        echo "you were trying to  submit an article .. contrinue ?";
    }

    return;
}
*/


//verify DB configuration instance
DB::setupConnector();


// create connection instancee7lef
$dbh = $_SESSION["dbc"]->establishConnection(PWD);
$query = "SELECT ceil(count(id) / ?) FROM article";
$rows = Queries::performQuery($dbh, $query, array(LIST_CAPACITY), "select");


$dbh = null;
$data = array(
    'isAdmin' => Session::LoadSession() ? "true" : "false" ,
    'domain' => "http://localhost/src/",
    'numPages' => $rows[0][0] 
);
echo TwigLib::bind("home.html",$data);
