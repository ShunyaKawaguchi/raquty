<?php
//投稿データを配列で返す
function get_post_data( $post_id ){
    $sql = "SELECT * FROM post_info WHERE post_id = ?";
    global $cms_access; 
    $stmt = $cms_access->prepare($sql);
    $stmt->bind_param("i", $post_id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row; //post_dataを配列で返す
}

//大会記事データを配列で返す
function get_tournament_post_data( $post_id ){
    $sql = "SELECT * FROM tournament_topics WHERE post_id = ?";
    global $cms_access; 
    $stmt = $cms_access->prepare($sql);
    $stmt->bind_param("i", $post_id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row; //post_dataを配列で返す
}

//raquty_newsデータを配列で返す
function get_raquty_news_data( $post_id ){
    $sql = "SELECT * FROM raquty_news WHERE post_id = ?";
    global $cms_access; 
    $stmt = $cms_access->prepare($sql);
    $stmt->bind_param("i", $post_id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row; //post_dataを配列で返す
}

//大会データを配列で返す
function get_tournament_data( $tournament_id ){
    $sql = "SELECT * FROM tournament WHERE tournament_id = ?";
    global $cms_access; 
    $stmt = $cms_access->prepare($sql);
    $stmt->bind_param("i", $tournament_id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row; //post_dataを配列で返す
}

//大会名称をエコーする
function tournament_name( $tournament_id ){
    $sql = "SELECT * FROM tournament WHERE tournament_id = ?";
    global $cms_access; 
    $stmt = $cms_access->prepare($sql);
    $stmt->bind_param("i", $tournament_id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row['tournament_name'];
}

//記事の投稿日時の加工関数
function trim_post_date( $date , $pattern ){
    if($pattern=='date'){
        $after_date = mb_substr($date, 0, -9);
    }elseif($pattern=='time'){
        $after_date = mb_substr($date, 0, -3);
    }
    return $after_date;
}

//home_url() 関数
function home_url( $dir = '') {
    $format = (empty($_SERVER['HTTPS'])) ? 'http://' : 'https://';
    return $format . $_SERVER['HTTP_HOST'] . '/' . ltrim($dir, '/');
}

// サニタイズ
function h($str){return htmlspecialchars($str, ENT_QUOTES, "UTF-8");}

//逆サニタイズ
function d($str){
    return html_entity_decode($str, ENT_QUOTES, "UTF-8");
}

//nonce関数
function raquty_nonce(){

    // ランダムな文字列を生成して nonce_id としてセッションに保管
    $nonce_id = generateRandomString();
    $_SESSION['nonce_id'] = $nonce_id;

    return $nonce_id;
}

//raquty_nonceを複数回利用したいとき
function raquty_nonce2(){

    // ランダムな文字列を生成して nonce_id としてセッションに保管
    $nonce_id = generateRandomString();
    $_SESSION['nonce_id2'] = $nonce_id;

    return $nonce_id;
}

//raquty_nonceを複数回利用したいとき
function raquty_nonce3(){

    // ランダムな文字列を生成して nonce_id としてセッションに保管
    $nonce_id = generateRandomString();
    $_SESSION['nonce_id3'] = $nonce_id;

    return $nonce_id;
}

// ランダムな英数10文字の文字列を作成
function generateRandomString($length = 10) {
    $bytes = random_bytes($length);
    return bin2hex($bytes);
}

//ログイン判定関数
function is_login(){
    if(!empty($_SESSION['user_id'])){
        $login_status = true;
    }else{
        $login_status = false;
    }
    return $login_status;
}

//ログイン関数
function raquty_user_login($request_url){
    //ログイン失敗メッセージを初期化
    unset($_SESSION['login_error_message']);
    //ログインフォームから情報を受け取る
    $user_mail = h($_POST['user_email']);
    $user_password = h($_POST['user_password']);

    $sql = 'SELECT 	user_id , user_mail , user_password FROM raquty_users WHERE user_mail = ?';
    global $user_access;
    $stmt = $user_access->prepare($sql);
    $stmt->bind_param('s', $user_mail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $stored_password_hash = $row['user_password'];
        if (password_verify($user_password, $stored_password_hash)) {
            $_SESSION['user_id'] = $row['user_id'];
            unset($_SESSION['request_url']);
            header("Location: " . $request_url);
        } else {
            $_SESSION['login_error_message'] = 1;
            header("Location: " . home_url('Login_Authorization'));
        }
    } else {
        $_SESSION['login_error_message'] = 1;
        header("Location: " . home_url('Login_Authorization'));
    }

    $stmt->close();
}

//加盟団体取得
function get_group_data( $group_id ){
    $sql = "SELECT * FROM organizations WHERE organization_id = ?";
    global $organizations_access; 
    $stmt = $organizations_access->prepare($sql);
    $stmt->bind_param("i", $group_id ); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row; //post_dataを配列で返す
}

//ユーザー情報取得
function get_user_info( $user_id ){
    $sql = 'SELECT * FROM raquty_users WHERE user_id = ?';
    global $user_access;
    $stmt = $user_access->prepare($sql);
    $stmt->bind_param('s', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    $stmt->close();

    return $row; 
}

//大会表示権利確認
function check_tournament_existance( $tournament_id ){
    $sql = "SELECT * FROM tournament WHERE tournament_id = ?";
    global $cms_access; 
    $stmt = $cms_access->prepare($sql);
    $stmt->bind_param("i", $tournament_id ); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if($row === false){
        return false;
    }else{
        return $row; 
    }
}

//ユーザーのエントリー済種目を取得してリストで返す
function get_user_entry_event($user_id) {
    $sql = "SELECT event_id FROM entry_event WHERE user_id = ?";
    global $user_access;
    $stmt = $user_access->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $event_ids = array(); 

    while ($row = $result->fetch_assoc()) {
        $event_ids[] = $row['event_id']; 
    }

    $stmt->close();

    if (!empty($event_ids)) {
        return $event_ids; 
    } else {
        return null; 
    }
}

//ユーザーIDから選手情報を返す
function get_player_data($id) {
    global $user_access;
    $sql = "SELECT * FROM raquty_users WHERE user_id = ?";
    $stmt = $user_access->prepare($sql);

    if (!$stmt) {
        return null; 
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row; 
    } else {
        return null; 
    }
}

//ログ挿入関数
function add_log($user_id, $log_action , $event_id , $log_before, $log_after) {
    global $log_access;

    $insertQuery = "INSERT INTO user_history (user_id, log_action, event_id, log_before, log_after,IP_Address) VALUES (?, ?, ?, ?, ? , ?)";
    $insertStmt = $log_access->prepare($insertQuery);

    if ($insertStmt) {
        $insertStmt->bind_param("isisss", $user_id, $log_action, $event_id, $log_before, $log_after,$_SERVER["REMOTE_ADDR"] );
        if ($insertStmt->execute()) {
            $insertStmt->close(); 
            return true;
        } else {
            $insertStmt->close(); 
            return false;
        }
    } else {
        return false;
    }
}

//種目の情報取得関数
function get_event_data($event_id) {
    $sql = "SELECT * FROM event_list WHERE event_id = ?";
    global $cms_access; 
    $stmt = $cms_access->prepare($sql);
    $stmt->bind_param("i", $event_id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row; 
    } else {
        return null; 
    }
}

