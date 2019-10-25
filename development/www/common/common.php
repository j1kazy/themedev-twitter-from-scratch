<?php

define ("URL", (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST']);

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
        print 'ただいま障害により大変ご迷惑をおかけしております。';
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
        print 'ただいま障害により大変ご迷惑をおかけしております。';
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
function addSuffix($fileName, $suffix)
{
    $pathData = pathinfo($fileName);
    $newFileName = $pathData['dirname'] . '/' . $pathData['filename'] . $suffix . '.' . $pathData['extension'];
    return $newFileName;
}



// ファイルパスで表示タグを組み立てる。プロフィール用
function getDispImageTag($imagePath)
{
    if($imagePath == ''){
        $disp_image = '';
    }else{
        $disp_image = '<img src="./gazou/' . $imagePath . '">';
    }

    return $disp_image;
}

