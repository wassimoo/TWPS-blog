<?php

    require_once __DIR__ . "/../../models/Session.php";
    require_once __DIR__ . "/../../models/importTwig.php";
    require_once __DIR__ . "/../../models/dbConfig.php";
    require_once __DIR__ . "/../../models/Queries.php";

    define("DEFAULT_BANNER","banners/default.jpg");
    session_start();
    
    if(!session::LoadSession()){
        header("Location: http://localhost/blog/login");
        //TODO : replace with server url;
                return;
    }

    $dbh = $_SESSION["dbc"]->establishConnection(PWD);

    try{
        $query = "SELECT name, last_name FROM admin where username = ?";
        $rows = Queries::performQuery($dbh,$query,array($_SESSION["username"]),"select");
        $auth = $rows[0]["last_name"]. " " . $rows[0]["name"];
        $banner = DEFAULT_BANNER;
        $content = "Le contenu de blog va se rendre içi";
        $title = "Titre ";
        $date =  date('d-m-Y à H')."h";
        $data = array(
        "title" => $title,
        "auth" =>  $auth,
        "date" => $date,
        "banner" => "http://localhost/blog/src/assets/images/".$banner,
        "content" => $content,
        "isAdmin" => isset($_SESSION["username"]) ? "true" : "false",
        "domain" => "http://localhost/blog/src/"
    );
        echo TwigLib::bind("article.html",$data);
    }catch (invalidDataException $e){
    //TODO 404.html
    echo "something went wrong please contact your system administrator";
}
catch (PDOException $e) {
    echo "couldn't establish connection to server ! please contact your system adminstrator";
}