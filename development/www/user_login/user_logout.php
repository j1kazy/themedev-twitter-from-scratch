<?php
require_once(__DIR__ . '/../common/common.php');

$_SESSION = array();
if(isset($_COOKIE[session_name()]) == true){
    setcookie(session_name(), '', time() - 42000, '/');
}
@session_destroy();

viewHeader('ログアウト', false);
?>

ログアウトしました。<br />
<br />
<a href="./user_login.php">ログイン画面へ</a>

<?php viewFooter(); ?>