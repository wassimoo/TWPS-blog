<?php
require_once "controllers/Router.php";
session_start();

if (!isset($_SESSION["router"])) {
    $_SESSION["router"] = Router::getInstance();
}

$_SESSION["router"]->dispatch(array($_SERVER['REQUEST_URI']));