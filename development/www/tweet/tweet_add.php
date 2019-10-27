<?php
require_once(__DIR__ . '/../common/common.php');

loginCheck();

// リダイレクトするのでヘッダーはあとで


// エラー判定
$errors = array();
if(isset($_POST['submit']) && $_POST['submit'] === "わびさび"){

    $kami = htmlspecialchars($_POST['kami'], ENT_QUOTES);
    $naka = htmlspecialchars($_POST['naka'], ENT_QUOTES);
    $shimo = htmlspecialchars($_POST['shimo'], ENT_QUOTES);
    $image = $_FILES['image'];

    if($kami === ''){
        $errors['kami'] = '上の句が入力されていません。';
    }
    if($naka === ''){
        $errors['naka'] = '中の句が入力されていません。';
    }
    if($shimo === ''){
        $errors['shimo'] = '下の句が入力されていません。';
    }

    // 画像をバリデーション と画像の保存
    // TODO:サイズのみでバリデーション。ファイルの種類を考慮する必要がある
    // TODO:エラーの場合ファイルを選び直しになる
    if($image['size'] > 1000000){
        $errors['image'] = '画像が大きすぎます。';
    }
        
    // エラーがあれば同じページ、なければ登録ページへ
    if(count($errors) === 0){
        header('Location:./tweet_done.php', true, 307);
        exit();
    }

}


viewHeader('つぶやき追加');

// つぶやき追加の入力画面

// 確認ページはなし。チェックしてそのまま登録


// コメントボタン、いいねボタン

// エラーの表示
echo '<ul>';
foreach($errors as $message){
    echo '<li>' . $message . '</li>';
}
echo '</ul>';

?>

<br />
<form method="post" action="./tweet_add.php" enctype="multipart/form-data">
    上の句<br />
    <input type="text" name="kami" value="<?= $kami ?>"><br />
    中の句<br />
    <input type="text" name="naka" value="<?= $naka ?>"><br />
    下の句<br />
    <input type="text" name="shimo" value="<?= $shimo ?>"><br />
    <br />
    画像を選んでください<br />
    <input type="file" name="image" style="width:400px"><br />

    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" name="submit" value="わびさび">
</form>

<?php viewFooter(); ?>