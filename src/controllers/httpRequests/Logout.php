<?php
    require_once  __DIR__ ."/../../models/Utils.php";
    session_unset();
    session_destroy();
    _URL::redirect("login");
