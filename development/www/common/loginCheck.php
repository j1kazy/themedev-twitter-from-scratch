<?php
session_start();
// セッションハイジャック対策にsession_regenerate_id(true);　セッションIDの変更をしたいが
// 毎回変更していると連続でアクセスするとセッションが破棄されてしまう問題が起きる。
// 回避策として、7秒以内はセッションIDを書き換えないこととした。
// $_SESSION['expires']はログイン時に最初に代入する
if ($_SESSION['expires'] < time() - 7) {
    session_regenerate_id(true);
    $_SESSION['expires'] = time();
}
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