<?php 
require_once(__DIR__ . '/../common/common.php');

loginCheck();
viewHeader('プロフィール編集');

$user = getUserData($_SESSION['login_id']);
$image_old = $user['image'];
$disp_image = getDispImageTag($image_old);
?>

<br />
<form method="post" action="./profile_check.php" enctype="multipart/form-data">
    <input type="hidden" name="image_old" value="<?= $image_old; ?>">
    名前<br />
    <input type="text" name="name" value="<?= $user['name']; ?>"><br />
    <br />
    <?= $disp_image; ?>
    <br />
    画像を選んでください<br />
    <input type="file" name="image" style="width:400px"><br />
    プロフィール<br />
    <textarea name="profile"><?= $user['profile']; ?></textarea><br />
    

    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="送信">
</form>


<?php viewFooter(); ?>