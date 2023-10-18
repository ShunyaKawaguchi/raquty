<?php
// エラーメッセージを格納する配列を初期化
$error_messages = array();
//セッションの内容を初期化
unset($_SESSION['error_message']);

//名前関連
if(empty($user_inputs['lastNameKanji'])){
    $error_messages[] = '・姓（漢字）を入力してください。';
}
if(empty($user_inputs['firstNameKanji'])){
    $error_messages[] = '・名（漢字）を入力してください。';
}
if(empty($user_inputs['lastName'])){
    $error_messages[] = '・姓（カタカナ）を入力してください。';
}
if(empty($user_inputs['firstName'])){
    $error_messages[] = '・名（カタカナ）を入力してください。';
}


// メールアドレス重複チェック
$query = "SELECT * FROM raquty_users WHERE user_mail = ?";
$stmt = $user_access->prepare($query);
$stmt->bind_param("s", $user_inputs['email']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $error_messages[] = '・既に登録済みのメールアドレスです。重複して登録することはできません。';
}

$stmt->close();

// 選手IDが半角英数8文字で入力されているかチェック
if (!preg_match('/^[a-zA-Z0-9]{8}$/', $user_inputs['playerId'])) {
    $error_messages[] = '・選手IDは半角英数8文字で登録してください。';
}

// 選手ID重複チェック
$query = "SELECT * FROM raquty_users WHERE player_id = ?";
$stmt = $user_access->prepare($query);
$stmt->bind_param("s", $user_inputs['playerId']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $error_messages[] = '・既に使用されている選手IDです。別のIDで登録してください。';
}

$stmt->close();

//生年月日チェック
$birthday = $user_inputs['birthday'];
$birthday = str_replace('/', '', $birthday);
$birthday = substr($birthday, 0, 8);
if (strlen($birthday) !== 8 || !ctype_digit($birthday)) {
    $error_messages[] = '・生年月日は半角数字8文字で登録してください。';
}


// パスワード形式チェック
if (!preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])[0-9a-zA-Z]{8,16}$/', $user_inputs['password'])) {
    $error_messages[] = '・パスワードは半角英数8文字から16文字で登録してください。';
}

// パスワード入力一致チェック
if ($user_inputs['password'] !== $user_inputs['password_cfm']) {
    $error_messages[] = '・パスワードと入力用パスワードの値が一致しません。';
}

//利用規約同意
if(!$user_inputs['terms']){
    $error_messages[] = '・利用規約への同意は必須です。';
}

// 配列内にエラーメッセージがある場合は、それらを出力する
if (!empty($error_messages)) {
    $_SESSION['error_message'] = $error_messages;
    header("Location: " . home_url('Register_Form'));  
}else{
    //データベースに情報を挿入
    require_once(dirname(__FILE__).'/insert_data.php');
    //登録完了メール送信
    require_once(dirname(__FILE__).'/mail_send.php');
}
?>
