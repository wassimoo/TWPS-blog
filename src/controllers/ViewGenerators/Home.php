<?php
/**
 * Created by PhpStorm.
 * User: wassim
 * Date: 25/01/18
 * Time: 15:59
 */

require_once __DIR__ . "/../../models/Session.php";

session_start();

    echo "Hello from Home ";

    if (Session::LoadSession()) {
        
        echo "<a href='logout'>you can logout </a>";
    }