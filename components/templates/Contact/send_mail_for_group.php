<?php
$user_mail = 'support@raquty.com';
$subject = "【raquty】お問い合わせがありました。";
$sender_message = nl2br(h($_POST['sender_message']));
$message = 
'<html>
<head>
</head>
<body>
<p>
※このメールは、raqutyより自動的に送信しています。<br><br>
下記の内容にて、お客様よりお問い合わせがありました。<br><br>
【名前】<br>'
. h($_POST['sender_name']) . '<br>
【メールアドレス】<br>'
. h($_POST['sender_mail']) . '<br>
【お問合せ内容】<br>'
 . $sender_message . '<br><br><br>
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