<?php
session_start();
//↑template_loaderを使用しない処理のため、セッションを手動で開始する
//template_loaderを使用しない処理のため、global-function.phpを手動読み込み
require_once(dirname(__FILE__).'/../../common/global-function.php');

//メール認証コードをリセット
$_SESSION['auth_code'] = "";
//メールデータをリセット
$_SESSION['auth_mail'] = "";

header("Location: " . home_url('Register'));   
exit;
?>