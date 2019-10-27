<?php
require_once(__DIR__ . '/../common/common.php');

loginCheck();
viewHeader('つぶやき追加');

try{

    $userID = getUserData($_SESSION['login_id'])['id'];
    $kami = htmlspecialchars($_POST['kami'], ENT_QUOTES);
    $naka = htmlspecialchars($_POST['naka'], ENT_QUOTES);
    $shimo = htmlspecialchars($_POST['shimo'], ENT_QUOTES);
    $image = $_FILES['image'];
    $uniqFileName = '';

    // 画像の保存
    if($image['size'] > 0){
        // 画像の保存
        $uniqFileName = getUniqFileName($image['name']);
        $fullPath = './gazou/'.$uniqFileName;
        move_uploaded_file($image['tmp_name'], $fullPath);

        // 画像のサムネイル化
        resizeImage($fullPath);
    }
    

    $dbh  = getDbh();

    $sql = 'INSERT INTO tweets(user_id, kami, naka, shimo, image, created) VALUES(?, ?, ?, ?, ?, ?)';
    $stmt = $dbh->prepare($sql);
    $data[] = $userID;
    $data[] = $kami;
    $data[] = $naka;
    $data[] = $shimo;
    $data[] = $uniqFileName;
    $data[] = date('Y-m-d h:i:s');
    $stmt->execute($data);

    $dbh = null;

    echo 'つぶやきました。<br />';

}
catch (Exception $e){
echo <<< EOD
    ただいま障害により大変ご迷惑をおかけしております。
    <br /><br />
    $e
    <br /><br /
EOD;
    var_dump($e);
    exit();
}

?>

<a href="tweet_list.php">戻る</a>

<?php viewFooter(); ?>



   