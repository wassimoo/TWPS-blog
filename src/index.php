<?php
require_once "controllers/Router.php";
require_once "models/dbConfig.php";
require_once "models/Session.php";

define("VIEWS_CTRL_DIR", "controllers/ViewGenerators/");
define("PWD", "AlphaSolutions1325FreeSight");


// Verify router singleton instantiation
if (!isset($_SESSION["router"])) {
    $_SESSION["router"] = Router::getInstance();
}

// verify database connector instantiation
if (!isset($_SESSION["dbc"])) {
    $port = 3306;
    $socket = "";
    $host = "127.0.0.1";
    $username = "twpsAdmin";
    $dbname = "twps";
    $_SESSION["dbc"] = new DB($port, $socket, $host, $username, $dbname);
}

//dispatch query
$tokens = $_SESSION["router"]->dispatch(array($_SERVER['REQUEST_URI']));
if(count($tokens) <= 1){
    require_once VIEWS_CTRL_DIR . "Home.php";
    return;
}

//take the proper action
switch ($tokens[1]) {
    case "login":
        redirectLogin();
        return;
    case "validate":
        require_once "controllers/httpRequests/LoginValidation.php";
        echo LoginValidation::validate() ? "true" : "false";
        return;
    case "bloglist":
        require_once "controllers/httpRequests/BlogList.php";
        echo BList::get();
        return;
    case "logout":
        require_once "controllers/httpRequests/Logout.php";
        return;
    case "articles":
        redirectArticle($tokens);
        return;
    case "updatecontent":
        require_once "controllers/httpRequests/updateContent.php";
        echo updateContent::update()? "true" : "false";
        break;
    case "new":
        require_once VIEWS_CTRL_DIR . "newArticle.php";
        break;
case "home":
    default:
        require_once VIEWS_CTRL_DIR . "Home.php";
        return;
}

/**
 * Login redirection
 *
 * Logic:
 * if not logged in
 *      take user to login page.
 * else
 *      take user to home page.
 */
function redirectLogin()
{
    if (!Session::LoadSession()) {
        require_once VIEWS_CTRL_DIR . "Login.php";
    } else {
        header("Location: home");
    }
}

/**
 *  Article redirection
 *
 * @param $tokens array of tokens returned by dispatcher
 * LOGIC:
 *      if article id is specified
 *          if it exists
 *              redirect user.
 *          else
 *              404
 *      else
 *              redirect user to home.
 */
function redirectArticle($tokens)
{
    if (count($tokens) < 3) {
        header("Location: http://localhost/blog/home");
    } else if (exists($tokens[2])) {
        $_GET = array("articlePageName" => $tokens[2]);
        require_once VIEWS_CTRL_DIR . "Article.php";
    } else {
        echo "can't find your article ";
        //TODO : 404.html
    }
}

/**
 * verifies Article exists
 *
 * @param $articleId string id
 * @return boolean exists or not
 */
function exists($articleTitle)
{
    require_once "models/Queries.php";

    $query = "SELECT COUNT(id) FROM article WHERE id = ?";
    $dbh = $_SESSION["dbc"]->establishConnection(PWD);

    try {
        $rows = Queries::performQuery($dbh, $query, array($articleTitle), "select");
        $dbh = null;
        return $rows[0][0] == 1;
    } catch (InvalidDataException $e) {
        return false;
    }
}