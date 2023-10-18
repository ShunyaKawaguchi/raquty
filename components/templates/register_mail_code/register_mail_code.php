<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//ログイン済みのユーザーはマイページへリダイレクト
if(is_login()){ 
    echo "<script>window.location.href = '".home_url('MyPage')."'</script>";
}
if(empty($_SESSION['auth_code'])){
    header("Location: " . home_url('Register'));   
    exit;
}
if (isset($_POST['try'])) {
    $try_num = '';    
    for ($i = 1; $i <= 6; $i++) {
        if (isset($_POST['num' . $i])) {
            $digit = $_POST['num' . $i];
            if (is_numeric($digit) && strlen($digit) === 1) {
                $try_num .= $digit;
                $ture_num = $_SESSION['auth_code'];
                if($ture_num == $try_num){
                    $flag = 1;
                    
                    
                }else{
                    $false_num = $_POST['false_num'] + 1;
                }
            } else {
                $try_num = 'error';
                $false_num = $_POST['false_num'] + 1;
            }
        }
    }
}else{
    if(isset($_POST['false_num'])){
        $false_num = $_POST['false_num'];
    }else{
        $false_num = 0;
    }
}

if(!isset($_POST['false_num'])){
    $false_num = 0;
    $message = '6桁の認証コードを入力してください。';
}else{
    $try_credit = 5 - $false_num;
    
    if ($false_num  == 0) {
        $message = '6桁の認証コードを入力してください。';
    } elseif ($false_num  < 5) {
        $message = '認証に失敗しました。<br>あと' . $try_credit . '回認証に失敗すると認証コードがリセットされます。';
    } else {
        $message = '認証に失敗しました。<br>最初からやり直してください。';
        $_SESSION['auth_code'] = '';
        $_SESSION['auth_mail'] = '';
        echo '<script>
        setTimeout(function() {
          window.location.href = \'/Register\';
        }, 2000); 
        </script>';
    }
}
if(isset($flag)){
    $message = '認証に成功しました。<br>情報入力ページにリダイレクトします。';
    $_SESSION['auth_code'] = '';
    $_SESSION['correct_auth_num'] = 1;
    echo '<script>
    setTimeout(function() {
      window.location.href = \'/Register_Form\';
    }, 2000); 
    </script>';
}

if(!empty($_SESSION['resend_flag'])){
    $message = '認証コードを再送信しました。<br>6桁の認証コードを入力してください。';
    $_SESSION['resend_flag'] = "";
}
?>


<div class="Activation_user">
    <div class="Register">register</div>
    <div class="liner"></div>
    <div class="h2_wrap">
        <h2>メールアドレス認証</h2>
    </div>
    <div class="main">
        <p>
            メールアドレス：<span><?php echo $_SESSION['auth_mail'] ?></span><br>
            入力いただいたメールアドレスに認証コードをお送りいたしました。
        </p>
        <p class="message"><?php echo $message ?></p>
        <form method="post" action="">
            <div class="container">
                <input type="text" name="num1" maxlength="1" oninput="validateInput(this)">
                <input type="text" name="num2" maxlength="1" oninput="validateInput(this)">
                <input type="text" name="num3" maxlength="1" oninput="validateInput(this)">
                <input type="text" name="num4" maxlength="1" oninput="validateInput(this)">
                <input type="text" name="num5" maxlength="1" oninput="validateInput(this)">
                <input type="text" name="num6" maxlength="1" oninput="validateInput(this)">
                <input type="hidden" name="false_num" value="<?php echo $false_num ?>">
                <input type="submit" name="try" value="認証">
            </div>
        </form>
        <p class="UnCatch">認証メールを受け取れない方は<span id="here">こちら</span></p>
    </div>
</div>

<div class="Re_send" id="Re_send">
    <p>認証メールが届かない場合、迷惑メールに分類されている可能性があります。<br>また、以下のメールアドレスからの受信を許可してください。</p>
    <p class="mail">register@raquty.com</p>
    <p>認証メールを再送信する場合は「再送信」ボタンを押してください。</p>
    <form method="post" id="resendForm">
    <button id="Re_send_code" type="submit">再送信</button>
    </form>
</div>

<script src="/components/templates/register_mail_code/register_mail_code.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>
