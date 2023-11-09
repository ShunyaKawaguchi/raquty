<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//必要情報呼び出し
require_once(dirname(__FILE__).'/functions.php');
//運営者情報呼び出し
$group_data = get_group_data($post_data['group_id']);
?>

<div class="tournament">
    <!-- <div class="title">TOURNAMENT</div>
    <div class="liner"></div> -->
    <div class="EyeCatch_smartphone">
        <?php eyecatch_view();?>
    </div>
    <div class="top">
        <div class="namecard">
            <!-- <img src="https://iwanuma-tennis-open.com/wp-content/uploads/2022/06/cropped-cropped-%E3%82%B5%E3%82%A4%E3%83%88%E3%83%AD%E3%82%B4%EF%BC%92.png"> -->
            <div class="tournament_name">大会名</div>
            <h2 class="tournament_name_value"><?php echo $post_data['tournament_name'] ?></h2>
        </div>
        <div class="info">
            <?php tournament_info_view($post_data , $group_data) ?>
        </div>
        <div class="for_today">
            <div class="text">大会当日はこちらから</div>
            <div class="today" onclick="window.location.href = '<?php echo home_url('OOP?tournament_id=').$post_data['tournament_id'] ?>';">大会<br>当日</div>
        </div>    
    </div>
    <div class="EyeCatch">
        <?php eyecatch_view();?>
    </div>
    <div class="Entry_related">
        <div class="entry_section">
            <img class="gif" src="/files/material/tennis-court.gif" alt="テニスコートgif">
            <div class="wrap">
                <p>\エントリーはこちらから/</p>
                <button onclick="window.location.href = '<?php echo home_url('Tournament/Entry?tournament_id=').$post_data['tournament_id'] ?>';" name="Entry_Start">Entry</button>
                <p>エントリーリストは<a href="<?php echo home_url('Tournament/Entry_List?tournament_id=').$post_data['tournament_id'] ?>">こちら</a></p>
            </div>
        </div>
        <div class="text_section">
            <?php entry_view( $post_data ) ?>
        </div>
        <div class="entry_section_smartphone">
            <img class="gif" src="/files/material/tennis-court.gif" alt="テニスコートgif">
            <div class="wrap">
                <p>\エントリーはこちらから/</p>
                <button onclick="window.location.href = '<?php echo home_url('Tournament/Entry?tournament_id=').$post_data['tournament_id'] ?>';" name="Entry_Start">Entry</button>
                <p>エントリーリストは<a href="<?php echo home_url('Tournament/Entry_List?tournament_id=').$post_data['tournament_id'] ?>">こちら</a></p>
            </div>
        </div>
    </div>
    <div class="document">
        <?php document_view( $post_data['tournament_id'] ) ?>
        <div class="for_today_smartphone">
            <div class="text">\大会当日はこちらから/</div>
            <button onclick="window.location.href = '<?php echo home_url('OOP?tournament_id=').$post_data['tournament_id'] ?>';">大会当日</button>
        </div>
    </div>
    <div class="schedule">
        <?php tournament_schedule_view( $post_data ) ?>
    </div>
    <div class="topics">
        <?php topics_view( $post_data['tournament_id'] ) ?>
    </div>
    <div class="operations">
        <?php operations_view( $post_data , $group_data ) ?>
    </div>
    <div class="venues">
        <?php venue_view( $post_data['tournament_id'] ) ?>
    </div>
</div>

<script src="/components/templates/tournament/tournament.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>