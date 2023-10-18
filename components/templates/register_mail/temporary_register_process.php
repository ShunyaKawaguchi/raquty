<?php
session_start(); 
//↑template_loaderを使用しない処理のため、セッションを手動で開始する
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
function email_verification_code() {
    return mt_rand(100000, 999999);
}

//認証コード
$email_verification_code = email_verification_code();

//認証メール送信プロセス
require_once(dirname(__FILE__).'/mail_send.php');


//セッションに認証メールアドレスと認証コードを設定
$_SESSION['auth_mail'] = h($_POST['user_mail']);
$_SESSION['auth_code'] = $email_verification_code;

//認証ページにリダイレクト
header("Location: " . home_url('Activation_user'));
exit;
?>