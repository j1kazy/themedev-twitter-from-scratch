<?php
require_once(__DIR__ . '/../common/common.php');

// サニタイズ
$login_id = htmlspecialchars($_POST['login_id']);
$password = htmlspecialchars($_POST['pass']);
$password = md5($password);

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
        session_start();
        $_SESSION['login'] = 1;
        $_SESSION['login_id'] = $login_id;
        $_SESSION['name'] = $rec['name'];

        header('Location:../index.php');
        exit();
    }
    
}catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}

?>