<?php
session_start(); 
//↑template_loaderを使用しない処理のため、セッションを手動で開始する
//template_loaderを使用しない処理のため、global-function.phpを手動読み込み
require_once(dirname(__FILE__).'/../../common/global-function.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // もし送信元が home_url('Register_Form') ではない場合、リダイレクト
    if ($_SESSION['nonce_id']!==$_POST['raquty_nonce']) {
        header("Location: " . home_url(''));
        exit;
    }
}else{
    //　POSTの遷移でない場合に、リダイレクト
    header("Location: " . home_url(''));   
    exit;
}

//入力内容を配列で受け取り
$user_inputs = array(
    'lastNameKanji' => h($_POST['Last_name_kanji']),
    'firstNameKanji' => h($_POST['First_name_kanji']),
    'lastName' => h($_POST['Last_name']),
    'firstName' => h($_POST['First_name']),
    'belonging' => h($_POST['belonging']),
    'playerId' => h($_POST['player_id']),
    'birthday' => h($_POST['birthday']),
    'email' => h($_POST['email']),
    'password' => h($_POST['password']),
    'password_cfm' => h($_POST['password_cfm']),
    'terms' => isset($_POST['terms']) ? true : false,
);

//データベースに手動接続
require_once(dirname(__FILE__).'/../../../raquty-cms-system/connect-databese.php');

//入力内容チェック&情報登録
require_once(dirname(__FILE__).'/register_input_check.php');

//ログDBを追加
add_log($_SESSION['user_id'], 'register' , null , null, $log_contents);

//データベース接続手動解除
require_once(dirname(__FILE__).'/../../../raquty-cms-system/disconnect-database.php');

//リダイレクト
if(empty($error_messages)){
header("Location: " . home_url('Register_Cmp'));  
exit;
}
?>