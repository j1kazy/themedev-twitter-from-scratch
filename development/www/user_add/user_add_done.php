<?php 
require_once(__DIR__ . '/../common/common.php');

viewHeader('新規登録', false);


// TODO: このページで再読み込みすると、同じデータがDBに入ってしまう。

$login_id = htmlspecialchars($_POST['login_id'], ENT_QUOTES);
$password = htmlspecialchars($_POST['pass'], ENT_QUOTES);

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

    echo $login_id;
    echo 'さんを追加しました。<br />';

    // TODO: 追加したと同時にログインしたい

}catch(Exception $e){
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    echo '<br /><br />';
    echo $e;
    echo '<br /><br />';
    var_dump($e);
    exit();
}

?>

トップ？プロフィール画面へ
<a href="<?= URL . '/index.php' ?>">戻る</a>

<?php viewFooter(); ?>