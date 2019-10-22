<?php
require_once(__DIR__ . '/common.php');

// ユーザーのログイン状態を確認し、ログイン情報を表示する
session_start();
session_regenerate_id(true);
// セッションの確認

if(isset($_SESSION['login']) == false){
    print 'ログインされていません。<br />';
    print '<a href="'.URL.'/user_login/user_login.php">ログイン画面へ</a>';
    exit();
}else {
    print $_SESSION['name'] . 'さんログイン中<br />';
    print '<br />';
    print '<a href="'.URL.'/user_login/user_logout.php">ログアウト</a><br />';
}