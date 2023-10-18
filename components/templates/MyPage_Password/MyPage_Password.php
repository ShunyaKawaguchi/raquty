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

  if(!empty($_SESSION['user_password_msg'])){ ?>
    <script> 
        alert("<?php echo $_SESSION['user_password_msg'];?>");
    </script>'; 
<?php
    unset($_SESSION['user_password_msg']);
    }
?>

<div class="MyPage">
  <div class="title">MyPage</div>
  <div class="liner"></div>
  <div class="main">
    <div class="back"><button style="margin-right:20px;" onclick="window.location.href='<?php echo home_url('MyPage'); ?>'">&lt;&lt;</button>マイページに戻る</div>
    <div class="menu">
      <div class="menu_title">パスワード変更</div>
      <div class="info">
        <form id="UserPassword">
            <div class="wrap">
                <label for="user_password">新パスワード</label><br>
                <input type="password" name="user_password" id="user_password" required>
                <div class="alert">半角英数字8文字以上16文字以下で登録してください。</div>
            </div>
            <div class="wrap">
                <label for="user_password_cfm">新パスワード（確認）</label><br>
                <input type="password" name="user_password_cfm" id="user_password_cfm" required>
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

<script src="/components/templates/MyPage_Password/MyPage_Password.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>