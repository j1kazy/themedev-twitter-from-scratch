<?php

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

        $sql = 'select * from users where login_id=?';
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