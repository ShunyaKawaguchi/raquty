<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//セキュリティ対策のためnonce利用
$nonce_id = raquty_nonce();
//tournament.phpからfunctionを借用
require_once(dirname(__FILE__).'/../tournament/functions.php') ;
//ログインしていなかったらリダイレクト
if(!is_login()):?>
    <script> 
        alert('大会にエントリーするにはログインをしてください。');
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
    <div class="Entry">Entry</div>
    <div class="liner"></div>
    <div class="top">
        <div class="selected_title">選択中の大会</div>
        <div class="selected_value"><?php echo $tournament_data['tournament_name'] ?></div>
        <div class="info">
            <?php tournament_info_view($tournament_data , $group_data) ?>
        </div>
    </div>
    <div class="user">
        <div class="h2_wrap">
            <h2>情報確認</h2>
        </div>
        <div class="detail">
            <?php $user_info = get_user_info($_SESSION['user_id']) ?>
            <div class="value">選手ID<br><span><?php echo $user_info['player_id'] ?></span></div>
            <div class="value">選手名<br><span><?php echo $user_info['user_name'] ?></span></div>
            <div class="value">所属<br><span><?php echo $user_info['user_belonging'] ?></span></div>
        </div>
    </div>
    <div class="Msg">
        <div class="icon"><i class="fas fa-info-circle"></i></div>
        <div class="txt_msg">
            <div class="about">大会運営より</div>
            <p><?php echo nl2br($tournament_data['comment']) ?></p>
        </div>
    </div>
    <div class="button_wrap">
        <form method="post">
            <input type="hidden" name="raquty_nonce" value="<?php echo $nonce_id ?>">
            <input type="submit" class="next_smartphone" value="種目選択へ" formaction="<?php echo home_url('Tournament/Entry/Event?tournament_id=').h($_GET['tournament_id']) ?>">
            <input type="submit" class="back" value="戻る" formaction="<?php echo home_url('Tournament/About?tournament_id=').h($_GET['tournament_id']) ?>">
            <input type="submit" class="next" value="種目選択へ" formaction="<?php echo home_url('Tournament/Entry/Event?tournament_id=').h($_GET['tournament_id']) ?>">
        </form>
    </div>

</div>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>