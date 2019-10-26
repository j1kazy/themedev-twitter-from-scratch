<?php require_once(__DIR__ . '/../common/user_login_session.php'); ?>
<?php require_once(__DIR__ . '/../common/header.php'); ?>

<?php

require_once(__DIR__ . '/../common/header.php');

$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
$profile = htmlspecialchars($_POST['profile'], ENT_QUOTES);
$image_old = htmlspecialchars($_POST['image_old'], ENT_QUOTES);
$image = $_FILES['image'];

if($name == ''){
    print '名前が入力されていません。<br />';
}else{
    print '名前：';
    print $name;
    print '<br />';
}

// 画像をバリデーション と画像の保存
// TODO:サイズのみでバリデーション。ファイルの種類を考慮する必要がある
if($image['size'] > 0)
{
    if($image['size'] > 1000000){
        print '画像が大きすぎます。';
    }else{
        // 画像の保存
        $uniqFileName = getUniqFileName($image['name']);
        $fullPath = './gazou/'.$uniqFileName;
        move_uploaded_file($image['tmp_name'], $fullPath);

        // 画像のサムネイル化
        resizeImage($fullPath);

        print '<img src="' . $fullPath . '">';
        print '<br />';
    }
}

if($name == "" || $image['size'] > 1000000){
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
}else{
    print '上記でプロフィールを保存します。<br />';
    print '<form method="post" action="profile_done.php">';
    print '<input type="hidden" name="name" value="'.$name.'">';
    print '<input type="hidden" name="profile" value="'.$profile.'">';
    print '<input type="hidden" name="image_old" value="'.$image_old.'">';
    print '<input type="hidden" name="image_name" value="'.$uniqFileName.'">';
    print '<br />';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="OK">';
    print '</form>';
}

?>

<?php require_once('../common/footer.php');?>