<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
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
  <?php endif
?>

<div class="MyPage">
  <div class="title">MyPage</div>
  <div class="liner"></div>
  <div class="main">
    <p class="welcome">ようこそ！&nbsp;<?php echo $user_data['user_name'];?>&nbsp;さん！</p>
    <div class="menu">
      <div class="menu_title">マイページメニュー</div>
      <div class="menu_wrap">
        <div class="single_menu" id="entryLink">エントリーした大会を確認する</div>
        <div class="single_menu" id="updateLink">登録情報を変更する</div>
        <div class="single_menu" id="PlayerIDLink">選手IDを変更する</div>
        <div class="single_menu" id="passwordLink">パスワードを変更する</div>
        <div class="single_menu" id="leaveLink">退会する</div>
      </div>
    </div>
  </div>
  <div class="gif_wrap">
    <img class="tennis-gif" src="https://raquty.com/files/material/tennis-court.gif" alt="テニスコートgif">
  </div>
</div>

<script src="/components/templates/MyPage/MyPage.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>