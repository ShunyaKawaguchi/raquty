<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//必要情報呼び出し
require_once(dirname(__FILE__).'/material.php');
//大会情報呼び出し
$tournament_data = check_tournament_existance( h($_GET['tournament_id']));
?>

<div class="Draw">
    <div class="title">Draw</div>
    <div class="liner"></div>
    <div class="main">
        <div class="tournament_name">【大会名】<br><?php echo $tournament_data['tournament_name'];?></div>
        <div class="Listing">
            <?php event_warp(h($_GET['tournament_id'])); ?>
        </div>
        <div class="submit_wrap">
            <button class="next" onclick="window.location.href='<?php echo home_url('Tournament/About?tournament_id=').$tournament_data['tournament_id']; ?>'">大会ページに戻る</button>
        </div>
    </div>
</div>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>