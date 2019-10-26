<?php 
require_once(__DIR__ . '/../common/common.php');

loginCheck();
viewHeader('プロフィール');


$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
$profile = htmlspecialchars($_POST['profile'], ENT_QUOTES);
$image_old = htmlspecialchars($_POST['image_old'], ENT_QUOTES);
$uniqFileName = $image_old;
$image = $_FILES['image'];

if($name == ''){
    echo '名前が入力されていません。<br />';
}else{
    echo '名前：' . $name . '<br />';
}

// 画像をバリデーション と画像の保存
// TODO:サイズのみでバリデーション。ファイルの種類を考慮する必要がある
if($image['size'] > 0)
{
    if($image['size'] > 1000000){
        echo '画像が大きすぎます。';
    }else{
        // 画像の保存
        $uniqFileName = getUniqFileName($image['name']);
        $fullPath = './gazou/'.$uniqFileName;
        move_uploaded_file($image['tmp_name'], $fullPath);

        // 画像のサムネイル化
        resizeImage($fullPath);
    }
}

echo getDispImageTag($uniqFileName);

if($name == "" || $image['size'] > 1000000){
    echo '<form>
    <input type="button" onclick="history.back()" value="戻る">
    </form>';
}else{
    echo '上記でプロフィールを保存します。<br />
    <form method="post" action="profile_done.php">
    <input type="hidden" name="name" value="'.$name.'">
    <input type="hidden" name="profile" value="'.$profile.'">
    <input type="hidden" name="image_old" value="'.$image_old.'">
    <input type="hidden" name="image_name" value="'.$uniqFileName.'">
    <br />
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
    </form>';
}

viewFooter();