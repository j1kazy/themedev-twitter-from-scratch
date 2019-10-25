<?php
$_SESSION = array();
if(isset($_COOKIE[session_name()]) == true){
    setcookie(session_name(), '', time() - 42000, '/');
}
@session_destroy();
?>

<?php require_once(__DIR__ . '/../common/header.php'); ?>

ログアウトしました。<br />
<br />
<a href="./user_login.php">ログイン画面へ</a>

<?php require_once(__DIR__ . '/../common/footer.php'); ?>