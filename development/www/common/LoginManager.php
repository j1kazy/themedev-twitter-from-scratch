<?php


class LoginManager{
    

    public static function init(){
        session_start(); 
        session_regenerate_id(true);
    }

    // ログインしてたらTrue
    function isLogined(){
        return isset($_SESSION['login']);
    }


    static function Login($login_id, $name){
        $_SESSION['login'] = 1;
        $_SESSION['login_id'] = $login_id;
        $_SESSION['name'] = $name;
    }

    static function Logout(){
        $_SESSION = array();
        if(isset($_COOKIE[session_name()]) == true){
            setcookie(session_name(), '', time() - 42000, '/');
        }
        @session_destroy();
    }

    static function viewLoginBar(){

    }
}


LoginManager::init();