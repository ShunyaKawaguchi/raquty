<?php
$user_mail = h($_POST['user_mail']);
$subject = "raquty パスワード再設定メール";
$message = 
'<html>
<head>
</head>
<body>
<p>※このメールは、raqutyより自動的に送信しています。<br><br>
平素よりraqutyをご利用いただき、誠にありがとうございます。<br>
下記のパスワード再設定用のURLよりパスワードを再設定してください。<br><br>
<a href="https://raquty.com/Password_Reset/Setting?auth=' . $email_verification_code . '">https://raquty.com/Password_Reset/Setting?auth=' . $email_verification_code . '<a><br><br>
※必ず同一ブラウザでURLを開いてください。<br><br>
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
?>