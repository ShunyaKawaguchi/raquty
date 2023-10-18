<?php
// データベース認証
require_once(dirname(__FILE__).'/../../../manage-raquty-cms-system/connect-databese.php');
// 共通Function(PHP)を読み込み
require_once(dirname(__FILE__).'/../../../components/common/global-function.php');
// データベース接続解除
require_once(dirname(__FILE__).'/../../../manage-raquty-cms-system/disconnect-database.php');
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$tournament_id = isset($_SESSION['tournament_id']) ? $_SESSION['tournament_id'] : null;
// クエリパラメータに応じてデータを返す
$response = array('get_order_of_play' => get_order_of_play($tournament_id), 'get_result' => get_result($tournament_id));

// オリジンを設定してCORSを有効にする
// JSON形式でデータを出力
echo json_encode($response);
function get_order_of_play($_tournament_id){
    $table_name = $_tournament_id."_game_index";
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
                'game_id' => $row['game_id'],
                'venue_id' => $row['venue_id'],
                'court_num' => $row['court_num'],
                'round' => $row['round'],
                'match_id'=> $row['match_id'],
                'category' => $row['category'],
                'draw_id_1' => $row['draw_id_1'],
                'draw_id_2' => $row['draw_id_2'],
                'status' => $row['status'],
                'start_at' => $row['start_at']  
            );
            $response[]= $list;
        }
    }else{
        $response = null;
    }
}
function get_result($_tournament_id){
    $table_name = $_tournament_id."_result";
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
                'game_id' => $row['game_id'],
                'score1' => $row['score1'],
                'score2' => $row['score2'],
                'tiebreak1' => $row['tiebreak1'],
                'winner_id' => $row['winner_id'],
                'timestamp' => $row['timestamp']
            );
            $response[]= $list;
        }
    }else{
        $response = null;
    }
    return $response;
}
?>