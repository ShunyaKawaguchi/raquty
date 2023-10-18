<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//セキュリティ対策のためnonce利用
$nonce_id3 = raquty_nonce3();
//tournament.phpからfunctionを借用
require_once(dirname(__FILE__).'/../tournament/functions.php') ;
//不正な遷移ならリダイレクト
if ($_SESSION['nonce_id2'] !== $_POST['raquty_nonce2']):?>
    <script> 
    alert('不正な遷移を確認しました。初めからやり直してください。');
    window.location.href = "<?= home_url('Tournament') ?>";
</script>'; 
<?php endif;
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
$tournament_data = check_tournament_existance( h($_GET['tournament_id']));
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
?>

<div class="Tournament_Entry">
    <form method="post" id="Entry">
        <div class="Entry">Entry</div>
        <div class="liner"></div>
        <div class="top">
            <div class="selected_title">選択中の大会</div>
            <div class="selected_value"><?php echo $tournament_data['tournament_name'] ?></div>
            <div class="info">
                <?php tournament_info_view($tournament_data , $group_data) ?>
            </div>
        </div>
        <div class="event">
            <div class="h2_wrap">
                <h2>内容確認</h2>
            </div>
            <div class="detail">
                <?php $event_data = get_single_tournament_event($_POST['event_id']) ?>
                <?php $user_info = get_user_info($_SESSION['user_id']) ?>
                <div class="value">選手ID<br><span><?php echo $user_info['player_id'] ?></span></div>
                <div class="value">選手名<br><span><?php echo $user_info['user_name'] ?></span></div>
                <div class="value">所属<br><span><?php echo $user_info['user_belonging'] ?></span></div>
                <div class="value">種目<br><span><?php echo $event_data['event_name'] ?></span></div>

            </div>

        </div>
        <div class="button_wrap">
            <input type="hidden" name="tournament_id" value="<?php echo h($_GET['tournament_id'])?>">
            <input type="hidden" name="event_id" value="<?php echo h($_POST['event_id'])?>">
            <input type="hidden" name="raquty_nonce" value="<?php echo $_POST['raquty_nonce'] ?>">
            <input type="hidden" name="raquty_nonce2" value="<?php echo $_POST['raquty_nonce2'] ?>">
            <input type="hidden" name="raquty_nonce3" value="<?php echo $nonce_id3 ?>">
            <input type="submit" class="next_smartphone" value="エントリー確定" id="Next">
            <input type="submit" class="back" value="戻る" formaction="<?php echo home_url('Tournament/Entry/Event?tournament_id=').h($_GET['tournament_id']) ?>">
            <input type="submit" class="next" value="エントリー確定" id="Next1">
        </div>
    </form>
</div>

<script src="/components/templates/tournament_entry_confirm/tournament_entry_confirm.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>