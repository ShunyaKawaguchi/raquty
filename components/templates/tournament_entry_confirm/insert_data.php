<?php 
$table_name = h($_POST['tournament_id']).'_entrylist';
$insertQuery = "INSERT INTO $table_name (user1_id , user1_name , user1_belonging , event_id ) VALUES (? , ? , ? , ?)";
$stmt = $tournament_access->prepare($insertQuery);
$event_id = h($_POST['event_id']);

if ($stmt) {
    $stmt->bind_param("issi",$_SESSION['user_id'],$user1_data['user_name'],$user1_data['user_belonging'],$event_id);
    
    if ($stmt->execute()) {
       //データ挿入完了
       $log_contents = $user1_data['user_name'].'/'.$user1_data['user_belonging'];
    } else {
        die('データベース接続エラーが発生しました。管理者に連絡してください。');
    }

    $stmt->close();
} else {
    die('データベース接続エラーが発生しました。管理者に連絡してください。');
}

$insertQuery = "INSERT INTO entry_event (user_id , event_id ) VALUES (? , ?)";
$stmt = $user_access->prepare($insertQuery);
$event_id = h($_POST['event_id']);

if ($stmt) {
    $stmt->bind_param("ii",$_SESSION['user_id'],$event_id);
    
    if ($stmt->execute()) {
       //データ挿入完了
    } else {
        die('データベース接続エラーが発生しました。管理者に連絡してください。');
    }

    $stmt->close();
} else {
    die('データベース接続エラーが発生しました。管理者に連絡してください。');
}
