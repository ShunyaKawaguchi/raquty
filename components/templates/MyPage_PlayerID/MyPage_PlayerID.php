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
      <div class="menu_title">選手ID変更</div>
      <div class="info">
        <form id="UserPlayerID">
            <div class="wrap">
                <label for="now_player_id">現在の選手ID</label><br>
                <input type="text" name="now_player_id" id="now_player_id" value="<?php echo $user_data['player_id']?>" readonly>
            </div>
            <div class="wrap">
                <label for="player_id">新選手ID</label><br>
                <input type="text" name="player_id" id="player_id" required>
                <div class="alert">半角英数字8文字で登録してください。</div>
            </div>
            <div class="submit_wrap">
                <input type="hidden" name="raquty_nonce" value="<?php echo $nonce_id ?>">
                <input type="submit" id="Update" class="next" value="更新">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="/components/templates/MyPage_PlayerID/MyPage_PlayerID.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>