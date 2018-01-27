<?php
require_once "controllers/Router.php";
require_once "models/Session.php";

define("VIEWS_CTRL_DIR","controllers/ViewGenerators/");

session_start();

if (!isset($_SESSION["router"])) {
    $_SESSION["router"] = Router::getInstance();
}

$tokens = $_SESSION["router"]->dispatch(array($_SERVER['REQUEST_URI']));
switch ($tokens[1]) {
    case "home":
        require_once VIEWS_CTRL_DIR."Home.php";
        return;
    case "login":
        redirectLogin();
        return;
    case "validate":
        require_once "controllers/httpRequests/LoginValidation.php";
        echo LoginValidation::validate() ? "true" : "false"; 
        return;
    case "logout":
        require_once "controllers/httpRequests/Logout.php";
        return;
    case "articles":
        redirectBlog($tokens);
        return;
    default:
        require_once  VIEWS_CTRL_DIR."Home.php";
        return;
}

function redirectLogin(){
    if (!Session::LoadSession()) {
        require_once VIEWS_CTRL_DIR."Login.php";
    } else {
        header("Location: home");
    }
}

function redirectblog($tokens){
    if($count($tokens) >= 3)
        $articleName = $tokens[2];    
}