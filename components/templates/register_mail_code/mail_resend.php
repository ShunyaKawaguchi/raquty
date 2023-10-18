<?php
session_start(); 

//template_loaderを使用しない処理のため、global-function.phpを手動読み込み
require_once(dirname(__FILE__).'/../../common/global-function.php');
function email_verification_code() {
    return mt_rand(100000, 999999);
}
//認証コード
$email_verification_code = email_verification_code();
//認証コードをセッションに登録
$_SESSION['auth_code'] = $email_verification_code;

//メール本文
$user_mail = $_SESSION['auth_mail'];
$subject = "【再送】raquty 選手登録認証コード";
$message = 
'<html>
<head>
</head>
<body>
<p>※このメールは、raqutyより自動的に送信しています。<br><br>
この度は、raqutyへの選手登録、誠にありがとうございます。<br>
メールアドレス認証コードをお送りいたします。<br><br>
【認証コード】' . $email_verification_code . '<br><br>
本メールに身に覚えの無い場合は、本メールを破棄していただきますようお願いいたします。<br><br><br>
＊＊＊＊お問い合わせ先＊＊＊＊<br>
raquty<br>
-Make tennis management easier-<br>
<a href="https://raquty.com">https://raquty.com</a></p><br>
</body>
</html>';

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
$headers .= 'From: ' . mb_encode_mimeheader('raquty', "UTF-8") . ' <register@raquty.com>' . "\r\n";

if (mb_send_mail($user_mail, $subject, $message, $headers)) {
    //メール送信成功時の処理
} else {
    //メール送信失敗時の処理
}

//メールを再送信したフラグをセッションに登録
$_SESSION['resend_flag'] = 1;

//リダイレクト
header("Location: " . home_url('Activation_user'));   
exit;
?>