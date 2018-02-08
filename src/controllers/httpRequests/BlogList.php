<?php

require_once __DIR__ . "/../../models/dbConfig.php";
require_once __DIR__ . "/../../models/Queries.php";
require_once __DIR__ . "/../../models/Session.php";

session_start();

class BList
{
    public static function get()
    {
        $page = isset($_SESSION["page"]) ? $_SESSION["page"] : 0;
        $to = $page  + 7;
        $blogList;
        try {
            DB::setupConnector();
            $query = "SELECt id,title,banner_link,creation_date FROM twps.article order by creation_date desc LIMIT ?,?";
            // create connection instance
            $dbh = $_SESSION["dbc"]->establishConnection(PWD);
            $rows = Queries::performQuery($dbh, $query, array($page,$to), "select");
            foreach ($rows as $row) {
                $img = $row["banner_link"];
                $title = $row["title"];
                $id = $row["id"];
                $date = date("d-m-Y",strtotime($row["creation_date"]));

                 $blogList .= 
                sprintf('<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 m-blog_list_single">
                        <div class="m-blog_list_img" style=" height: 200.562px;">
                          <img src="%s" class="img-responsive" alt="">
                        </div>
                        <div class="m-blog_list_details">
                          <h3>
                            <a href="articles/%s">%s</a>
                          </h3>
                          <div class="m-blog_list_info">
                            <span>Le: %s </span>
                          </div>
                        </div>
                </div>',$img,$id,$title,$date);
            }
        } catch (PDOException $e) {
            error_log("Couldn't connect to database PDOException returned..", 2);
            return false;
        } catch (InvalidDataException $e) {
            error_log("couldn't continue performing query , Data is invalid ", 1);
            return false;
        }

        return $blogList;
    }
}
