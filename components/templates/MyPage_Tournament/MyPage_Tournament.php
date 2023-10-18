<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//必要機能呼び出し
require_once(dirname(__FILE__).'/material.php') ;
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
?>

<div class="MyPage">
  <div class="title">MyPage</div>
  <div class="liner"></div>
  <div class="main">
    <div class="back"><button style="margin-right:20px;" onclick="window.location.href='<?php echo home_url('MyPage'); ?>'">&lt;&lt;</button>マイページに戻る</div>
    <div class="menu">
      <div class="menu_title">エントリー済み大会一覧</div>
      <div class="txt">※エントリーした日時が早い順に表示</div>
      <div class="info">
        <?php create_entered_Tournament_List(); ?>
      </div>
    </div>
  </div>
</div>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>