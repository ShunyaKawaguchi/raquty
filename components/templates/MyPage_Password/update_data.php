<?php
// セッションの開始
session_start();

// データベース認証
require_once(dirname(__FILE__).'/../../../raquty-cms-system/connect-databese.php');
// 共通Function(PHP)を読み込み
require_once(dirname(__FILE__).'/../../../components/common/global-function.php');


if ($_SESSION['nonce_id'] == $_POST['raquty_nonce']) {
        $user_data = get_player_data($_SESSION['user_id']);
        $user_id = $_SESSION['user_id'];
        $password_hash = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

        // パラメーターをバインド
        $sql = 'UPDATE raquty_users SET user_password = ? WHERE user_id = ?';
        $stmt = $user_access->prepare($sql);
        $stmt->bind_param('si',$password_hash , $user_id);

        // クエリの実行とエラーハンドリング
        if ($stmt->execute()) {
            // UPDATEが成功した場合の処理
            //ログの追加
            add_log($user_id , 'update_password', null, $user_data['user_password'], $password_hash);
            //リダイレクト
            $_SESSION['user_password_msg'] = 'パスワード情報の更新が完了しました。';
            header("Location: " . home_url('MyPage/Password'));   
            exit;

        } else {
            // エラーが発生した場合の処理
            error_log("UPDATE query failed: " . $stmt->error);
        }

        $stmt->close();

}

// データベース接続解除
require_once(dirname(__FILE__) . '/../../../raquty-cms-system/disconnect-database.php');