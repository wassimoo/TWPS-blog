<?php
require_once "controllers/Router.php";
define("VIEWS_CTRL_DIR","controllers/ViewGenerators/");
session_start();

if (!isset($_SESSION["router"])) {
    $_SESSION["router"] = Router::getInstance();
}

switch ($_SESSION["router"]->dispatch(array($_SERVER['REQUEST_URI']))) {
    case "home":
        require_once VIEWS_CTRL_DIR."Home.php";
        return;
    case "login":
        if (!isset($_SESSION["username"])) {
            require_once VIEWS_CTRL_DIR."Login.php";
        } else {
            require_once VIEWS_CTRL_DIR."Home.php";
        }
        return;
    case "validate":
        require_once "controllers/httpRequests/LoginValidation.php";
        echo LoginValidation::validate() ? "true" : "false"; 
        return;
    case "logout":
        require_once "controllers/httpRequests/Logout.php";
        return;
    default:
        require_once  VIEWS_CTRL_DIR."Home.php";
        return;
}
