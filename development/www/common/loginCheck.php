<?php
session_start();
session_regenerate_id(true);
require_once(__DIR__ . '/common.php');

// ログインしているか　trueでログイン済み
function isLogined(){
    return isset($_SESSION['login']);
}

// ログインしていない場合はログイン画面へリダイレクト
function loginCheck(){
    if(isLogined() === false){
        viewHeader();
        
        echo 'ログインされていません。<br />
        <a href="'.URL.'/user_login/user_login.php">ログイン画面へ</a>';

        viewFooter();
        exit();
    }
}