<?php

/**
*session class
 */

class Session{

    public static function init(){
        session_start();
    }

    /**
     * set session variables
     *
     * @param [session key] $key
     * @param [session value] $val
     * @return void
     */
    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }

    /**
     * get session value by applying session key
     *
     * @param [session key] $key
     * @return void
     */
    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        else{
            return false;
        }
    }

    /**
     * check if session is false and return to login page
     *
     * @return void
     */
    public static function checkSession(){
        self::init();
        if(self::get("adminlogin") == false){
            self::destroy();
            header("Location:login.php");
        }
    }


    /**
     * destroy session
     *
     * @return void
     */
    public static function destroy(){
        session_destroy();
        header("Location:login.php");
    }

    public static function destroy1(){
        session_destroy();
        header("Location:pages/login.php");
    }

    /**
     * check if login is true
     *
     * @return void
     */
    public static function checklogin(){
        self::init();
        if(self::get("adminlogin") == true){
            header("Location:dashboard.php");
        }
    }
}




 ?>