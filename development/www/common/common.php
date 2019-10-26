<?php

require_once(__DIR__.'/loginCheck.php');

// 定数群
define ("URL", (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST']);
define ("SALT", "ezZundE1qnLZJ84s4SE2");

// ヘッダーの表示
// タイトル省略可能
// 第二引数 true:ログインバー表示、 false:ログインバー非表示　　デフォルトtrue
function viewHeader($title = '', $viewLoginBar = true){

    $titleTag = '';
    if($title != '') {
        $titleTag = '<title>わびさび | '.$title.'</title>';
    }else{
        $titleTag = '<title>わびさび</title>';
    }

    // ヘッダーの表示
    echo '
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="UTF-8">'
    .$titleTag.
    '<link rel="stylesheet" href="'.URL.'/common/style.css" type="text/css">
    </head>
    <body>';

    //ログインバー表示
    if($viewLoginBar)
        viewLoginBar();

    // ページタイトルの表示
    if($title != ''){
        echo '
        <div class="header">
        <h2>'.$title.'</h2>
        </div>
        <br />';
    }
    
}

// ログインバーの表示
function viewLoginBar(){
    
    // ログインしてる？
    if(isLogined()){
        // ログインしていたらログアウトのバー
        echo $_SESSION['name'] . 'さんログイン中
        <a class="logout" href="'.URL.'/user_login/user_logout.php">ログアウト</a><br /><br />';
    }else{
        // ログインしてなかったらログインのバー
        echo '<a class="login" href="'.URL.'/user_login/user_login.php">ログイン</a><br /><br />';
    }    
}

// フッターの表示
function viewFooter(){
    echo '
    </body>
    </html>';
}


function getDbh()
{
    $dsn = 'mysql:dbname=wabisabi;host=db';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');

    return $dbh;
}

// usersテーブルに指定ユーザーが存在するか
// 存在している場合true
function isUserExitst($login_id)
{
    try{
        $dbh = getDbh();

        $sql = 'SELECT COUNT(*) FROM users WHERE login_id=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $login_id;
        $stmt->execute($data);
        $count = $stmt->fetchColumn();
        $dbh = null;            
    }catch(Exception $e){
        echo 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
    }
    
    return $count != 0;
}

// usersテーブルからlogin_idのデータを取得し配列で返す
function getUserData($login_id)
{
    try{
        $dbh = getDbh();

        $sql = 'SELECT * FROM users WHERE login_id=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $login_id;
        $stmt->execute($data);
        
        $dbh = null;
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(Exception $e){
        echo 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
    }

    return $rec;
}

// tweetsテーブルからidのデータを取得し配列で返す
function getTweetData($tweet_id)
{
    try{
        $dbh = getDbh();

        $sql = 'SELECT * FROM tweets WHERE id=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $tweet_id;
        $stmt->execute($data);
        
        $dbh = null;
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(Exception $e){
        echo 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
    }
    return $rec;
}


// 指定したパスのファイルをサムネイル化する（上書き保存） ImageMagic使用
function resizeImage($fileName)
{
    $image = new Imagick($fileName);
    $image->cropThumbnailImage(300, 300);
    //サムネイルを保存
    $image->writeImage($fileName);
}

// 指定したファイル名に接尾辞をつける
// ファイル名のみ対応
function addSuffix($fileName, $suffix)
{
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = $pathData['filename'] . $suffix . '.' . $ext;
    return $newFileName;
}

// 一意なファイル名を返す
// ファイル名のみ対応
function getUniqFileName($fileName)
{
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = uniqid(rand()) . '.' . $ext;
    return $newFileName;
}



// ファイルパスで表示タグを組み立てる。プロフィール用
function getDispImageTag($imagePath)
{
    if($imagePath == ''){
        $disp_image = '';
    }else{
        $disp_image = '<img src="./gazou/' . $imagePath . '"><br />';
    }

    return $disp_image;
}



// var_dump()を整形して使用
function dump($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}