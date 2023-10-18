<?php
$user_mail = $group_data['mail'];
$subject = "大会にエントリーがありました！";
$message = 
'<html>
<head>
</head>
<body>
<p>
※このメールは、raqutyより自動的に送信しています。<br><br>
平素よりraqutyをご利用いただき、誠にありがとうございます。<br>
下記大会へのエントリーがありました。<br><br>
【大会名】' . $tournament_data['tournament_name'] . '<br>
【種目】' . $event_data['event_name'] . '<br><br>
raquty Adminにログインすると選手を確認できます。<br><br>
★raquty Admin★<br>
<a href="https://manage.raquty.com/Tournament/View/Entry?tournament_id='.$tournament_data['tournament_id'].'">https://manage.raquty.com/Tournament/View/Entry?tournament_id='.$tournament_data['tournament_id'].'</a><br><br>
＊＊＊＊メール送信元＊＊＊＊<br>
raquty<br>
-Make tennis management easier-<br>
<a href="https://raquty.com">https://raquty.com</a></p>
</body>
</html>';

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
$headers .= 'From: ' . mb_encode_mimeheader('raquty', "UTF-8") . ' <tournament@raquty.com>' . "\r\n";

if (mb_send_mail($user_mail, $subject, $message, $headers)) {
    //メール送信成功時の処理
} else {
    //メール送信失敗時の処理
}
?>