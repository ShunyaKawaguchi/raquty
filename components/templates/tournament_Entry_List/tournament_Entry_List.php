<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//必要情報呼び出し
require_once(dirname(__FILE__).'/material.php');
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
?>

<div class="Entry_List_View">
    <div class="title">Entry&nbsp;List</div>
    <div class="liner"></div>
    <div class="main">
        <div class="wrap">
            <div class="selected">大会名</div>
            <div class="selected_value"><?php echo $tournament_data['tournament_name']?></div>
        </div>
        <div class="List">
            <?php create_entry_list($tournament_data['tournament_id']); ?>
        </div>
    </div>
    <div class="submit_wrap">
        <button class="next" onclick="window.location.href='<?php echo home_url('Tournament/About?tournament_id=').$tournament_data['tournament_id']; ?>'">大会ページに戻る</button>
    </div>
</div>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>