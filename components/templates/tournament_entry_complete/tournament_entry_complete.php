<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//tournament.phpからfunctionを借用
require_once(dirname(__FILE__).'/../tournament/functions.php') ;
//不正な遷移ならリダイレクト
if ($_SESSION['nonce_id'] !== h($_GET['raquty_nonce'])):?>
    <script> 
    alert('不正な遷移を確認しました。トーナメントトップにリダイレクトします。');
    window.location.href = "<?= home_url('Tournament') ?>";
</script>'; 
<?php endif;
//ログインしていなかったらリダイレクト
if(!is_login()):?>
    <script> 
        alert('セッションの有効期限が切れました。再度ログインをしてください。');
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
    <div class="event">
        <div class="h2_wrap">
            <h2>エントリー完了</h2>
        </div>
        <div class="detail">
            <div class="value">
                <p>エントリーが完了しました！<br>
                    大会についてのお問い合わせは、運営団体「<?php echo $group_data['organization_name'] ?>」までお願いします。<br><br>
                    大会当日のトーナメント進行状況などもサイト上からご確認いただけます。<br>
                    大会ページまたはマイページより「当日ページ」までお進みくださいませ。
                </p>
            </div>
        </div>
    </div>
    <div class="button_wrap">
        <button class="back" onclick="window.location.href='<?php echo home_url('Tournament/About?tournament_id=').h($_GET['tournament_id']) ?>'">大会ページに戻る</button>
        <button class="next" onclick="window.location.href='<?php echo home_url('MyPage')?>'">マイページへ</button>
        <button class="back_smartphone" onclick="window.location.href='<?php echo home_url('Tournament/About?tournament_id=').h($_GET['tournament_id']) ?>'">大会ページに戻る</button>        
    </div>
</div>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>