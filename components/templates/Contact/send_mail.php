<?php
$user_mail = h($_POST['sender_mail']);
$subject = "お問い合わせありがとうございます。";
$sender_message = nl2br(h($_POST['sender_message']));
$message = 
'<html>
<head>
</head>
<body>
<p>'
.h($_POST['sender_name']).'様<br><br>
※このメールは、raqutyより自動的に送信しています。<br><br>
平素よりraqutyをご利用いただき、誠にありがとうございます。<br>
下記の内容にてお問い合わせを承りました。<br>
内容を確認後、担当者よりご連絡させていただきます。<br>
お問い合わせの内容によっては、返信までにお時間を頂戴する場合がございます。<br><br>
【お問合せ内容】<br>'
 . $sender_message . '<br><br>
本メールに身に覚えの無い場合は、本メールを破棄していただきますようお願いいたします。<br><br><br>
＊＊＊＊メール送信元＊＊＊＊<br>
raquty<br>
-Make tennis management easier-<br>
<a href="https://raquty.com">https://raquty.com</a></p>
</body>
</html>';

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
$headers .= 'From: ' . mb_encode_mimeheader('raquty', "UTF-8") . ' <support@raquty.com>' . "\r\n";

if (mb_send_mail($user_mail, $subject, $message, $headers)) {
    //メール送信成功時の処理
} else {
    //メール送信失敗時の処理
}
?>