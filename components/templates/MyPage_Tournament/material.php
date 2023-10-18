<?php
function create_entered_Tournament_List(){
    $user_id = $_SESSION['user_id'];
    global $user_access;

    $sql = 'SELECT event_id FROM entry_event WHERE user_id = ?';
    $stmt = $user_access->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) :
            $event_data = get_event_data($row['event_id']);
            $tournament_data = get_tournament_data($event_data['tournament_id']);
            $date = date_edit($tournament_data['date']);
            $status = get_entry_status($event_data['tournament_id'], $user_id, $row['event_id']);
?>
        <div class="single_event">
            <div class="wrap">
                <div class="about">大会名</div>
                <div class="about_value"><?php echo $tournament_data['tournament_name'] ?></div>
            </div>
            <div class="wrap">
                <div class="about">種目</div>
                <div class="about_value"><?php echo $event_data['event_name'] ?></div>
            </div>
            <div class="wrap">
                <div class="about">期間</div>
                <div class="about_value"><?php echo $date ?></div>
            </div>
            <div class="wrap">
                <div class="about">ステータス</div>
                <div class="about_value"><?php echo $status ?></div>
            </div>
            <div class="menu_links">
                <a href="<?php echo home_url('Tournament/About?tournament_id=').$event_data['tournament_id'] ?>" class="single_menu">大会ページ</a>
                <a href="<?php echo home_url('OOP?tournament_id=').$event_data['tournament_id'] ?>" class="single_menu">大会当日ページ</a>
                <a href="<?php echo home_url('Tournament/Topics?tournament_id=').$event_data['tournament_id'] ?>" class="single_menu">最新情報</a>
            </div>

        </div>
<?php endwhile;
    }else{
        echo '<p>エントリー済みの大会はありません。<p>';
    }

}

function date_edit($date){
    $tournament_date_array = explode(",", $date );
    $date_timestamps = array_map('strtotime', $tournament_date_array);
    if (count($date_timestamps) === 1) {
        $date_range = date("Y年n月j日", $date_timestamps[0]);
    } else {
        $first_date = date("Y年n月j日", min($date_timestamps));
        $last_date = date("Y年n月j日", max($date_timestamps));
        $date_range = $first_date . "〜" . $last_date;
    }

    return $date_range;
}

function get_entry_status($tournament_id, $user_id, $event_id) {
    global $tournament_access;
    $table_name = $tournament_id . '_entrylist';
    $sql = "SELECT draw_id FROM $table_name WHERE (user1_id = ? OR user2_id = ?) AND event_id = ?";
    $stmt = $tournament_access->prepare($sql);
    $stmt->bind_param("iii", $user_id, $user_id, $event_id);
    $stmt->execute();
    $stmt->bind_result($row);
    $stmt->fetch();
    
    if ($row === 9999) {
        return 'キャンセル済';
    }
    //種目のステータス（中止）などが決まったら処理を追加
    
    return '受付済';
}

