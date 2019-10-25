<?php require_once(__DIR__ . '/../common/user_login_session.php'); ?>
<?php require_once(__DIR__ . '/../common/header.php'); ?>

<?php

require_once(__DIR__ . '/../common/header.php');

$name = htmlspecialchars($_POST['name']);
$profile = htmlspecialchars($_POST['profile']);
$image_old = htmlspecialchars($_POST['image_old']);
$image = $_FILES['image'];

if($name == ''){
    print '名前が入力されていません。<br />';
}else{
    print '名前：';
    print $name;
    print '<br />';
}

// 画像をバリデーション
// TODO:サイズのみでバリデーション。ファイルの種類を考慮する必要がある
// TODO:ファイル名もかぶる可能性があるので、タイムスタンプなどで一意性を。
if($image['size'] > 0)
{
    if($image['size'] > 1000000){
        print '画像が大きすぎます。';
    }else{
        // 画像の保存
        $fullPath = './gazou/'.$image['name'];
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
    print '<input type="hidden" name="image_name" value="'.$image['name'].'">';
    print '<br />';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="OK">';
    print '</form>';
}

?>

<?php require_once('../common/footer.php');?>