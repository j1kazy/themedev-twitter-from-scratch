<?php require_once(__DIR__ . '/../common/header.php') ?>

<div class="header">
    <h2>新規登録</h2>
</div>

<?php
require_once(__DIR__ . '/../common/common.php');

$isError = false;

// 入力値のサニタイズ
$login_id = htmlspecialchars($_POST['login_id'], ENT_QUOTES);
$password = htmlspecialchars($_POST['pass'], ENT_QUOTES);


// 入力値チェック


// ユーザーIDが入っているか
if(empty($login_id)){
    $isError = true;
    echo 'ユーザーIDを入力してください。<br />';
}

// TODO: ユーザーIDのルール。文字数・文字種

// パスワードが入っているか
if(empty($password)){
    $isError = true;
    echo 'パスワードを入力してください。<br />';
}

// ユーザーがすでにDBに存在している場合はtrue
if($isError == false && isUserExitst($login_id)){
    $isError = true;
    echo 'すでに登録されているユーザーIDです。<br />';
}

// 入力チェックNGなら、戻るボタンのみ
if($isError){
    echo '<form>
    <input type="button" onclick="history.back()" value="戻る">
    </fomr>';

}else{
    // 入力チェックOKなら、hiddenでデータ入力して、user_add_done.phpに渡す
    $password = md5(SALT . $password);
    echo '<form method="post" action="user_add_done.php">
    ユーザーID : '. $login_id . '<br />
    <input type="hidden" name="login_id" value="'.$login_id.'">
    <input type="hidden" name="pass" value="'.$password.'">
    <br />
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
    </form>';
}

?>


<?php require_once(__DIR__ . '/../common/footer.php') ?>