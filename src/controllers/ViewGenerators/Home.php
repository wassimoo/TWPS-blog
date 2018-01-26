<?php
/**
 * Created by PhpStorm.
 * User: wassim
 * Date: 25/01/18
 * Time: 15:59
 */
session_start();
if (!isset($_SESSION["username"])) {
    require_once "Login.php";
} else {
    echo "Hello from Home";
    echo "<a href='logout'>you can logout </a>";
}
