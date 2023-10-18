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
if ($_SESSION['nonce_id3'] !== $_POST['raquty_nonce3']):?>
    <script> 
    alert('不正な遷移を確認しました。初めからやり直してください。');
    window.location.href = "<?= home_url('Tournament') ?>";
</script>'; 
<?php else:
    //このタイミングでnonce2を更新しておけば、ブラウザの戻るボタンを押されても不正な遷移として検知可能
    $nonce_id2 = raquty_nonce2();
    endif;
//ログインしていなかったらリダイレクト
if(!is_login()):?>
    <script> 
        alert('セッションの有効期限が切れました。再度ログインをして、初めからやり直してください。');
        window.location.href = "<?= home_url('Login_Authorization') ?>";
    </script>'; 
<?php 
    exit;
    endif;
//大会情報呼び出し
$tournament_data = check_tournament_existance( h($_POST['tournament_id']));
if(!$tournament_data):?>
<script>
    alert('該当する大会が見当たりませんでした。');
    window.location.href = "<?= home_url('Tournament') ?>";
</script>
<?php 
    exit;
    endif;
//期間判定
$today = date("Y-m-d");
if ($today >= $tournament_data['entry_start'] && $today <= $tournament_data['entry_end']) {
    //エントリー対象期間なので処理なし
} else { ?>
<script>
    alert('エントリー対象期間外です。エントリー期間をお確かめください。');
    window.location.href = "<?= home_url('Tournament/About?tournament_id=').h($_GET['tournament_id']) ?>";
</script>
<?php 
    exit;
}
//運営者情報呼び出し
$group_data = get_group_data($tournament_data['group_id']);

//種目情報呼び出し
$event_data = get_single_tournament_event(h($_POST['event_id']));

//選手情報呼び出し
$user1_data = get_user_info($_SESSION['user_id']);

//２つのDBに情報を登録
require_once(dirname(__FILE__).'/insert_data.php') ;

//ログDBに情報を追加
add_log($_SESSION['user_id'], 'entry' , h($_POST['event_id']) , null , $log_contents);

//エントリー完了メールを選手と運営に送信
require_once(dirname(__FILE__).'/send_mail.php') ;
require_once(dirname(__FILE__).'/send_mail_for_group.php') ;

//全てが成功したらエントリー完了ページへ
?>
<script>
    window.location.href = "<?= home_url('Tournament/Entry/Complete?tournament_id=').h($_POST['tournament_id']).'&raquty_nonce='.h($_POST['raquty_nonce']) ?>";
</script>

<?php 
//データベース接続解除
require_once(dirname(__FILE__).'/../../../raquty-cms-system/disconnect-database.php');