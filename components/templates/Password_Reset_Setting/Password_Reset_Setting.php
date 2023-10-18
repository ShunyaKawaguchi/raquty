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
//メールからのページ遷移でない場合にはリダイレクト
if(empty($_GET['auth'])){
    echo "<script>
            window.addEventListener('load', function() {
                const message = '不正な遷移を検知しました。トップページに戻ります。';
                alert(message);
                const newLocation = '" . home_url('') ."';
                window.location.href = newLocation;
            });
        </script>";
}elseif($_GET['auth'] !== $_SESSION['auth_code_reset_password']){
    echo "<script>
        window.addEventListener('load', function() {
            const message = '不正な遷移を検知しました。初めからやり直してください。';
            alert(message);
            const newLocation = '" . home_url('') ."';
            window.location.href = newLocation;
            });
        </script>";
}
?>

<div class="Register_Password">
    <div class="Register">LOGIN</div>
    <div class="liner"></div>
    <div class="h2_wrap">
        <h2>パスワード再設定</h2>
    </div>
    <div class="main">
        <p>メールアドレスの認証が完了しました。<br>
            新しいパスワード（半角英数字8文字以上16文字以下）を設定してください。</p>
        <div id="cfm_msg"></div>
        <form method="post" id="PasswordForm" onsubmit="return validatePassword()">
            <label for="user_password">パスワード</label>
            <input type="password" id="user_password" name="user_password" required>
            <label for="user_password_cfm">パスワード（再入力）</label>
            <input type="password" id="user_password_cfm" name="user_password_cfm" required>
            <input type="hidden" name="raquty_nonce" value="<?php echo $nonce_id ?>">
            <button id="Submit" type="submit">設&nbsp;定</button>
        </form>
    </div>
</div>

<script src="/components/templates/Password_Reset_Setting/Password_Reset_Setting.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>