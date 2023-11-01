<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//必要情報呼び出し
require_once(dirname(__FILE__).'/material.php');
require_once(dirname(__FILE__).'/round_robin_material.php') ;
//大会情報呼び出し
$tournament_data = check_tournament_existance( h($_GET['tournament_id']));
$child_event_data = get_single_draw($tournament_data['tournament_id'] , $_GET['child_event_id']);
$event_data = get_event_data($child_event_data['event_id']);
?>

<div class="Draw">
    <div class="title">Draw</div>
    <div class="liner"></div>
    <div class="main">
        <div class="tournament_name">
            <div class="wrap">
                <div class="name">【 大 会 】</div><div class="value"><?=$tournament_data['tournament_name'];?></div>
            </div>
            <div class="wrap">
                <div class="name">【 種 目 】</div><div class="value"><?=$event_data['event_name'];?></div>
            </div>
            <div class="wrap">
                <div class="name">【 ドロー 】</div><div class="value"><?=$child_event_data['child_event_name'];?></div>
            </div>
        </div>
        <div class="Listing">
        <?php 
            if($child_event_data['event_type'] == 1){
                echo '<div class="tournament" id="tournament">';
                    generate_tournament($child_event_data['capacity'],$event_data['type']);
                echo '</div>';
            }elseif( $child_event_data['event_type'] == 2){
                echo '<div class="RoundRobin" id="RoundRobin">';
                generate_RoundRobin($child_event_data['capacity'],$event_data['type']);
                echo '</div>';

            }
        ?>
        </div>
        <div class="submit_wrap">
            <button class="next" onclick="window.location.href='<?php echo home_url('Tournament/Draw?tournament_id=').$tournament_data['tournament_id']; ?>'">ドロー一覧へ戻る</button>
        </div>
    </div>
</div>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>