<?php
//メール認証コード（.heaccessにてアクセス拒否）
session_start();
echo $_SESSION['auth_code'];
echo $_SESSION['auth_code_reset_password'];
?>
