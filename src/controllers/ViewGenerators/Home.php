<?php
/**
 * Created by PhpStorm.
 * User: wassim
 * Date: 25/01/18
 * Time: 15:59
 */

require_once __DIR__ . "/../../models/Session.php";

session_start();

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

echo "Hello from Home ";

if (Session::LoadSession()) {

    echo "<a href='logout'>you can logout </a>";
}
