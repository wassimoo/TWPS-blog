<?php
/**
 * Created by PhpStorm.
 * User: wassim
 * Date: 14/01/18
 * Time: 23:24
 */

require_once "Utils.php";

class Session
{
    /*
     * Carries :
     *  user_id
     *  session_id
     *  last_activity
     */

    /**
     * Load Existing Session, Check for timeout, regenerate_id and redirect to login page if necessary
     * @param int $activityTimeOut last activity time out interval value in seconds
     * @param int $last_reg_time last refresh time out interval value in seconds
     * @return boolean true | false stating session state (valid or not ).
     */

    public static function LoadSession()
    {
        if(!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['last_activity']) || !isset($_SESSION['last_reg_time']) || !isset($_SESSION['username']) || !isset($_SESSION["dbc"]))
        {
            //something is wrong! login again
            return false;
        } else {
            //Verify session is still valid ( last activity < 2 hours ago )
            if ($_SESSION['last_activity'] < time() - 60 * 60 * 2) {
                session_unset();
                session_destroy();
                return false;
            } else {
                // Session is valid
                // is it time to update session id ??
                if (!isset($_SESSION['last_reg_time'])) {
                    self::regenerateId();
                } else if ($_SESSION['last_reg_time'] > time() - 60 * 2) {
                    //10 minutes without refreshing page !
                    self::regenerateId();
                }
            }
        }
        return true;
    }

    public static function resetSession($username)
    {
        $_SESSION['username'] = $username;
        $_SESSION['last_activity'] = time();
        $_SESSION['last_reg_time'] = time();
    }

    public static function regenerateId()
    {
        // Call session_create_id() while session is active to
        // make sure collision free.
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

        //regenrate session id
        session_regenerate_id(false);
        
        // get new session id 
        $newid = session_id();

        // Finish session
        session_commit();


        // Set new custom session ID
        session_id($newid);

        // Start with custom session ID
        session_start();

        // Set deleted timestamp. Session data must not be deleted immediately for reasons.
        $_SESSION['last_reg_time'] = time();


    }
}
