<?php require_once(__DIR__ . '/../common/header.php') ?>

<div class="header">
    <h2>新規登録</h2>
</div>

<br />
<form method="post" action="user_add_check.php">
ユーザーID<br />
<input type="text" name="login_id"><br />
パスワード<br />
<input type="password" name="pass"><br />
<br />
<input type="submit" value="新規登録">

<input type="button" onclick="history.back()" value="x">
</form>



<?php require_once(__DIR__ . '/../common/footer.php') ?>