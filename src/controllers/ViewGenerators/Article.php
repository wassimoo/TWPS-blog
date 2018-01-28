<?php

require_once __DIR__ . "/../../models/importTwig.php";
require_once __DIR__ . "/../../models/Queries.php";
require_once __DIR__ . "/../../models/Session.php";
require_once __DIR__ . "/../../models/dbConfig.php";

//verify DB configuration instance
DB::setupConnector();

Session::LoadSession();

// create connection instance
$dbh = $_SESSION["dbc"]->establishConnection(PWD);

try{
    $query = "SELECT article.*, name, last_name FROM twps.article 
              INNER JOIN twps.admin ON admin.username LIKE article.admin_username
              WHERE title =  ? ";
    $rows = Queries::performQuery($dbh,$query,array($_GET["articlePageName"]),"select");

    $auth = $rows[0]["last_name"]." ".$rows[0]["name"];
    $banner = $rows[0]["banner_link"];
    $content = $rows[0]["content"];
    $date = strtotime($rows[0]["creation_date"]);
    $date = date('d-m-Y à H', $date)."h";

    $data = array(
        "title" => ucfirst($_GET["articlePageName"]),
        "auth" =>  $auth,
        "date" => $date,
        "banner" => $banner,
        "content" => $content,
        "isAdmin" => isset($_SESSION["username"]) ? "true" : "false",
        "domain" => "../.."
    );
    // TODO : add recent posts ; 
    echo TwigLib::bind("article.html",$data);
}catch (invalidDataException $e){
    //TODO 404.html
    echo "something went wrong please contact your system administrator";
}