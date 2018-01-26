<?php
require_once "controllers/Router.php";
session_start();

if (!isset($_SESSION["router"])) {
    $_SESSION["router"] = Router::getInstance();
}

switch ($_SESSION["router"]->dispatch(array($_SERVER['REQUEST_URI']))) {
    case "home":
        require_once "controllers/ViewGenerators/Home.php";
        return;
    case "login":
        if (!isset($_SESSION["username"])) {
            require_once "controllers/ViewGenerators/Login.php";
        } else {
            require_once "controllers/ViewGenerators/Home.php";
        }
        return;
    case "validate":
        require_once "controllers/httpRequests/LoginValidation.php";
        if (LoginValidation::validate()) {
            echo "true";
        } else {
            echo "false";
        }
        return;
    case "logout":
        require_once "controllers/httpRequests/Logout.php";
        return;
    default:
        require_once  "controllers/ViewGenerators/Home.php";
        return;
}
