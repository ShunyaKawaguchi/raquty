<?php
// セッションの開始
session_start();

// データベース認証
require_once(dirname(__FILE__).'/../../../raquty-cms-system/connect-databese.php');
// 共通Function(PHP)を読み込み
require_once(dirname(__FILE__).'/../../../components/common/global-function.php');


if ($_SESSION['nonce_id'] == $_POST['raquty_nonce']) {
        $user_name = h($_POST['user_name']);
        $user_name_kana = h($_POST['user_name_kana']);
        $user_belonging = h($_POST['user_belonging']);
        $user_birthday = $_POST['user_birthday']; 
        $user_birthday = str_replace('-', '', $user_birthday);
        $user_birthday = preg_replace('/[^0-9]/', '', $user_birthday); 
        $user_mail = h($_POST['user_mail']);
        $user_id = $_SESSION['user_id'];
        
        //メールアドレス重複チェック
        if($_POST['mail_before'] !== $user_mail){
            if(check_mail_duplication($user_mail)){
                $_SESSION['user_info_msg'] = '既に他のアカウントで利用されているメールアドレスのため、利用できません。';
                header("Location: " . home_url('MyPage/UserInfo'));   
                exit;
            }else{
                require_once(dirname(__FILE__).'/mail_send.php') ;
            }
        }

        // パラメーターをバインド
        $sql = 'UPDATE raquty_users SET user_name = ?, user_name_kana = ?, user_belonging = ?, user_birthday = ?, user_mail = ? WHERE user_id = ?';
        $stmt = $user_access->prepare($sql);
        $stmt->bind_param('sssisi', $user_name,$user_name_kana,$user_belonging,$user_birthday,$user_mail,$user_id);

        // クエリの実行とエラーハンドリング
        if ($stmt->execute()) {
            // UPDATEが成功した場合の処理
            //ログの追加
            $log_after = 'user_name:'.$user_name.'/user_name_kana:'.$user_name_kana.'/user_belonging:'.$user_belonging.'/user_birthday:'.$user_birthday.'/user_mail:'.$user_mail;
            add_log($user_id , 'update_user_info', null, h($_POST['log_before']), $log_after);
            //リダイレクト
            $_SESSION['user_info_msg'] = '登録情報の更新が完了しました。';
            header("Location: " . home_url('MyPage/UserInfo'));   
            exit;

        } else {
            // エラーが発生した場合の処理
            error_log("UPDATE query failed: " . $stmt->error);
        }

        $stmt->close();

}

// データベース接続解除
require_once(dirname(__FILE__) . '/../../../raquty-cms-system/disconnect-database.php');

function check_mail_duplication($user_mail) {
    // メールアドレス重複チェック
    global $user_access;
    $query = "SELECT * FROM raquty_users WHERE user_mail = ?";
    
    $stmt = $user_access->prepare($query);
    $stmt->bind_param("s", $user_mail);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}
