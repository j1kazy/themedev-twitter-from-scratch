<?php require_once(__DIR__ . '/../common/user_login_session.php'); ?>
<?php require_once(__DIR__ . '/../common/header.php'); ?>
<?php 

$user = getUserData($_SESSION['login_id']);
$image_old = $user['image'];
$disp_image = getDispImageTag($image_old);
?>

<div class="header">
    <h2>プロフィール編集</h2>
</div>
<br />
<form method="post" action="./profile_check.php" enctype="multipart/form-data">
    <input type="hidden" name="image_old" value="<?php print $image_old; ?>">
    名前<br />
    <input type="text" name="name" value="<?php print $user['name']; ?>"><br />
    <br />
    <?php print $disp_image; ?>
    <br />
    画像を選んでください<br />
    <input type="file" name="image" style="width:400px"><br />
    プロフィール<br />
    <textarea name="profile"><?php print $user['profile']; ?></textarea><br />
    

    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="送信">
</form>


<?php require_once(__DIR__ . '/../common/footer.php') ?>