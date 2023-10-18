<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//セキュリティ対策のためnonce利用
$nonce_id = raquty_nonce();
//ログイン済みのユーザーはマイページへリダイレクト
if(is_login()){ 
    echo "<script>window.location.href = '".home_url('MyPage')."'</script>";
}
?>

<div class="Register_mail">
    <div class="Register">LOGIN</div>
    <div class="liner"></div>
    <div class="h2_wrap">
        <h2>パスワード再発行</h2>
    </div>
    <div class="main">
        <p>パスワードの再発行を行います。raqutyに登録しているメールアドレスを入力してください。<br>
            raqutyよりパスワード再設定用のURLをお送りいたします。</p>
        <form method="post" id="emailForm">
            <label for="user_mail">メールアドレス</label>
            <input type="email" id="user_mail" name="user_mail" placeholder="raquty@raquty.com" required>
            <input type="hidden" name="raquty_nonce" value="<?php echo $nonce_id ?>">
            <div id="cfm_msg"></div>
            <button id="confirm">確&nbsp;認</button>
        </form>
    </div>
</div>

<div class="Register_cfm" id="Register_cfm">
    <div class="modal">
        <p>以下のメールアドレス宛にパスワード再設定用のURLを送信します。<br>
            内容に誤りがある場合には、修正してください。<br>
            ※ご入力のメールアドレスが登録されていない場合、メールは届きません。</p>
            <div id="Email_cfm"></div>
        <div class='cfm_button'>
            <div>
                <button id="edit">修正する</button>
            </div>
            <div>
                <button id="submit">送&nbsp;信</button>
            </div>
        </div>
    </div>
</div>

<script src="/components/templates/Password_Reset/Password_Reset.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>