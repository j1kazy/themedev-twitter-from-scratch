<?php require_once(__DIR__ . '/../common/header.php') ?>

<div class="header">
    <h2>ログイン</h2>
</div>
<br />
<form method="post" action="user_login_check.php">
    ユーザーID<br />
    <input type="text" name="login_id"><br />
    パスワード<br />
    <input type="password" name="pass"><br />
    <br />
    <input type="submit" value="ログイン">
</form>

<br />
<a href="../user_add/user_add.php"?>新規登録</a>


<?php require_once(__DIR__ . '/../common/footer.php') ?>