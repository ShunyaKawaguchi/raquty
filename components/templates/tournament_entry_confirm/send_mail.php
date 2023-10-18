<?php
$user_mail = $user1_data['user_mail'];
$subject = "大会エントリーが完了しました！";
$message = 
'<html>
<head>
</head>
<body>
<p>'
.$user1_data['user_name'].'さん<br><br>
※このメールは、raqutyより自動的に送信しています。<br><br>
平素よりraqutyをご利用いただき、誠にありがとうございます。<br>
下記大会へのエントリーが完了しました。<br><br>
【大会名】' . $tournament_data['tournament_name'] . '<br>
【種目】' . $event_data['event_name'] . '<br><br>
本大会に関するお問い合わせにつきましては、運営団体の「'.$group_data['organization_name'].'」までお問合せください。<br><br>
★大会の情報は大会ページから★<br>
<a href="https://raquty.com/Tournament/About?tournament_id='.h($_POST['tournament_id']).'">https://raquty.com/Tournament/About?tournament_id='.h($_POST['tournament_id']).'</a><br><br>
★大会の最新トピックスも確認！★<br>
<a href="https://raquty.com/Tournament/Topics?tournament_id='.h($_POST['tournament_id']).'">https://raquty.com/Tournament/Topics?tournament_id='.h($_POST['tournament_id']).'</a><br><br>
本メールに身に覚えの無い場合は、本メールを破棄していただきますようお願いいたします。<br><br><br>
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