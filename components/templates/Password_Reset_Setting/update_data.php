<?php
// セッションの開始
session_start();

// データベース認証
require_once(dirname(__FILE__).'/../../../raquty-cms-system/connect-databese.php');
// 共通Function(PHP)を読み込み
require_once(dirname(__FILE__).'/../../../components/common/global-function.php');

if ($_SESSION['nonce_id'] === $_POST['raquty_nonce']) {
    $user_mail = $_SESSION['auth_mail_reset_password'];
    $password_hash = password_hash(h($_POST['user_password']) , PASSWORD_DEFAULT);

    $sql = 'UPDATE raquty_users SET user_password = ? WHERE user_mail = ?';
    $stmt = $user_access->prepare($sql);

    $stmt->bind_param('ss',$password_hash , $user_mail);

    if ($stmt->execute()) {
        // 更新が成功した場合の処理
        $_SESSION['request_url'] = home_url('MyPage');
        unset($_SESSION['auth_code_reset_password']);
        echo "<script>
                    window.addEventListener('load', function() {
                        const message = 'パスワードを再設定しました。ログイン画面からログインしてください。';
                        alert(message);
                        const newLocation = '" . home_url('Login_Authorization') ."';
                        window.location.href = newLocation;
                    });
                </script>";

    } else {
        // エラーが発生した場合の処理
    }

    $stmt->close();
}


// データベース接続解除
require_once(dirname(__FILE__).'/../../../raquty-cms-system/disconnect-database.php');

