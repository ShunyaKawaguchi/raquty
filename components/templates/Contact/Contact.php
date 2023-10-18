<?php 
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//フォームの内容処理
if(!empty($_POST['sender_name'])){
    $sender_name = h($_POST['sender_name']);
}else{
    $sender_name = '';
}
if(!empty($_POST['sender_mail'])){
    $sender_mail = h($_POST['sender_mail']);
}else{
    $sender_mail = '';
}
if(!empty($_POST['sender_message'])){
    $sender_message = h($_POST['sender_message']);
}else{
    $sender_message = '';
}
?>

<div class="Contact">
    <div class="title">raqutyに問い合わせる</div>
    <div class="liner"></div>
    <div class="main">
        <div class="txt">
            <div class="single_txt">●&nbsp;raqutyへのお問い合わせは以下のフォームよりお願いいたします。</div>
            <div class="single_txt">●&nbsp;回答までお時間を頂戴する場合がありますので、あらかじめご了承ください。</div>
            <div class="single_txt">●&nbsp;raqutyに掲載の大会・イベントについてのお問い合わせは、各運営団体までお願いいたします。</div>
        </div>
        <form id="Contact" method="post">
            <?php if(!empty($_GET['sts']) && !empty($_GET['raquty_nonce'])):
                if($_SESSION['nonce_id'] == $_GET['raquty_nonce'] && $_GET['sts']=="Done"):?>
                <div class="wrap">
                    <div class="Complete">
                        <p>お問い合わせありがとうございます。<br>
                            内容を確認した上で、担当者よりメールアドレス宛にご連絡いたします。<br>
                            お問合せ内容によっては、返信までお時間を頂戴する可能性があります。
                        </p>
                    </div>
                </div>
                <?php else:?>
                    <script> 
                        alert('不正な遷移を確認しました。初めからやり直してください。');
                        window.location.href = "<?= home_url('Contact') ?>";
                    </script>'; 
                <?php endif;?>
            <?php elseif(isset($_POST['Confirm'])):?>
                <?php $nonce_id2 = raquty_nonce2() ?>
                <?php if($_SESSION['nonce_id'] !== $_POST['raquty_nonce']):?>
                    <script> 
                        alert('不正な遷移を確認しました。初めからやり直してください。');
                        window.location.href = "<?= home_url('Contact') ?>";
                    </script>'; 
                <?php endif;?>
                <div class="wrap">
                    <div class="sub_title">□&nbsp;■&nbsp;□&nbsp;入力内容確認&nbsp;□&nbsp;■&nbsp;□</div>
                </div>
                <div class="wrap">
                    <div class="about">お名前</div>
                    <div class="about_value"><?php echo $sender_name ?></div>
                </div>
                <div class="wrap">
                    <div class="about">メールアドレス</div>
                    <div class="about_value"><?php echo $sender_mail ?></div>
                </div>
                <div class="wrap">
                    <div class="about">お問合せ内容</div>
                    <div class="about_value"><?php echo $sender_message ?></div>
                </div>
                <div class="submit_wrap">
                <input type="hidden" name="sender_name" value="<?php echo $sender_name ?>">
                <input type="hidden" name="sender_mail" value="<?php echo $sender_mail ?>">
                <input type="hidden" name="sender_message" value="<?php echo $sender_message ?>">
                <input type="hidden" name="raquty_nonce" value="<?php echo h($_POST['raquty_nonce']) ?>">
                <input type="hidden" name="raquty_nonce2" value="<?php echo $nonce_id2 ?>">
                <input type="submit" class="back" value="訂正する">
                <input type="submit" id="Submit" class="next" value="送信">
                </div>
            <?php else:?>
                <?php $nonce_id = raquty_nonce() ?>
                <div class="wrap">
                    <label for="sender_name">お名前</label>
                    <input type="text" name="sender_name" id="sender_name" value="<?php echo $sender_name ?>" required>
                </div>
                <div class="wrap">
                    <label for="sender_mail">メールアドレス</label>
                    <input type="mail" name="sender_mail" id="sender_mail" value="<?php echo $sender_mail ?>" required>
                </div>
                <div class="wrap">
                    <label for="sender_message">お問い合わせ内容</label>
                    <textarea name="sender_message" id="sender_message" required><?php echo $sender_message ?></textarea>
                </div>
                <div class="submit_wrap">
                    <input type="hidden" name="raquty_nonce" value="<?php echo $nonce_id ?>">
                    <input type="submit" name="Confirm" class="next" value="内容確認">
                </div>
            <?php endif;?>
        </form>
    </div>
</div>

<script src="/components/templates/Contact/Contact.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>