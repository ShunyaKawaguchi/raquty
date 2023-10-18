<?php 
//ページネーション
function tournament_topics_paging($max){
    //該当の行数を取得
    $sql = "SELECT COUNT(post_id) AS row_count FROM tournament_topics WHERE tournament_id = ? AND post_status = ?";
    global $cms_access;
    $stmt = $cms_access->prepare($sql);
    $status = 'publish';
    $stmt->bind_param("is", $_GET['tournament_id'], $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    //該当の行数を取得
    $post_count = $row['row_count'];

    //1ページあたりの最大表示数
    $max_page = $max;
    //ページネーション数を算出
    $paging_number = ceil($post_count / $max_page);

    //パラメーターからページ数を獲得
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if($_GET['page'] <= 0 || $_GET['page'] > $paging_number){
            $page = 1;
        }    
    } else {
        $page = 1;
    }
    //配列を作成
    $paging = array(
        'max'=>$max_page,
        'now'=>$page,
        'num'=>$paging_number,
        'start'=>($page-1)*$max_page
    );

    return $paging;
}

//ページネーション表示用
function generatePagingLinks($paging) {
    if ($paging['now'] != 1) {
        echo '<a href="' . home_url('Tournament/Topics?tournament_id='.$_GET['tournament_id']. '&page=' .  ($paging['now'] - 1)) . '">&lt;&lt;</a>';
    }

    if ($paging['num'] > 5) {
        if ($paging['now'] >= 3) {
            if (($paging['num'] - $paging['now'] >= 2)) {
                for ($number = $paging['now'] - 2; $number <= $paging['now'] + 2; $number++) {
                    echo '<a href="' . ($number != $paging['now'] ? home_url('Tournament/Topics?tournament_id='.$_GET['tournament_id']. '&page=' . $number) : 'javascript:void(0)') . '" ' . ($number == $paging['now'] ? "class='active'" : '') . '>' . $number . '</a>';
                }
            } else {
                for ($number = $paging['num'] - 4; $number <= $paging['num']; $number++) {
                    echo '<a href="' . ($number != $paging['now'] ? home_url('Tournament/Topics?tournament_id='.$_GET['tournament_id']. '&page=' . $number) : 'javascript:void(0)') . '" ' . ($number == $paging['now'] ? "class='active'" : '') . '>' . $number . '</a>';
                }
            }
        } else {
            for ($number = 1; $number <= 5; $number++) {
                echo '<a href="' . ($number != $paging['now'] ? home_url('Tournament/Topics?tournament_id='.$_GET['tournament_id']. '&page=' . $number) : 'javascript:void(0)') . '" ' . ($number == $paging['now'] ? "class='active'" : '') . '>' . $number . '</a>';
            }
        }
    } else {
        for ($number = 1; $number <= $paging['num']; $number++) {
            echo '<a href="' . ($number != $paging['now'] ? home_url('Tournament/Topics?tournament_id='.$_GET['tournament_id']. '&page=' . $number) : 'javascript:void(0)') . '" ' . ($number == $paging['now'] ? "class='active'" : '') . '>' . $number . '</a>';
        }
    }

    if ($paging['now'] != $paging['num']) {
        echo '<a href="' . home_url('Tournament/Topics?tournament_id='.$_GET['tournament_id']. '&page=' .  ($paging['now'] + 1)) . '">&gt;&gt;</a>';
    }
}
?>