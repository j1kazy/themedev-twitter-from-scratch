<?php require_once(__DIR__ . '/../common/header.php') ?>

<div class="header">
    <h2>新規登録</h2>
</div>

<?php
require_once(__DIR__ . '/../common/common.php');

$isError = false;

// 入力値のサニタイズ
$login_id = htmlspecialchars($_POST['login_id']);
$password = htmlspecialchars($_POST['pass']);


// 入力値チェック


// ユーザーIDが入っているか
if(empty($login_id)){
    $isError = true;
    print 'ユーザーIDを入力してください。<br />';
}

// TODO: ユーザーIDのルール。文字数・文字種

// パスワードが入っているか
if(empty($password)){
    $isError = true;
    print 'パスワードを入力してください。<br />';
}

// ユーザーがすでにDBに存在している場合はtrue
if($isError == false && isUserExitst($login_id)){
    $isError = true;
    print 'すでに登録されているユーザーIDです。<br />';
}

// 入力チェックNGなら、戻るボタンのみ
if($isError){
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</fomr>';

}else{
    // 入力チェックOKなら、hiddenでデータ入力して、user_add_done.phpに渡す
    $password = md5(SALT . $password);
    print '<form method="post" action="user_add_done.php">';
    print 'ユーザーID : '. $login_id . '<br />';
    print '<input type="hidden" name="login_id" value="'.$login_id.'">';
    print '<input type="hidden" name="pass" value="'.$password.'">';
    print '<br />';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="OK">';
    print '</form>';
}

?>


<?php require_once(__DIR__ . '/../common/footer.php') ?>