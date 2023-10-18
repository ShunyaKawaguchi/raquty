<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//セキュリティ対策のためnonce利用
$nonce_id = raquty_nonce();
//リダイレクト先
if(isset($_SESSION['request_url'])){
    $request_url = h($_SESSION['request_url']);
}else{
    $request_url = home_url('MyPage');
}
if(is_login()){ 
    echo "<script>window.location.href = '".home_url('MyPage')."'</script>";
}
//ログイン失敗メッセージ
if(!empty($_SESSION['login_error_message'])){
    $notice = '入力内容に誤りがあります。再度、お試しください。';
}else{
    unset($_SESSION['login_error_message']);
}
?>

<div class="user_login">
    <div class="raquty">raquty</div>
    <h2>選手ログイン</h2>
    <div class="main">
        <div class="head">
            <div>選手登録がお済みでない方はこちら</div>
            <a href="<?php echo home_url('Register') ?>"><span>&gt;</span>新規選手登録</a>
        </div>
        <?php if(isset($notice)): ?><div class="notice"><?php echo $notice ?></div><?php endif; ?>
            <form action="" method="post" id="Login_Authorization">
                <label for="user_email">メールアドレス</label>
                <input type="email" name="user_email" id="user_email" placeholder="メールアドレスを入力してください">
                <label for="user_passsword">パスワード</label>
                <input type="password" name="user_password" id="user_password" placeholder="パスワードを入力してください">
                <input type="hidden" name="raquty_nonce" value="<?php echo $nonce_id ?>">
                <input type="hidden" name="request_url" value="<?php echo $request_url ?>">
                <button class="login_button" id="Login">ログイン</button>
            </form>
        <div class="foot">
            <div>パスワードを忘れた方はこちら</div>
            <a href="<?php echo home_url('Password_Reset') ?>"><span>&gt;</span>パスワードの再発行</a>
        </div>
        <div class="smartphone_foot">
            <div>選手登録がお済みでない方はこちら</div>
            <a href="<?php echo home_url('Register') ?>"><span>&gt;</span>新規選手登録</a>
        </div>
    </div>
</div>

<script src="/components/templates/login/login.min.js"></script>

<?php
//エラーメッセージを初期化
if(!empty($_SESSION['login_error_message'])){
    unset($_SESSION['login_error_message']);
}
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>

