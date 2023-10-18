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

    // $user_data['user_birthday'] が8桁の数字だと仮定
    $user_birthday = $user_data['user_birthday'];
    // 8桁の数字を日付形式（YYYY-MM-DD）に変換
    $birthdayDate = DateTime::createFromFormat('Ymd', $user_birthday);
    if ($birthdayDate) {
        $formattedBirthday = $birthdayDate->format('Y-m-d');
    } else {
        $formattedBirthday = '';
    }

  if($user_data === null):?>
    <script> 
        alert('予期せぬエラーが発生しました。ログインからやり直してください。');
        window.location.href = "<?= home_url('Login_Authorization') ?>";
    </script>'; 
  <?php endif;

  if(!empty($_SESSION['user_info_msg'])){ ?>
    <script> 
        alert("<?php echo $_SESSION['user_info_msg'];?>");
    </script>'; 
<?php
    unset($_SESSION['user_info_msg']);
    }
?>

<div class="MyPage">
  <div class="title">MyPage</div>
  <div class="liner"></div>
  <div class="main">
    <div class="back"><button style="margin-right:20px;" onclick="window.location.href='<?php echo home_url('MyPage'); ?>'">&lt;&lt;</button>マイページに戻る</div>
    <div class="menu">
      <div class="menu_title">登録情報変更</div>
      <div class="info">
        <form id="UserInfo">
            <div class="wrap">
                <label for="user_name">名前(漢字)</label><br>
                <input type="text" name="user_name" id="user_name" value="<?php echo $user_data['user_name'] ?>" required>
                <div class="alert">苗字と名前の間には半角スペースを空けてください。</div>
            </div>
            <div class="wrap">
                <label for="user_name_kana">名前(カナ)</label><br>
                <input type="text" name="user_name_kana" id="user_name_kana" value="<?php echo $user_data['user_name_kana'] ?>" required>
                <div class="alert">苗字と名前の間には半角スペースを空けてください。</div>
            </div>
            <div class="wrap">
                <label for="user_belonging">所属</label><br>
                <input type="text" name="user_belonging" id="user_belonging" value="<?php echo $user_data['user_belonging'] ?>">
            </div>
            <div class="wrap">
                <?php $user_data['user_birthday'] ?>
                <label for="user_birthday">誕生日</label><br>
                <input type="date" name="user_birthday" id="user_birthday" value="<?php echo $formattedBirthday ?>" required>
            </div>
            <div class="wrap">
                <label for="user_mail">メールアドレス</label><br>
                <input type="mail" name="user_mail" id="user_mail" value="<?php echo $user_data['user_mail'] ?>" required>
                <div class="alert">メールアドレスを変更された場合、変更後のアドレスにその旨を通知します。</div>
            </div>
            <div class="submit_wrap">
                <input type="hidden" name="raquty_nonce" value="<?php echo $nonce_id ?>">
                <input type="hidden" name="mail_before" value="<?php echo $user_data['user_mail'] ?>">
                <?php  $log_before = 'user_name:'.$user_data['user_name'].'/user_name_kana:'.$user_data['user_name_kana'].'/user_belonging:'.$user_data['user_belonging'].'/user_birthday:'.$formattedBirthday.'/user_mail:'.$user_data['user_mail']; ?>
                <input type="hidden" name="log_before" value="<?php echo $log_before ?>">
                <input type="submit" id="Update" class="next" value="更新">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="/components/templates/MyPage_user_info/MyPage_user_info.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>