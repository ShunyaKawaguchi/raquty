<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//セキュリティ
$nonce_id = raquty_nonce();
//ログインしていなかったらリダイレクト
if(!is_login()):?>
  <script> 
      alert('マイページにアクセスするにはログインをしてください。');
      window.location.href = "<?= home_url('Login_Authorization') ?>";
  </script>'; 
<?php 
  exit;
  endif;

  $user_data = get_player_data($_SESSION['user_id']);
  if($user_data === null):?>
    <script> 
        alert('予期せぬエラーが発生しました。ログインからやり直してください。');
        window.location.href = "<?= home_url('Login_Authorization') ?>";
    </script>'; 
  <?php endif;

  if(!empty( $_SESSION['user_PlayerID_msg'] )){ ?>
    <script> 
        alert("<?php echo  $_SESSION['user_PlayerID_msg'];?>");
    </script>'; 
<?php
    unset( $_SESSION['user_PlayerID_msg'] );
    }
?>

<div class="MyPage">
  <div class="title">MyPage</div>
  <div class="liner"></div>
  <div class="main">
    <div class="back"><button style="margin-right:20px;" onclick="window.location.href='<?php echo home_url('MyPage'); ?>'">&lt;&lt;</button>マイページに戻る</div>
    <div class="menu">
      <div class="menu_title">退会</div>
      <div class="txt">
        <p>本ページより<span style="font-family: Audiowide;">raquty</span>から退会することが可能です。<br>
            退会すると以下の情報が削除され、新規で<span style="font-family: Audiowide;">raquty</span>に掲載されている大会・イベントに参加するには、再度選手登録が必要になります。
        </p>
        <div class="box">
            <div class="sub_text">退会すると削除される情報</div>
                <ul>
                    <li><span style="font-family: Audiowide;">raquty</span>が管理するユーザーIDと選手データ（選手ID・氏名・氏名カナ・所属・生年月日・メールアドレス・パスワード）との紐付け</li>
                    <li>選手データ（選手ID・氏名・氏名カナ・所属・生年月日・メールアドレス・パスワード）</li>
                </ul>
                <div class="sub_text">退会しても保持される情報</div>
                <ul>
                    <li>エントリー済みの大会・イベントのエントリー情報（氏名・所属）<br>※退会してもエントリー済みの大会・イベントに参加可能です。</li>
                    <li>出場済み大会の戦績情報（氏名・所属・対戦成績）</li>
                </ul>
            </div>
        </div>
      <div class="info">
        <form id="UserWithdrawal">
            <div class="wrap">
                <div class='inner_wrap_agree'>
                    <input type='checkbox' name='agree' id='agree' required>
                    <label for="agree">上記内容について、承知した上で退会する</label>
                </div>            
            </div>
            <div class="submit_wrap">
                <input type="hidden" name="raquty_nonce" value="<?php echo $nonce_id ?>">
                <input type="submit" id="Withdrawal" class="next" value="退会">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="/components/templates/MyPage_Withdrawal/MyPage_Withdrawal.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>