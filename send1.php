<?php
session_start();
$mode = 'input';
$err = array();
if( isset($_POST['back']) && $_POST['back']){
    //何もしない
} else if( isset($_POST['confirm']) && $_POST['confirm'] ){
    //確認ボタンを押したとき
    if( !$_POST['user_name'] ){
        $err[] = "氏名は必須項目です";
    } else if( mb_strlen($_POST['user_name']) >50){
        $err[] = "氏名は５０文字以内で入力してください";
    }
    $_SESSION['user_name'] = htmlspecialchars($_POST['user_name'], flags:ENT_QUOTES);
    
    if( !$_POST['gender'] === '男' && !$_POST['gender'] === '女' && !$_POST['gender'] === '答えたくない' ){
        $err[] = "性別は必須項目です";
    }

    if( !$_POST['year'] ){
        $err[] = "年は必須項目です";
    } else if( mb_strlen($_POST['year']) >4){
        $err[] = "年は４桁以内で入力してください";
    }
    $_SESSION['year'] = htmlspecialchars($_POST['year'], flags:ENT_QUOTES);

    if( !$_POST['month'] ){
        $err[] = "月は必須項目です";
    } else if( mb_strlen($_POST['month']) >2){
        $err[] = "月は２桁以内で入力してください";
    }
    $_SESSION['month'] = htmlspecialchars($_POST['month'], flags:ENT_QUOTES);

    if( !$_POST['date'] ){
        $err[] = "日は必須項目です";
    } else if( mb_strlen($_POST['date']) >2){
        $err[] = "日は２桁以内で入力してください";
    }
    $_SESSION['date'] = htmlspecialchars($_POST['date'], flags:ENT_QUOTES);

    if( !$_POST['post_code'] ){
        $err[] = "郵便番号は必須項目です";
    } else if( mb_strlen($_POST['post_code']) >7){
        $err[] = "郵便番号は７桁以内で入力してください";
    }
    $_SESSION['post_code'] = htmlspecialchars($_POST['post_code'], flags:ENT_QUOTES);

    if( !$_POST['address'] ){
        $err[] = "住所は必須項目です";
    } else if( mb_strlen($_POST['address']) >200){
        $err[] = "住所は２００文字以内で入力してください";
    }
    $_SESSION['address'] = htmlspecialchars($_POST['address'], flags:ENT_QUOTES);

    if( mb_strlen($_POST['email']) >200){
        $err[] = "メールアドレスは２００文字以内で入力してください";
    }
    $_SESSION['email'] = htmlspecialchars($_POST['email'], flags:ENT_QUOTES);

    if( !$_POST['kind'] === '商品について' && !$_POST['kind'] === '支払方法について' && 
        !$_POST['kind'] === 'キャンペーンについて' && !$_POST['kind'] === 'クレーム' &&
        !$_POST['kind'] === 'お褒めの言葉' && !$_POST['kind'] === 'その他' ){
        $err[] = "性別は必須項目です";
        }

    if( !$_POST['content'] ){
        $err[] = "相談内容は必須項目です";
    } else if( mb_strlen($_POST['content']) >1000){
        $err[] = "相談内容は１,０００文字以内で入力してください";
    }
    $_SESSION['content'] = htmlspecialchars($_POST['content'], flags:ENT_QUOTES);

    if( $err ){
        $mode = 'input';
    } else {
    $mode = 'confirm';
    }
    
} else if( isset($_POST['send']) && $_POST['send'] ){
    //送信ボタンを押したとき
    $_SESSION['user_name'] = "";
    $_SESSION['gender'] = "";
    $_SESSION['year'] = "";
    $_SESSION['month'] = "";
    $_SESSION['date'] = "";
    $_SESSION['post_code'] = "";
    $_SESSION['address'] = "";
    $_SESSION['phone_code'] = "";
    $_SESSION['email'] = "";
    $_SESSION['kind'] = "";
    $_SESSION['content'] = "";
    $mode = 'send';
} else {
    $_SESSION['user_name'] = "";
    $_SESSION['gender'] = "";
    $_SESSION['year'] = "";
    $_SESSION['month'] = "";
    $_SESSION['date'] = "";
    $_SESSION['post_code'] = "";
    $_SESSION['address'] = "";
    $_SESSION['phone_code'] = "";
    $_SESSION['email'] = "";
    $_SESSION['kind'] = "";
    $_SESSION['content'] = "";
}
?>

<html>
    <head>
        <meta charset="UTF-8">
</head>
<body>
    <?php
    if( $mode === 'input' ){ ?>
    <!-- 入力画面 -->
    <?php
    if( $err ){
        echo '<div style="color:red;">';
        echo implode( '<br>', $err );
        echo '</div>';
    }
    ?>
    <h1>問い合わせ内容</h1>
    <form action="" method="post">   
        <label>氏名</label>
        <input type="text" name="user_name" value="<?php echo $_SESSION['user_name'] ?>">
        <br>

        <label>性別</label>
        <select name="gender">
            <option value=""></option>
            <option value="男">男</option>
            <option value="女">女</option>
            <option value="答えたくない">答えたくない</option>
        </select>
        <br>

        <label>生年月日</label>
        <input type="text" name="year" value="<?php echo $_SESSION['year'] ?>">
        <label>年</label>
        <input type="text" name="month" value="<?php echo $_SESSION['month'] ?>">
        <label>月</label>
        <input type="text" name="date" value="<?php echo $_SESSION['date'] ?>">
        <label>日</label>
        <br>

        <label>郵便番号</label>
        <input type="text" name="post_code" value="<?php echo $_SESSION['post_code'] ?>">
        <br>

        <label>住所</label>
        <input type="text" name="address" value="<?php echo $_SESSION['address'] ?>">
        <br>

        <label>電話番号</label>
        <input type="text" name="phone_code" value="<?php echo $_SESSION['phone_code'] ?>">
        <br>

        <label>メールアドレス</label>
        <input type="email" name="email" value="<?php echo $_SESSION['email'] ?>">
        <br>

        <label>問い合わせの種類</label>
        <select name="kind">
            <option value=""></option>
            <option value="商品について">商品について</option>
            <option value="支払方法について">支払方法について</option>
            <option value="キャンペーンについて">キャンペーンについて</option>
            <option value="クレーム">クレーム</option>
            <option value="お褒めの言葉">お褒めの言葉</option>
            <option value="その他">その他</option>
        </select>
        <br>

        <label>相談内容</label><br>
        <textarea cols="50" rous="20" name="content"><?php echo $_SESSION['content'] ?></textarea>
        <br>


        <input type="submit" name="confirm" value="確認する">
</form>

<?php } else if( $mode === 'confirm' ){ ?>
    <!-- 確認画面 -->
    <form action="" method="post">
    <h1>受信ページ</h1>
    <p>氏名：<?php echo $_SESSION['user_name'] ?>様</p>
    <p>性別：<?php echo $_POST['gender'] ?></p>
    <p>生年月日：<?php echo $_SESSION['year'] ?><?php echo $_POST['month'] ?><?php echo $_POST['date'] ?></p>
    <p>郵便番号：<?php echo $_SESSION['post_code'] ?></p>
    <p>住所：<?php echo $_SESSION['address'] ?></p>
    <p>電話番号：<?php echo $_SESSION['phone_code'] ?></p>
    <p>メールアドレス：<?php echo $_SESSION['email'] ?></p>
    <p>問い合わせの種類：<?php echo $_POST['kind']?></p>
    <p>相談内容：<?php echo nl2br($_SESSION['content']) ?></p>
    <P>こちらの情報でよろしいですか？</p>
    <input type="submit" name="back" value="戻る">
    <input type="submit" name="send" value="送信">
    </form>

<?php } else {?>
    <!-- 完了画面 -->
    <h1>完了</h1>
    お問い合わせありがとうございました。
<?php } ?>

</body>
</html>

<html>
    </html>