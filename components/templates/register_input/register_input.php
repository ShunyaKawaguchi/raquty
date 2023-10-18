<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//セキュリティ対策のためnonce利用
$nonce_id = raquty_nonce();
//ログイン済みのユーザーはマイページへリダイレクト
if(is_login()){ 
    echo "<script>window.location.href = '".home_url('MyPage')."'</script>";
}
?>

<div class="Register_Form">
    <div class="Register">register</div>
    <div class="liner"></div>
    <div class="h2_wrap">
        <h2>情報入力</h2>
    </div>
    <div class="main">
        <form method="post" id='Register_Info'>
            <p class='reqire_text'>*&nbsp;必須項目</p>
            <?php if(isset($_SESSION['error_message'])):?>
                <p class='error_message'>
                    <?php 
                    if (isset($_SESSION['error_message'])) {
                        foreach ($_SESSION['error_message'] as $message) {
                            echo $message . "<br>";
                        }
                    }
                    ?>
                </p>
                <?php endif;?>
            <div class='wrap'>
                <div class='inner_wrap'>
                    <label for='Last_name_kanji' class='reqire'>姓（漢字）</label>
                    <input type='text' name='Last_name_kanji' id='Last_name_kanji' placeholder='山田' required>
                </div>
                <div class='inner_wrap'>
                    <label for='First_name_kanji' class='reqire'>名（漢字）</label>
                    <input type='text' name='First_name_kanji' id='First_name_kanji'placeholder='太郎' required>
                </div>
            </div>
            <div class='wrap'>
                <div class='inner_wrap'>
                    <label for='Last_name' class='reqire'>姓（カタカナ）</label>
                    <input type='text' name='Last_name' id='Last_name' placeholder='ヤマダ' required>
                </div>
                <div class='inner_wrap'>
                    <label for='First_name' class='reqire'>名（カタカナ）</label>
                    <input type='text' name='First_name' id='First_name'placeholder='タロウ' required>
                </div>
            </div>
            <div class='wrap'>
                <div class='inner_wrap'>
                    <label for='belonging'>所属団体（任意）</label>
                    <input type='text' name='belonging' id='belonging'placeholder='所属団体名を入力してください'>
                </div>
                <div class='inner_wrap'>
                    <label for='player_id' class='reqire'>選手ID（半角英数字8文字）</label>
                    <input type="text" name="player_id" id="player_id" placeholder="選手IDを入力してください" pattern="[A-Za-z0-9]{8}" title="英数字8文字" required>
                </div>
            </div>
            <div class='wrap'>
                <div class='inner_wrap'>
                    <label for='birthday' class='reqire'>生年月日（半角数字8文字）</label>
                    <input type="text" name="birthday" id="birthday" placeholder="2005/01/01" maxlength="10" required>
                </div>
            </div>
            <div class='wrap'>
                <div class='inner_wrap'>
                    <label for='email' class='reqire'>メールアドレス</label>
                    <input type='email' name='email' id='email' value='<?php echo $_SESSION['auth_mail'] ?>' readonly>
                </div>
            </div>
            <div class='wrap'>
                <div class='inner_wrap'>
                    <label for='password' class='reqire'>パスワード（半角英数字8文字〜16文字）</label>
                    <input type='password' name='password' id='password' placeholder='パスワードを入力してください' required>
                </div>
                <div class='inner_wrap'>
                    <label for='password_cfm' class='reqire'>パスワード（確認）</label>
                    <input type='password' name='password_cfm' id='password_cfm' placeholder='パスワードを再入力してください' required>
                </div>
            </div>
            <div class='wrap'>
                <div class='inner_wrap'>
                    <div class='reqire terms'>利用規約</div>
                </div>
            </div>
            <div class='terms_service'><?php include_once(dirname(__FILE__).'/../../common/terms/terms_service.php') ?></div>
            <div class='wrap'>
                <div class='inner_wrap_agree'>
                    <input type='checkbox' name='terms' id='terms' required>
                    <label for="terms">利用規約に同意する</label>
                </div>
            </div>
            <button id='input_check'>確認画面へ</button>
            <input type="hidden" name="raquty_nonce" value="<?php echo $nonce_id ?>">
        </form>
    </div>
</div>

<div class="Form_check" id="confirmationPopup">
    <div class="modal">
        <h3>入力内容確認</h3>
        <p>以下の内容にて選手登録を行います。</p>
        <div class="input">
            <div><strong>名前（漢字）:</strong></div><div><span id='LastName_kanji'></span>&nbsp;<span id='FirstName_kanji'></span></div>
            <div><strong>名前（カタカナ）:</strong></div><div><span id='LastName'></span>&nbsp;<span id='FirstName'></span></div>
            <div><strong>所属団体&nbsp;:</strong></div><div><span id="Belonging"></span></div>
            <div><strong>選手ID&nbsp;:</strong></div><div><span id='Player_id'></span></div>
            <div><strong>生年月日&nbsp;:</strong></div><div><span id='Birthday'></span></div>
            <div><strong>メールアドレス&nbsp;:</strong></div><div><span id='Email'></span></div>
        </div>
        <div class='cfm_button'>
            <div>
                <button id="Not_correct">修正</button>
            </div>
            <div>
                <button id="confirmButton">登録</button>
            </div>
        </div>
    </div>
</div>



<script src="/components/templates/register_input/register_input.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>