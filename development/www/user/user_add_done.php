<?php require_once('../common/header.php') ?>

<?php

require_once('../common/common.php');

$login_id = htmlspecialchars($_POST['login_id']);
$password = htmlspecialchars($_POST['pass']);

try{

    $dbh = getDbh();

    $sql = 'INSERT INTO users(name, login_id, password, profile, image, created) VALUES(?, ?, ?, ?, ?, ?)';
    $stmt = $dbh->prepare($sql);
    $data[] = $login_id;
    $data[] = $login_id;
    $data[] = $password;
    $data[] = '';
    $data[] = '';
    $data[] = date('Y-m-d h:i:s');
    $stmt->execute($data);

    $dbh = null;

    print $login_id;
    print 'さんを追加しました。<br />';

}catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    print '<br /><br />';
    print $e;
    print '<br /><br />';
    var_dump($e);
    exit();
}

?>

トップ？プロフィール画面へ
<a href="index.html">戻る</a>

<?php require_once('../common/footer.php') ?>