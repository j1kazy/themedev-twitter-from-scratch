<?php require_once(__DIR__ . '/../common/user_login_session.php'); ?>
<?php require_once(__DIR__ . '/../common/header.php'); ?>

<?php

require_once(__DIR__ . '/../common/header.php');

try{

    $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
    $profile = htmlspecialchars($_POST['profile'], ENT_QUOTES);
    $image_old = htmlspecialchars($_POST['image_old'], ENT_QUOTES);
    $image = htmlspecialchars($_POST['image_name'], ENT_QUOTES);

    $dbh  = getDbh();

    $sql = 'UPDATE users SET name=?, profile=?, image=? WHERE login_id=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $name;
    $data[] = $profile;
    $data[] = $image;
    $data[] = $_SESSION['login_id'];
    $stmt->execute($data);

    $dbh = null;

    if($image_old != $image){
        if($image_old != ''){
            // TODO:エラーハンドリングしろよと。ファイルがない場合エラー
            unlink('./gazou/' . $image_old);
        }
    }

    print '編集しました。<br />';

}
catch (Exception $e){
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    print '<br /><br />';
    print $e;
    print '<br /><br />';
    var_dump($e);
    exit();
}

?>

<a href="profile.php">戻る</a>

<?php require_once('../common/footer.php');?>