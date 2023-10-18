<?php
$user_mail = $user_inputs['email'];
$subject = "raquty 選手登録完了";
$message = '<html>
<head>
</head>
<body>
<p>' .
    $combinedNameKanji . 'さん<br><br>' .
    '※このメールは、raqutyより自動的に送信しています。<br><br>' .
    'この度は、raqutyへの選手登録、誠にありがとうございます。<br>' .
    '選手登録が完了致しましたのでお知らせいたします。<br>' .
    $user_inputs['lastNameKanji'] . 'さんの選手IDは以下の通りです。<br><br>' .
    '選手ID&nbsp;:&nbsp;' . $user_inputs['playerId'] . '<br><br>' .
    '本メールに身に覚えの無い場合は、本メールを破棄していただきますようお願いいたします。<br><br><br>' .
    '＊＊＊＊お問い合わせ先＊＊＊＊<br>' .
    'raquty<br>' .
    '-Make tennis management easier-<br>' .
    '<a href="https://raquty.com">https://raquty.com</a></p><br>
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