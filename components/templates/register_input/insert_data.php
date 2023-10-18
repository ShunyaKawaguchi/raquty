<?php 
$combinedNameKanji = $user_inputs['lastNameKanji'] . ' ' . $user_inputs['firstNameKanji'];
$combinedName = $user_inputs['lastName'] . ' ' . $user_inputs['firstName'];
$password_hash = password_hash($user_inputs['password'] , PASSWORD_DEFAULT);

$insertQuery = "INSERT INTO raquty_users (player_id , user_name , user_name_kana , user_belonging , user_birthday , user_mail , user_password) VALUES (? , ? , ? , ? , ? , ? ,?)";
$insertStmt = $user_access->prepare($insertQuery);
$insertStmt->bind_param("ssssiss", $user_inputs['playerId'] , $combinedNameKanji , $combinedName , $user_inputs['belonging'] , $birthday , $user_inputs['email'] , $password_hash);

if ($insertStmt->execute()) {
    //選手IDを獲得
    $sql = "SELECT user_id FROM raquty_users WHERE user_mail = ?";
    $stmt = $user_access->prepare($sql);
    $stmt->bind_param("s", $user_inputs['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        //ログDB保存用の文字列作成
        $log_contents = 'player_ID:'.$user_inputs['playerId'].'/'.$combinedNameKanji.'/'.$combinedName.'/belonging:'.$user_inputs['belonging'].'/'.$birthday.'/'.$user_inputs['email'].'/password_hash:'.$password_hash;

        //ログイン状態をログイン済みにする
        $_SESSION['user_id'] = $row['user_id'];
    }
} 

$insertStmt->close();

?>