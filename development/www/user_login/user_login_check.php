<?php
require_once(__DIR__ . '/../common/common.php');
require_once(__DIR__ . '/../common/LoginManager.php');

// サニタイズ
$login_id = htmlspecialchars($_POST['login_id'], ENT_QUOTES);
$password = htmlspecialchars($_POST['pass'], ENT_QUOTES);
$password = md5(SALT . $password);

try{
    $dbh = getDbh();

    // DBに存在しているか確認
    $sql = 'SELECT * FROM users WHERE login_id=? AND password=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $login_id;
    $data[] = $password;
    $stmt->execute($data);
    
    $dbh = null;
    
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
    // 存在していなかったらエラーを吐いてログイン画面へ
    if($rec == false){
        print 'ユーザーIDかパスワードが間違っています。<br />';
        print '<a href="user_login.php">戻る</a>';
    }else{
        // 存在していたら情報をセッションに
        LoginManager::Login($login_id, $rec['name']);

        header('Location:../index.php');
        exit();
    }
    
}catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}

?>