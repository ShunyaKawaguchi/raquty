<?php
session_start(); 
//↑template_loaderを使用しない処理のため、セッションを手動で開始する
//データベース認証
require_once(dirname(__FILE__).'/../../../raquty-cms-system/connect-databese.php');
//template_loaderを使用しない処理のため、global-function.phpを手動読み込み
require_once(dirname(__FILE__).'/../../common/global-function.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // もし送信元が home_url('Register') ではない場合、リダイレクト
    if ($_SESSION['nonce_id']!==$_POST['raquty_nonce']) {
        header("Location: " . home_url(''));
        exit;
    }
}else{
    //　POSTの遷移でない場合に、リダイレクト
    header("Location: " . home_url(''));   
    exit;
}

//ランダムで６桁のメール認証コードを生成する
function email_verification_code($length = 100) {
    $bytes = random_bytes($length);
    return bin2hex($bytes);
}

function user_exist($mail){
    $sql = 'SELECT user_id FROM raquty_users WHERE user_mail = ?';
    global $user_access;
    $stmt = $user_access->prepare($sql);
    $stmt->bind_param('s', $mail);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    return $result->num_rows === 1;
}


if(user_exist(h($_POST['user_mail']))){
    //認証コード
    $email_verification_code = email_verification_code();
    //認証メール送信プロセス
    require_once(dirname(__FILE__).'/mail_send.php');
}


//セッションに認証メールアドレスと認証コードを設定
$_SESSION['auth_code_reset_password'] = $email_verification_code;
$_SESSION['auth_mail_reset_password'] = h($_POST['user_mail']);

//データベース接続解除
require_once(dirname(__FILE__).'/../../../raquty-cms-system/disconnect-database.php');

//認証ページにリダイレクト ?>
<script> 
    alert('パスワード再設定メールを送信しました。メールのURLよりパスワードを再設定してください。');
    window.location.href = "<?= home_url('Password_Reset') ?>";
</script>'; 
