<?php
// データベース認証
require_once(dirname(__FILE__).'/../../../raquty-cms-system/connect-databese.php');
// 共通Function(PHP)を読み込み
require_once(dirname(__FILE__).'/../../../components/common/global-function.php');

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$tournament_id = isset($_GET['tournament_id']) ? $_GET['tournament_id'] : '';
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : '';
// クエリパラメータに応じてデータを返す
$response = array('get_all_child_entry_list' => get_all_child_entry_list($tournament_id), 'get_all_child_event_type' => get_all_child_event_type($tournament_id));

// オリジンを設定してCORSを有効にする
// JSON形式でデータを出力
echo json_encode($response);
// データベース接続解除
require_once(dirname(__FILE__).'/../../../raquty-cms-system/disconnect-database.php');
function get_all_child_entry_list($_tournament_id){
    $table_name = h($_tournament_id)."_drawlist";
    $query = "SELECT * FROM $table_name";
    global $tournament_access;
    $stmt = $tournament_access -> prepare($query);
    if($stmt ===  false){
        die("プリペアードステートメントの準備に失敗しました。");
    }
    if($stmt->execute() === false){
        die("クエリの実行に失敗しました。");
    }
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $table_name2 = h($_tournament_id)."_entrylist";
            $query2 = "SELECT * FROM $table_name2 WHERE id = ?";
            $stmt2 = $tournament_access -> prepare($query2);
            if($stmt2 ===  false){
                die("プリペアードステートメントの準備に失敗しました。");
            }
            $stmt2 -> bind_param('i', $row['entry_id']);
            if($stmt2->execute() === false){
                die("クエリの実行に失敗しました。");
            }
            $result2 = $stmt2->get_result();
            $row2 = $result2->fetch_assoc();
            //result2は1行しかないはず
            $list = array(
                'id' => $row['id'],
                'entry_id' => $row['entry_id'],//これはentrylistのid
                'event_id' => $row['event_id'],
                'child_event_id' => $row['child_event_id'],
                'draw_id' => $row['draw_id'],
                'user1_id' => $row2['user1_id'],
                'user1_name' => $row2['user1_name'],
                'user1_belonging' => $row2['user1_belonging'],
                'user2_id' => $row2['user2_id'],
                'user2_name' => $row2['user2_name'],
                'user2_belonging' => $row2['user2_belonging']
            );
            $response[]= $list;
        }
    }else{
        $response = '大会参加者が現在存在しないか、参加者がおりません。';
    }
    return $response;
}
function get_entry_list($_tournament_id, $_event_id){
    $event_info = get_event_type($_tournament_id, $_event_id);
    $event_type = $event_info[0]['type'];
    $table_name = $_tournament_id."_entrylist";
    $query = "SELECT * FROM $table_name WHERE event_id = ?";
    global $tournament_access;
    $stmt = $tournament_access -> prepare($query);
    if($stmt ===  false){
        die("プリペアードステートメントの準備に失敗しました。");
    }
    $stmt -> bind_param('s', $_event_id);
    if($stmt->execute() === false){
        die("クエリの実行に失敗しました。");
    }
    $result = $stmt->get_result();
    if($event_type == 'シングルス'){
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $list = array(
                    'id' => $row['id'],
                    'draw_id' => $row['draw_id'],
                    'user1_id' => $row['user1_id'],
                    'user1_name' => $row['user1_name'],
                    'user1_belonging' => $row['user1_belonging'],
                );
                $response[]= $list;
            }
        }else{
            $response = '大会参加者が現在存在しないか、参加者がおりません。';
        }
    }else if($event_type == 'ダブルス'){
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $list = array(
                    'id' => $row['id'],
                    'draw_id' => $row['draw_id'],
                    'user1_id' => $row['user1_id'],
                    'user1_name' => $row['user1_name'],
                    'user1_belonging' => $row['user1_belonging'],
                    'user2_id' => $row['user2_id'],
                    'user2_name' => $row['user2_name'],
                    'user2_belonging' => $row['user2_belonging'],
                );
                $response[]= $list;
            }
        }else{
            $response = '大会参加者が現在存在しないか、参加者がおりません。';
        }
    }
    return $response;
}
function get_all_child_event_type($_tournament_id){
    $table_name = "child_event_list";
    $status = 1;
    $query = "SELECT * FROM $table_name WHERE tournament_id = ? AND status = ?";
    global $cms_access;
    $stmt = $cms_access -> prepare($query);
    if($stmt ===  false){
        die("プリペアードステートメントの準備に失敗しました。");
    }
    $stmt -> bind_param('ii', $_tournament_id, $status);
    if($stmt->execute() === false){
        die("クエリの実行に失敗しました。");
    }
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $list = array(
                'id' => $row['id'],
                'tournament_id' => $row['tournament_id'],
                'event_id' => $row['event_id'],
                'child_event_name' => $row['child_event_name'],
                'event_type' => $row['event_type'],
                'capacity' => $row['capacity']
            );
            $response[]= $list;
        }
    }else{
        $response = '対象となる子イベントがありません。';
    }
    return $response;
}
function get_event_type($_tournament_id, $_event_id){
    $table_name = "event_list";
    $query = "SELECT * FROM $table_name WHERE tournament_id = ? AND event_id = ?";
    global $cms_access;
    $stmt = $cms_access -> prepare($query);
    if($stmt ===  false){
        die("プリペアードステートメントの準備に失敗しました。");
    }
    $stmt -> bind_param('ss', $_tournament_id, $_event_id);
    if($stmt->execute() === false){
        die("クエリの実行に失敗しました。");
    }
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $list = array(
                'event_name' => $row['event_name'],
                'type' => $row['type'],
                'gender' => $row['gender']    
            );
            $response[]=$list;
        }
    }else{
        $response = '大会参加者が現在おりません。';
    }
    return $response;
}
?>