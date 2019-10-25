<?php require_once(__DIR__ . '/../common/user_login_session.php'); ?>
<?php require_once(__DIR__ . '/../common/header.php'); ?>

<div class="header">
    <h2>プロフィール</h2>
</div>
<br />
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>
<a href="./profile_edit.php"?>プロフィール編集</a>

<br />
<br />
<br />

<?php
$user = getUserData($_SESSION['login_id']);
$disp_image = getDispImage($user['image']);

print '名前：' . $user['name'] . '<br />';
print '画像：'. $disp_image .'<br />';
print 'プロフィール：' . $user['profile'] . '<br />';

?>


<?php require_once(__DIR__ . '/../common/footer.php') ?>