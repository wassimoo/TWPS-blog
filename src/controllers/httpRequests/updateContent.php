<?php
/**
 * Created by PhpStorm.
 * User: wassim
 * Date: 04/02/18
 * Time: 02:26
 */
require_once __DIR__ . "/../../models/dbConfig.php";
require_once __DIR__ . "/../../models/Queries.php";
require_once __DIR__ . "/../../models/Session.php";

session_start();

class updateContent
{
    public static function update()
    {

        if (!Session::LoadSession()) {
            return false;
        }

        if (!isset($_SESSION["id"]) || !isset($_SESSION["title"]) || !isset($_SESSION["content"]) || !isset($_SESSION["coverLink"])) {
            if (!isset($_POST["id"]) || !isset($_POST["title"]) || !isset($_POST["content"]) || !isset($_POST["cover"])) {
                return false;
            } else {
                $_POST["title"] = trim(preg_replace('/\s+/', ' ',$_POST["title"]));
                $_POST["title"] = strtolower($_POST["title"]);
                //if http origins is new , ignore given id ; 
                //TODO : replace with server domain
                $_SESSION["id"] = $_SERVER["HTTP_REFERER"] == "http://localhost/blog/new" ? str_replace(' ','-',$_POST["title"]) :  $_POST["id"];
                $_SESSION["title"] = $_POST["title"];
                $_SESSION["content"] = $_POST["content"];
                $_SESSION["coverLink"] = $_POST["cover"];
            }
        }

        //verify DB configuration instance
        DB::setupConnector();

        try {
            // create connection instance
            $dbh = $_SESSION["dbc"]->establishConnection(PWD);
            // verify if article already exists
            $query = "SELECT count(id) FROM article where id = ?";
            $rows = Queries::performQuery($dbh, $query, array($_SESSION["id"]), "select");
            if ($rows[0][0] != 1){
                //insert new article ;
                $query = "INSERT INTO article(id,content,admin_username,title,banner_link) values(?,?,?,?,?)";
                $data = array($_SESSION["id"], $_SESSION["content"], $_SESSION["username"], $_SESSION["title"], $_SESSION["coverLink"]);
                $type = "insert";
            }else {
                //update article ;
                $query = "UPDATE twps.article SET content = ?, title= ?, banner_link= ? WHERE id = ?";
                $data = array($_SESSION["content"], $_SESSION["title"], $_SESSION["coverLink"], $_SESSION["id"]);
                $type = "update";
            }
            unset($_SESSION["id"]);
            unset($_POST["id"]);
            unset($_SESSION["title"]);
            unset($_POST["title"]);
            unset($_SESSION["content"]);
            unset($_POST["content"]);
            unset($_SESSION["coverLink"]);
            unset($_POST["cover"]);
            return Queries::performQuery($dbh, $query, $data, $type);
            
        } catch (PDOException $e) {
            error_log("Couldn't connect to database PDOException returned..", 2);
            return false;
        } catch (InvalidDataException $e) {
            error_log("couldn't continue performing query , Data is invalid ", 1);
            return false;
        }
    }
}
