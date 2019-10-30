<?php
// つぶやき詳細の画面
require_once(__DIR__ . '/../common/common.php');

loginCheck();
// リダイレクトするのでヘッダーはあとで

// エラー判定
$errors = array();
if(isset($_POST['submit']) && $_POST['submit'] === "コメントする"){

    $commentMessage = htmlspecialchars($_POST['message'], ENT_QUOTES);

    if($commentMessage === ''){
        $errors['message'] = 'コメントが入力されていません。';
    }
        
    // エラーがあれば同じページ、なければ登録ページへ
    if(count($errors) === 0){
        header('Location:./comment_done.php', true, 307);
        exit();
    }
}



// つぶやきデータ取得
$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
$tweet = getTweetData($id);

// ヘッダー表示
viewHeader('つぶやき詳細');

// エラー表示
viewError($errors);

// ツイートの表示
viewTweet($tweet);

// いいね表示
// TODO:いいね機能
viewLikes();

// コメント投稿フォームの表示
viewCommentForm($id, $commentMessage);

// コメントデータ取得&表示
$comments = getCommentDatas($id);
foreach($comments as $comment){
    viewComment($comment);
}

// フッターの表示
viewFooter();

?>



<?php

// エラーの表示
function viewError($errors)
{
    // エラーの表示
    echo '<ul>';
    foreach($errors as $message){
        echo '<li>' . $message . '</li>';
    }
    echo '</ul>';
}

// ツイートの表示
function viewTweet($tweet)
{
echo <<< EOD
    <div class="tweet">
    {$tweet['kami']}<br />
    {$tweet['naka']}<br />
    {$tweet['shimo']}<br />
EOD;

    $dispImage = getDispImageTag($tweet['image']);
    echo $dispImage;

    echo '</div>';
}


// コメント投稿フォーム表示
function viewCommentForm($id, $commentMessage)
{
echo <<< EOD
    <form method="post" action="./tweet_disp.php?id={$id}">
    <input type="hidden" name="tweet_id" value="{$id}">
    コメント
    <textarea name="message">{$commentMessage}</textarea><br />
    <input type="submit" name="submit" value="コメントする">
    </form>

    <div class="button">
        <a href="./tweet_list.php">戻る</a>
    </div>
EOD;
}



// コメントの表示
function viewComment($comment)
{
    $likes = getLikesCount($comment['tweet_id']);

    // コメント内容、いいね数
    // TODO:いいね機能
    echo $comment['message'];
    echo '<br />';
}


?>

