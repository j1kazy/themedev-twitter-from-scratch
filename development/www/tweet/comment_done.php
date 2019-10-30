<?php
require_once(__DIR__ . '/../common/common.php');
loginCheck();

try{
    $userID = getUserData($_SESSION['login_id'])['id'];
    $tweet_id = htmlspecialchars($_POST['tweet_id'], ENT_QUOTES);
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES);
    
    $dbh  = getDbh();

    $sql = 'INSERT INTO comments(user_id, tweet_id, message, created) VALUES(?, ?, ?, ?)';
    $stmt = $dbh->prepare($sql);
    $data[] = $userID;
    $data[] = $tweet_id;
    $data[] = $message;
    $data[] = date('Y-m-d h:i:s');
    $stmt->execute($data);

    $dbh = null;

    // 一覧にリダイレクト
    header('Location:./tweet_disp.php?id='.$tweet_id);
    exit();

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