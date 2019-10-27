<?php 
require_once(__DIR__ . '/../common/common.php');

loginCheck();
viewHeader('プロフィール');
?>

<form>
<!-- TODO: history.backじゃなくURL指定でいいかも-->
<input type="button" onclick="history.back()" value="戻る">
</form>
<a href="./profile_edit.php"?>プロフィール編集</a>

<br />
<br />
<br />

<?php
$user = getUserData($_SESSION['login_id']);
$disp_image = getDispImageTag($user['image']);

echo <<< EOD
名前： {$user['name']}<br />
画像： {$disp_image}<br />
プロフィール：{$user['profile']}<br />
EOD;

// フッターの表示
viewFooter();