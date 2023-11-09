<?php
//大会日程
function tournament_date_view( $tournament_date ){
    $dateArray = explode(',', $tournament_date);
    foreach($dateArray as $single_date){
        echo "<div class='single_date'>".$single_date."</div>";
    }
}

//トーナメント情報
function tournament_info_view($post_data , $group_data){ ?>
    <div class="wrap">
        <div class="date">日時</div>
        <div class="date_value"><?php tournament_date_view( $post_data['date'] )?></div>
    </div>
    <div class="wrap">
        <div class="organizer">主催</div>
        <div class="organizer_value"><?php echo $group_data['organization_name']; ?></div>
    </div>
    <div class="wrap">
        <div class="venue">会場</div>
        <div class="venue_value"><?php get_venue( $post_data['tournament_id'] ) ?></div>
    </div>
<?php }

//アイキャッチ画像表示
function eyecatch_view() {
    $tournament_id = h($_GET['tournament_id']);
    $eyecatch_path = get_document_path_return($tournament_id , 'eyecatch'); 
    if(!empty($eyecatch_path)){ ?>
    <img src="https://manage.raquty.com/<?php echo $eyecatch_path['document_path'];?>" alt="大会アイキャッチ画像">
<?php
    }
}


//エントリー条件
function entry_view( $post_data ){ 
    $before_entry_end = DateTime::createFromFormat('Y-m-d', $post_data['entry_end']);
    $entry_end = $before_entry_end->format('Y年m月d日');
?>
    <div class="h3_wrap">
        <h3>エントリー条件</h3>
    </div>
    <div class="list">
        <div class="list_wrap">
            <div class="about"><strong>対象</strong></div>
            <div class="about_value" id="target"><?php echo nl2br($post_data['target']) ?></div>
        </div>
        <div class="list_wrap">
            <div class="about"><strong>種目</strong></div>
            <?php get_tournament_event_data( $post_data['tournament_id'] ); ?>
        </div>
        <div class="list_wrap_half">
            <div class="about"><strong>エントリー締切</strong></div>
            <div class="about_value"><?php echo $entry_end ?></div>
        </div>
        <div class="list_wrap_half">
            <div class="about"><strong>団体加盟料</strong></div>
            <div class="about_value">なし</div>
        </div>
    </div>
<?php }

//スケジュールバー
function tournament_schedule_view( $post_data ){ 
    //日付の配列処理
    $dateArray = explode(',', $post_data['date']);
    $earliestDate = null;
    $latestDate = null;
    foreach ($dateArray as $date) {
        $timestamp = strtotime($date);
        if ($timestamp !== false) {
            if ($earliestDate === null || $timestamp < $earliestDate) {
                $earliestDate = $timestamp;
            }
            if ($latestDate === null || $timestamp > $latestDate) {
                $latestDate = $timestamp;
            }
        }
    }
    if ($earliestDate !== null) {
        $earliestDateString = date('m/d', $earliestDate);
        
    }
    if ($latestDate !== null) {
        $latestDateString = date('m/d', $latestDate);
    }
    $before_entry_start = DateTime::createFromFormat('Y-m-d', $post_data['entry_start']);
    $entry_start = $before_entry_start->format('m/d');   
    $before_entry_end =  DateTime::createFromFormat('Y-m-d', $post_data['entry_end']);
    $entry_end = $before_entry_end->format('m/d');   
    $before_draw_open =  DateTime::createFromFormat('Y-m-d', $post_data['draw_open']);
    $draw_open = $before_draw_open->format('m/d');   

    ?>
    <div class="h3_wrap">
        <h3>スケジュール</h3>
    </div>
    <div class="schedule_bar">
        <div class="block">
            <div class="txt">エントリー開始</div>
            <div class="wrap">
                <div class="border"></div>
            </div>
            <div class="bar_1"></div>
            <div class="bar_date"><?php echo $entry_start ?>〜</div>
        </div>
        <div class="block">
            <div class="bar_date_1"><?php echo $entry_end ?></div>
            <div class="bar_2"></div>
            <div class="wrap">
                <div class="border"></div>
            </div>
            <div class="txt">エントリー締切</div>
        </div>
        <div class="block">
            <div class="txt">ドロー発表</div>
            <div class="wrap">
                <div class="border"></div>
            </div>
            <div class="bar_3"></div>
            <div class="bar_date"><?php echo $draw_open ?></div>
        </div>
        <div class="block">
            <div class="bar_date_1"><?php echo $earliestDateString ?>〜</div>
            <div class="bar_4"></div>
            <div class="wrap">
                <div class="border"></div>
            </div>
            <div class="txt">大会開始</div>
        </div>
        <div class="block">
            <div class="txt">大会終了</div>
            <div class="wrap">
                <div class="border"></div>
            </div>
            <div class="bar_5"></div>
            <div class="bar_date"><?php echo $latestDateString ?></div>
        </div>
    </div>


    
<?php } 

//ドキュメントリスト
function document_view( $tournament_id ){ 
    $outline_path = get_document_path_return($tournament_id , 'outline');
    $timetable_path = get_document_path_return($tournament_id , 'timetable');?>

    <div class="h3_wrap">
        <h3>大会資料</h3>
    </div>
    <div class="document_list">
        <?php if(!$outline_path): ?>
            <div class="box_1" id="Document_None">大会<br>要綱</div>
        <?php else: ?>
            <a class="box_1" href="https://manage.raquty.com/<?php echo $outline_path['document_path'];?>" style="background-color:#2D9AFF;" target="_blank">大会<br>要綱</a>  
        <?php endif; ?>
        <?php if(!$timetable_path): ?>
            <div class="box" id="Document_None">日程表</div>
        <?php else: ?>
            <a class="box" href="https://manage.raquty.com/<?php echo $timetable_path['document_path'];?>" style="background-color:#2D9AFF;" target="_blank">日程表</a>  
        <?php endif; ?>
        <?php if(get_draw_status($tournament_id)):?>
            <a class="box" style="background-color:#2D9AFF;" href="<?php echo home_url('Tournament/Draw?tournament_id=').$tournament_id;?>">ドロー</a>
        <?php else:?>
            <a class="box" href="<?php echo home_url('Tournament/Draw?tournament_id=').$tournament_id;?>">ドロー</a>
        <?php endif;?>
        <div class="box_1" id="Document_None">大会<br>結果</div>
    </div>
<?php }

//大会資料パス取得関数
function get_document_path_return($tournament_id , $document_type = ''){
    $sql = 'SELECT 	* FROM document_path WHERE document_type = ? AND tournament_id = ?';
    global $cms_access;
    $stmt = $cms_access->prepare($sql);
    $stmt->bind_param('si', $document_type , $tournament_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        return $row;
    }else{
        return false;
    }
}

//ドローが公開されているのか確認
function get_draw_status($tournament_id) {
    $sql = "SELECT COUNT(*) FROM child_event_list WHERE tournament_id = ? AND status = ?";
    $status = 1;
    global $cms_access;
    $stmt = $cms_access->prepare($sql);
    $stmt->bind_param("ii", $tournament_id, $status);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    return $count > 0;
}


//トピックス
function topics_view( $tournament_id ){ ?>
    <div class="h3_wrap">
        <h3>お知らせ</h3>
    </div>
    <div class="topics_list">
        <?php 
        $sql = "SELECT post_id FROM tournament_topics WHERE tournament_id = ? AND post_status = ? ORDER BY post_date DESC LIMIT 5";
        global $cms_access;
        $stmt = $cms_access->prepare($sql);
        $status = 'publish';
        $stmt->bind_param("is", $tournament_id, $status); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $topics = get_tournament_post_data($row['post_id']);
                $date = trim_post_date($topics['post_date'], 'date'); ?>
                <a href="<?php echo home_url("Tournament/Topics/Article?topics_id=".$topics['post_id']) ?>" class="post_list">
                    <div class="date"><?php echo $date ?></div>
                    <div class="title"><?php echo $topics['post_title'] ?></div>
                </a>
            <?php } ?>
            <div class="clearfix">
                <a href="<?php echo home_url('Tournament/Topics?tournament_id='.$tournament_id) ?>" class="new_post_button">MORE</a>
            </div>
        <?php
        } else {
            echo "<p class='topics_not_found'>現在、大会運営からのお知らせはありません。</p>";
        }
        ?>
    </div>
<?php }

//運営団体
function operations_view( $post_data , $group_data){ ?>
    <div class="h3_wrap">
        <h3>運営団体</h3>
    </div>
    <div class="block_wrap">
        <div class="block">
            <div class="icon"><i class="fas fa-users"></i></div>
            <div class="txt"><?php echo $group_data['organization_name']; ?></div>
        </div>
        <?php if(!empty($group_data['phone'])):?>
        <div class="block">
            <div class="icon"><i class="fas fa-phone"></i></div>
            <div class="txt"><?php echo $group_data['phone']; ?></div>
        </div>
        <?php endif;?>
        <div class="block">
            <div class="icon"><i class="fas fa-envelope"></i></div>
            <div class="txt"><?php echo $group_data['mail']; ?></div>
        </div>
        <div class="block">
            <div class="icon"><i class="fas fa-info-circle"></i></div>
            <div class="txt_msg">
                <div class="about">大会運営より</div>
                <p><?php echo nl2br($post_data['comment']) ?></p>
            </div>
        </div>
    </div>
<div class="border"></div>
<?php }

//会場データ取得
function get_venue_info( $template_id ){
    $sql = "SELECT * FROM venues WHERE template_id = ?";
    global $organizations_access;
    $stmt = $organizations_access->prepare($sql); 
    $stmt->bind_param("i", $template_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        return $row; 
    }
}

//会場(ページ下部)
function venue_view( $tournament_id ){ 
    $sql = "SELECT template_id FROM venues WHERE tournament_id = ?";
    global $cms_access;
    $stmt = $cms_access->prepare($sql); 
    $stmt->bind_param("i", $tournament_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) { ?>
        <div class="h3_wrap">
            <h3>会場</h3>
        </div>
    <?php
        while ($row = $result->fetch_assoc()) {
            $venue_info = get_venue_info( $row['template_id'] ); ?>
             <div class="venues_blocks">
                <div class="block">
                    <div class="venue_name"><?php echo $venue_info['venue_name'] ?></div>
                    <div class="address"><?php echo $venue_info['venue_address'] ?></div>
                    <div class="map"><?php echo add_map_id(d($venue_info['venue_map'])) ?></div>
                </div>
            </div>
    <?php }
    }
} 

//会場名のみ取得
function get_venue( $tournament_id ){
    $sql = "SELECT template_id FROM venues WHERE tournament_id = ?";
    global $cms_access;
    $stmt = $cms_access->prepare($sql); 
    $stmt->bind_param("i", $tournament_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $venue_info = get_venue_info( $row['template_id'] );
            echo "<div class='single_venue'>".$venue_info['venue_name']."</div>";
        }
    }

}

//iframeにid="map-iframe"を付与
function add_map_id($map_code){
    // idを追加する
    $additional_string = ' id="map-iframe"';
    $modified_venue_map = preg_replace('/<iframe(.*?)>/', '<iframe$1' . $additional_string . '>', $map_code, 1);

    // widthとheight属性を削除する
    $modified_venue_map = preg_replace('/(width|height)=".*?"/', '', $modified_venue_map);

    return $modified_venue_map;
}

//種目情報取得関数
function get_tournament_event_data($tournament_id) {
    $sql = "SELECT event_id FROM event_list WHERE tournament_id = ?";
    global $cms_access; 
    $stmt = $cms_access->prepare($sql);
    $stmt->bind_param("i", $tournament_id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $event_data = get_single_tournament_event($row['event_id']); ?>
            <div class="about_value" id="event">・<?php echo $event_data['event_name'] ?><br>（定員：<?php echo $event_data['capacity'] ?>名 / 料金：<?php echo $event_data['fee'] ?>円）</div>
    <?php }
    }
}

//種目別のエントリー人数を取得
function get_entry_number($event_id) {
    $entry_table_name = h($_GET['tournament_id']) . '_entrylist';
    $sql = "SELECT COUNT(id) as row_count FROM $entry_table_name WHERE event_id = ? AND (draw_id != 9999 OR draw_id IS NULL)";
    global $tournament_access;
    $stmt = $tournament_access->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row['row_count'];
}

//種目が満員かどうか判断する関数
function get_event_entry_status($event_id){
    $event_data = get_single_tournament_event($event_id); 
    $entry_number = get_entry_number($event_id);
    if($event_data['capacity']<=$entry_number){
        return false;
    }else{
        return true;
    }
}