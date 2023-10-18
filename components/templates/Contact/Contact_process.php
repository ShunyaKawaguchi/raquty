<?php 
//セッションを手動で開始
session_start(); 

//データベース認証
require_once(dirname(__FILE__).'/../../../raquty-cms-system/connect-databese.php');
//共通Function(PHP)を読み込み
require_once(dirname(__FILE__).'/../../../components/common/global-function.php');
//tournament.phpからfunctionを借用
require_once(dirname(__FILE__).'/../tournament/functions.php') ;
//不正な遷移ならリダイレクト
if ($_SESSION['nonce_id2'] !== $_POST['raquty_nonce2']):?>
    <script> 
    alert('不正な遷移を確認しました。初めからやり直してください。');
    window.location.href = "<?= home_url('Contact') ?>";
</script>'; 
<?php
endif;

//エントリー完了メールを選手と運営に送信
require_once(dirname(__FILE__).'/send_mail.php') ;
require_once(dirname(__FILE__).'/send_mail_for_group.php') ;

//全てが成功したらエントリー完了ページへ
?>
<script>
    window.location.href = "<?= home_url('Contact?sts=Done&raquty_nonce=').h($_POST['raquty_nonce']) ?>";
</script>

<?php 
//データベース接続解除
require_once(dirname(__FILE__).'/../../../raquty-cms-system/disconnect-database.php');