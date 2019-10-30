<?php
require_once(__DIR__ . '/../common/common.php');

loginCheck();
viewHeader('一覧');


// ページング
$page = isset($_GET['p']) ? htmlspecialchars($_GET['p'], ENT_QUOTES) : 1;
$tweetCount = getTweetCount();
$totalPage = ceil($tweetCount / VIEW_RECORDS);

// ページのバリデーション。有効範囲に
if($page < 1)
    $page = 1;
elseif($page >= $totalPage)
    $page = $totalPage;

$tweets = getAllTweetDatasWithLimit($page);
foreach($tweets as $tweet){
    viewTweet($tweet);
}

?>

<form method="post" action="tweet_add.php">
    <input type="submit" value="つぶやく">
</form>


<?php
// ページネーション
viewPagenation($page, $totalPage);
viewFooter(); 
?>



<?php

// つぶやきを１件表示
function viewTweet($tweet)
{
    // TODO:ここ全体　クリックで詳細へ
echo <<< EOD
    <div class="tweet">
    {$tweet['kami']}<br />
    {$tweet['naka']}<br />
    {$tweet['shimo']}<br />
EOD;

    $dispImage = getDispImageTag($tweet['image']);
    echo $dispImage;

echo <<< EOD
    <div class="iine">いいねボタン</div>
    <div class="comments">コメント数</div>
    <br /><br />
    <a href="./tweet_disp.php?id={$tweet['id']}">詳細</a>
    </div>
EOD;

// TODO:いいね機能
}


// ページネーションの表示
function viewPagenation($page, $totalPage)
{
    echo '<a href="./tweet_list.php?p=1"><<</a>　';
    if($page <= 1){
        echo '前';
    }else{
        echo '<a href="./tweet_list.php?p='.($page-1).'">前</a>';
    }

    echo '　'.$page.' / '.$totalPage.'　';

    if($page >= $totalPage){
        echo '次';
    }else{
        echo '<a href="./tweet_list.php?p='.($page+1).'">次</a>';
    }
    
    echo '　<a href="./tweet_list.php?p='.$totalPage.'">>></a>';
}

?>