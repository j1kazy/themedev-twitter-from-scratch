<?php require_once(__DIR__.'/../common/LoginManager.php'); ?>
<?php require_once(__DIR__.'/../common/common.php'); ?>
<?php 
LoginManager::Logout(); 
viewHeader();
?>


ログアウトしました。<br />
<br />
<a href="./user_login.php">ログイン画面へ</a>

<?php require_once(__DIR__ . '/../common/footer.php'); ?>