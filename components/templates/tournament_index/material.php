<?php 
//新着大会表示
function get_new_tournament(){
    $number = 1;
    $latest_tournament_data = get_latest_tournament_data();
    foreach ($latest_tournament_data as $tournament):
        $group_data = get_group_data( $tournament['group_id'] );?>
        <div class="single_tournament">
            <div class="cards">
                <div class="number"><?php echo $number ?>.</div>
                <div class="namecard">
                    <div class="tournament_name">大会名</div>
                    <div class="tournament_name_value"><?php echo $tournament['tournament_name'] ?></div>
                </div>
                <?php get_entry_status($tournament); ?>
                <a href="<?php echo home_url('Tournament/About?tournament_id=').$tournament['tournament_id'] ?>" class="view_tournament">大会<br>詳細へ</a>
            </div>
            <div class="infomations">
                <div class="wrap">
                    <div class="date">日時</div>
                    <div class="date_value">
                        <?php 
                            $tournament_date_array = explode(",", $tournament['date']);
                            $date_timestamps = array_map('strtotime', $tournament_date_array);
                            if (count($date_timestamps) === 1) {
                                $date_range = date("Y年n月j日", $date_timestamps[0]);
                            } else {
                                $first_date = date("Y年n月j日", min($date_timestamps));
                                $last_date = date("Y年n月j日", max($date_timestamps));
                                $date_range = $first_date . "〜" . $last_date;
                            }
                            echo $date_range;
                        ?>
                    </div>
                </div>
                <div class="wrap">
                    <div class="organizer">主催</div>
                    <div class="organizer_value"><?php echo $group_data['organization_name'] ?></div>
                </div>
                <div class="wrap">
                    <div class="venue">会場</div>
                    <div class="venue_value">
                        <?php get_venue_new_tournament( $tournament['tournament_id'] ) ?>
                    </div>
                </div>
            </div>
            <div class="border"></div>
        </div>
    <?php         
    $number = $number + 1;
    endforeach;
} 

function get_latest_tournament_data($limit = 10) {
    $sql = "SELECT * FROM tournament WHERE post_status = ? ORDER BY post_date DESC LIMIT ?";
    global $cms_access; 
    $stmt = $cms_access->prepare($sql);
    $post_status = 'publish';
    $stmt->bind_param("si",$post_status , $limit); 
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = [];

    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    $stmt->close();

    return $rows; 
}

//大会の受付ステータス取得
function get_entry_status($tournament){
    $today = date("Y-m-d");
    if ($today >= $tournament['entry_start'] && $today <= $tournament['entry_end']) {
        echo "<div class='entry_status' style='background-color:red;'>エントリー<br>受付中</div>";
    }elseif($today > $tournament['entry_end']){
        echo "<div class='entry_status' style='background-color:#424242;'>エントリー<br>締切済</div>";
    }elseif($today < $tournament['entry_start']){
        echo "<div class='entry_status' style='background-color:#424242;'>エントリー<br>開始前</div>";
    }

}

//会場名取得
function get_venue_new_tournament($tournament_id) {
    $sql = "SELECT template_id FROM venues WHERE tournament_id = ?";
    global $cms_access;
    $stmt = $cms_access->prepare($sql); 
    $stmt->bind_param("i", $tournament_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    $venue_names = array(); 

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $venue_info = get_venue_info($row['template_id']);
            $venue_names[] = $venue_info['venue_name'];
        }

        if (count($venue_names) > 0) {
            $first_venue = array_shift($venue_names);
            $other_venues = count($venue_names); 

            echo $first_venue;
            
            if ($other_venues > 0) {
                echo "&nbsp;&nbsp;（他 ".$other_venues." 会場）";
            }
        }
    }
}

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

//日付のセレクトボックス
function create_date_option(){
    $currentYear = date("Y");
    $currentMonth = date("n");               
    for ($i = 0; $i < 3; $i++) {
        $year = $currentYear + $i;
        for ($month = 1; $month <= 12; $month++) {
            if ($year == $currentYear && $month < $currentMonth) {
                continue;
            }            
            $formattedMonth = str_pad($month, 2, "0", STR_PAD_LEFT);
            echo "<option value='$year-$formattedMonth'>$year 年 $formattedMonth 月</option>";
        }
    }
}

//検索関連
function get_result_tournament_search($tournament_name, $age, $type, $region, $date) {
    $result_ids = array();
    $conditions = array();

    if (!empty($tournament_name)) {
        $result_name = result_search_name($tournament_name);
        if ($result_name === false) {
            return false;
        }
        $conditions[] = $result_name;
    }

    if (!empty($age)) {
        $result_age = result_search_age($age);
        if ($result_age === false) {
            return false;
        }
        $conditions[] = $result_age;
    }

    if (!empty($type)) {
        $result_type = result_search_type($type);
        if ($result_type === false) {
            return false;
        }
        $conditions[] = $result_type;
    }

    if (!empty($region)) {
        $result_region = result_search_region($region);
        if ($result_region === false) {
            return false;
        }
        $conditions[] = $result_region;
    }

    if (!empty($date)) {
        $result_date = result_search_date($date);
        if ($result_date === false) {
            return false;
        }
        $conditions[] = $result_date;
    }

    // 全ての条件を組み合わせて共通の大会IDを求める
    if (!empty($conditions)) {
        $result_ids = call_user_func_array('array_intersect', $conditions);
    }

    if (empty($result_ids)) {
        return false;
    }

    return $result_ids;
}


//大会名検索
function result_search_name($tournament_name) {
    $sql = "SELECT tournament_id FROM tournament WHERE tournament_name LIKE ?";
    global $cms_access;
    $stmt = $cms_access->prepare($sql);

    $search_term = '%' . $tournament_name . '%';

    $stmt->bind_param("s", $search_term);
    $stmt->execute();
    $result = $stmt->get_result();

    $result_tournament_name = array(); 

    while ($row = $result->fetch_assoc()) {
        $result_tournament_name[] = $row['tournament_id'];
    }

    if (empty($result_tournament_name)) {
        return false;
    }

    return $result_tournament_name;
}

//年齢検索
function result_search_age($age) {
    $sql = "SELECT DISTINCT tournament_id FROM event_list WHERE ? >= `min-age` AND ? <= `max-age`";
    global $cms_access;
    $stmt = $cms_access->prepare($sql);

    $stmt->bind_param("ii", $age, $age);
    $stmt->execute();
    $result = $stmt->get_result();

    $result_tournament_age = array(); 

    while ($row = $result->fetch_assoc()) {
        $result_tournament_age[] = $row['tournament_id'];
    }

    if (empty($result_tournament_age)) {
        return false;
    }

    return $result_tournament_age;
}

//種目検索
function result_search_type($type) {
    $sql = "SELECT tournament_id FROM event_list WHERE type = ?";
    global $cms_access;
    $stmt = $cms_access->prepare($sql);

    $stmt->bind_param("s", $type);
    $stmt->execute();
    $result = $stmt->get_result();

    $result_tournament_type = array(); 

    while ($row = $result->fetch_assoc()) {
        $result_tournament_type[] = $row['tournament_id'];
    }

    if (empty($result_tournament_type)) {
        return false;
    }

    return $result_tournament_type;
}

//地区別検索
function result_search_region($region) {
    global $cms_access;

    $region_keys = array();

    if ($region === "北海道") {
        $region_keys[$region] = array("北海道");
    } elseif ($region === "東北") {
        $region_keys[$region] = array("宮城県", "岩手県", "秋田県", "山形県", "福島県", "青森県");
    } elseif ($region === "関東") {
        $region_keys[$region] = array("東京都", "神奈川県", "千葉県", "埼玉県", "茨城県", "栃木県", "群馬県");
    } elseif ($region === "中部") {
        $region_keys[$region] = array("愛知県", "岐阜県", "静岡県", "三重県");
    } elseif ($region === "北陸") {
        $region_keys[$region] = array("富山県", "石川県", "福井県");
    } elseif ($region === "関西") {
        $region_keys[$region] = array("大阪府", "兵庫県", "京都府", "奈良県", "滋賀県", "和歌山県");
    } elseif ($region === "四国") {
        $region_keys[$region] = array("香川県", "徳島県", "愛媛県", "高知県");
    } elseif ($region === "中国") {
        $region_keys[$region] = array("鳥取県", "島根県", "岡山県", "広島県", "山口県");
    } elseif ($region === "九州") {
        $region_keys[$region] = array("福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県");
    } elseif ($region === "沖縄") {
        $region_keys[$region] = array("沖縄県");
    }

    $result_tournament_region = array();

    foreach ($region_keys as $prefectures) {
        foreach ($prefectures as $prefecture) {
            $sql = "SELECT DISTINCT tournament_id FROM tournament WHERE region = ?";
            $stmt = $cms_access->prepare($sql);
            $stmt->bind_param("s", $prefecture);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $result_tournament_region[] = $row['tournament_id'];
            }
        }
    }

    if (empty($result_tournament_region)) {
        return false;
    }

    return $result_tournament_region;
}

//年月検索
function result_search_date($date) {
    global $cms_access;

    $year_month = date('Y/m', strtotime($date));

    $sql = "SELECT tournament_id FROM tournament WHERE date LIKE ?";
    
    $stmt = $cms_access->prepare($sql);

    $search_param = '%' . $year_month . '%';
    $stmt->bind_param("s", $search_param);

    $stmt->execute();
    $result = $stmt->get_result();

    $result_tournament_ids = array(); 

    while ($row = $result->fetch_assoc()) {
        $result_tournament_ids[] = $row['tournament_id'];
    }

    if (empty($result_tournament_ids)) {
        return false;
    }

    return $result_tournament_ids;
}

//検索結果表示
function get_result_tournament($result_tournament_ids){
    $number = 1;
    $tournament_datas = get_result_tournament_data($result_tournament_ids);
    foreach ($tournament_datas as $tournament):
        $group_data = get_group_data( $tournament['group_id'] );?>
        <div class="single_tournament">
            <div class="cards">
                <div class="number"><?php echo $number ?>.</div>
                <div class="namecard">
                    <div class="tournament_name">大会名</div>
                    <div class="tournament_name_value"><?php echo $tournament['tournament_name'] ?></div>
                </div>
                <?php get_entry_status($tournament); ?>
                <a href="<?php echo home_url('Tournament/About?tournament_id=').$tournament['tournament_id'] ?>" class="view_tournament">大会<br>詳細へ</a>
            </div>
            <div class="infomations">
                <div class="wrap">
                    <div class="date">日時</div>
                    <div class="date_value">
                        <?php 
                            $tournament_date_array = explode(",", $tournament['date']);
                            $date_timestamps = array_map('strtotime', $tournament_date_array);
                            if (count($date_timestamps) === 1) {
                                $date_range = date("Y年n月j日", $date_timestamps[0]);
                            } else {
                                $first_date = date("Y年n月j日", min($date_timestamps));
                                $last_date = date("Y年n月j日", max($date_timestamps));
                                $date_range = $first_date . "〜" . $last_date;
                            }
                            echo $date_range;
                        ?>
                    </div>
                </div>
                <div class="wrap">
                    <div class="organizer">主催</div>
                    <div class="organizer_value"><?php echo $group_data['organization_name'] ?></div>
                </div>
                <div class="wrap">
                    <div class="venue">会場</div>
                    <div class="venue_value">
                        <?php get_venue_new_tournament( $tournament['tournament_id'] ) ?>
                    </div>
                </div>
            </div>
            <div class="border"></div>
        </div>
    <?php         
    $number = $number + 1;
    endforeach;
} 

function get_result_tournament_data($result_tournament_ids) {
    foreach($result_tournament_ids as $tournament_id){
        $sql = "SELECT * FROM tournament WHERE post_status = ? AND tournament_id = ? ORDER BY entry_end";
        global $cms_access; 
        $stmt = $cms_access->prepare($sql);
        $post_status = 'publish';
        $stmt->bind_param("si",$post_status ,$tournament_id); 
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = [];

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $stmt->close();
    }

    return $rows; 
}