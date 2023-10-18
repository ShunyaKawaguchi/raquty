<?php  
// セッションの開始
session_start();

// データベース認証
require_once(dirname(__FILE__).'/../../../raquty-cms-system/connect-databese.php');
// 共通Function(PHP)を読み込み
require_once(dirname(__FILE__).'/../../../components/common/global-function.php');

//パスワード認証から開始
if ($_SESSION['nonce_id'] == $_POST['raquty_nonce']) {
    $user_id = $_SESSION['user_id'];
    $user_data = get_player_data($user_id);
    $log_before = 'player_ID:'.$user_id.'/'.$user_data['user_name'].'/'.$user_data['user_name_kana'].'/belonging:'.$user_data['user_belonging'].'/'.$user_data['user_birthday'].'/'.$user_data['user_mail'];

    $sql = 'DELETE FROM raquty_users WHERE user_id = ?';
    $stmt = $user_access->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $user_id);
        
        if ($stmt->execute()) {
            //ログ追加
            add_log($user_id, 'Withdrawal' , null , $log_before, null);

           //ログアウト処理
            unset($_SESSION['user_id']); 
            session_destroy();

            //真っ白な状態でセッションを再スタート
            session_start();

            //リダイレクト
            $_SESSION['about_raquty_messege'] = '退会処理が完了しました。raqutyをご利用いただき、ありがとうございました！';
            header("Location: " . home_url('About_raquty'));   
            exit;
        }

        $stmt->close();
    } else {
        // プリペアドステートメントの準備に失敗した場合の処理を追加

    }
}
    