<?php
// データベース認証
require_once(dirname(__FILE__).'/../../../manage-raquty-cms-system/connect-databese.php');
// 共通Function(PHP)を読み込み
require_once(dirname(__FILE__).'/../../../components/common/global-function.php');
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$tournament_id = isset($_GET['tournament_id']) ? $_GET['tournament_id'] : '';
// クエリパラメータに応じてデータを返す
$response = array('get_entry_list' => get_entry_list($tournament_id), 'get_event_id' => get_event_id($tournament_id));

// オリジンを設定してCORSを有効にする
// JSON形式でデータを出力
echo json_encode($response);
// データベース接続解除
require_once(dirname(__FILE__).'/../../../manage-raquty-cms-system/disconnect-database.php');

function get_entry_list($_tournament_id){
    $table_name = $_tournament_id."_entrylist";
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
            $list = array(
                'id' => $row['id'],
                'draw_id' => $row['draw_id'],
                'user1_id' => $row['user1_id'],
                'user1_name' => $row['user1_name'],
                'user1_belonging' => $row['user1_belonging'],
                'user2_id' => $row['user2_id'],
                'user2_name' => $row['user2_name'],
                'user2_belonging' => $row['user2_belonging'],
                'event_id' => $row['event_id'],
            );
            $response[]= $list;
        }
    }else{
        $response = '大会参加者が現在存在しないか、参加者がおりません。';
    }
    return $response;
}

function get_event_id($_tournament_id){
    $table_name = "event_list";
    $query = "SELECT * FROM $table_name WHERE tournament_id = ?";
    global $cms_access;
    $stmt = $cms_access -> prepare($query);
    if($stmt ===  false){
        die("プリペアードステートメントの準備に失敗しました。");
    }
    $stmt -> bind_param('s', $_tournament_id);
    if($stmt->execute() === false){
        die("クエリの実行に失敗しました。");
    }
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $list = array(
                'event_id' => $row['event_id'],
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