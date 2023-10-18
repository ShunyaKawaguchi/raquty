<?php
// セッションの開始
session_start();

// データベース認証
require_once(dirname(__FILE__).'/../../../raquty-cms-system/connect-databese.php');
// 共通Function(PHP)を読み込み
require_once(dirname(__FILE__).'/../../../components/common/global-function.php');


if ($_SESSION['nonce_id'] == $_POST['raquty_nonce']) {
        $user_id = $_SESSION['user_id'];
        $player_id = $_POST['player_id'];

        //選手ID重複チェック
        if($_POST['now_player_id'] !== $player_id){
            if(check_PlayerID_duplication($player_id)){
                $_SESSION['user_PlayerID_msg'] = '既に他のアカウントで利用されている選手IDのため、利用できません。';
                header("Location: " . home_url('MyPage/PlayerID'));   
                exit;
            }
        }

        // パラメーターをバインド
        $sql = 'UPDATE raquty_users SET player_id = ? WHERE user_id = ?';
        $stmt = $user_access->prepare($sql);
        $stmt->bind_param('si',$player_id , $user_id);

        // クエリの実行とエラーハンドリング
        if ($stmt->execute()) {
            // UPDATEが成功した場合の処理
            //ログの追加
            add_log($user_id , 'update_player_id', null, h($_POST['now_player_id']), $player_id);
            //リダイレクト
            $_SESSION['user_PlayerID_msg'] = '選手IDの更新が完了しました。';
            header("Location: " . home_url('MyPage/PlayerID'));   
            exit;

        } else {
            // エラーが発生した場合の処理
            error_log("UPDATE query failed: " . $stmt->error);
        }

        $stmt->close();

}

// データベース接続解除
require_once(dirname(__FILE__) . '/../../../raquty-cms-system/disconnect-database.php');

function check_PlayerID_duplication($player_id) {
    // 選手ID重複チェック
    global $user_access;
    $query = "SELECT * FROM raquty_users WHERE player_id = ?";
    
    $stmt = $user_access->prepare($query);
    $stmt->bind_param("s", $player_id);
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