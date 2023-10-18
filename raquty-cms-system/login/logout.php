<?php
session_start();

//global_function読み込み
require_once(dirname(__FILE__).'/../../components/common/global-function.php');

//ログアウト関数
function raquty_user_logout(){
    unset($_SESSION['user_id']); 
    session_destroy();
    session_start();
    $_SESSION['about_raquty_messege'] = 'ログアウトしました。raqutyをご利用いただきありがとうございました！';
    header("Location: " . home_url('About_raquty'));   
    exit;
}
if(!empty($_POST['logoutFunction'])){
    raquty_user_logout();
}
?>
