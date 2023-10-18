<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
?>

<div class="frontpage-top">
  <div class="raquty">raquty</div>
  <div class="liner"></div>
  <div class="sub-title">Make tennis management easier</div>
  <img class="gif" src="https://raquty.com/files/material/tennis-court.gif" alt="テニスコートgif">
</div>

<div class="frontpage-middle">
  <div class="frontpage-middle-h2">
    <h2 class="h2-right-in">CONTENTS</h2>
  </div>
  <div class="wrapping">
    <div class="pre_wrap">
      <div class="wrap">
        <div class="about">REGISTER</div>
        <div class="sub_title">選手登録</div>
        <div class="about_value">
          <div class="box_wrap">
            <div class="box" style="border:5px solid #6FFFDC;font-weight:600;">選手登録</div>
            <div class="down">↓</div>
            <div class="box">ログイン</div>
            <div class="down">↓</div>
            <div class="box">マイページ</div>
          </div>
          <div class="txt_wrap">
            <div class="txt"><span>01</span>&nbsp;&nbsp;選手登録ページへ移行します</div>
            <div class="txt"><span>02</span>「マイページ」へ進むには、選手登録が必要です</div>
            <div class="txt"><span>03</span>登録完了後「マイページ」「大会エントリー」などのraquty機能をお使えいただけます</div>
          </div>
          <div class="submit_wrap">
            <button onclick="window.location.href='<?php echo home_url('Register'); ?>'">選手登録へ</button>
          </div>
        </div>
      </div>
      <div class="wrap">
        <div class="about">LOGIN</div>
        <div class="sub_title">選手ログイン</div>
        <div class="about_value">
          <div class="box_wrap">
            <div class="box">選手登録</div>
            <div class="down">↓</div>
            <div class="box" style="border:5px solid #6FFFDC;font-weight:600;">ログイン</div>
            <div class="down">↓</div>
            <div class="box">マイページ</div>
          </div>
          <div class="txt_wrap">
            <div class="txt"><span>01</span>&nbsp;&nbsp;ログイン画面へ移行します</div>
            <div class="txt"><span>02</span>ログインが完了すると「マイページ」へ進めます</div>
            <div class="txt"><span>03</span>「アカウント情報の更新」「ひとこと設定」「アイコン設定」「エントリー済み大会詳細」を確認できます</div>
          </div>
          <div class="submit_wrap">
            <button onclick="window.location.href='<?php echo home_url('Login_Authorization'); ?>'">ログインへ</button>
          </div>
        </div>
      </div>
    </div>
    <div class="pre_wrap">
      <div class="wrap">
        <div class="about">TOURNAMENT</div>
        <div class="sub_title">大会検索</div>
        <div class="about_value">
          <div class="tournament_boxes">
            <div class="box_1">出場したい大会がすぐに見つかる。</div>
            <div class="box_2">大会エントリーまでスムーズに完結。</div>
            <div class="box_3">大会の詳細もエントリー開始の有無も一目でわかる。</div>
          </div>
          <div class="submit_wrap">
            <button onclick="window.location.href='<?php echo home_url('Tournament'); ?>'">TOURNAMENT&nbsp;PICK&nbsp;UP&nbsp;へ</button>
          </div>
        </div>
      </div>
      <div class="wrap">
        <div class="about">GROUP</div>
        <div class="sub_title">団体検索</div>
        <div class="about_value">
          <div class="tournament_boxes">
            <div class="box_4">大会を提供している団体の情報を 知ることができます</div>
            <div class="box_5">検索窓から一斉に検索が可能</div>
            <div class="box_6">地域別に団体の情報を知りたい際は、「地域別検索」をご活用ください</div>
          </div>
          <div class="submit_wrap">
            <button onclick="window.location.href='<?php echo home_url('Organizations'); ?>'">GROUP&nbsp;PICK&nbsp;UP&nbsp;へ</button>
          </div>
        </div>
      </div>
    </div>
    <div class="pre_wrap">
      <div class="wrap">
        <div class="about">ABOUT&nbsp;US</div>
        <div class="sub_title"><span style="font-family: Audiowide;">raquty</span>&nbsp;を知る。</div>
        <div class="about_value">
          <div class="about_raquty_wrap">
            <div class="about_raquty" style="border: none;">
              <div>4つの柱</div>
            </div>
            <div class="about_raquty"><p><span>00</span>楽にクオリティの高いテニス運営を。</p></div>
            <div class="about_raquty"><p><span>01</span>&nbsp;&nbsp;raqutyがテニスを「速く」する。</p></div>
            <div class="about_raquty"><p><span>02</span>テニスに新しい「ミル」カタチ</p></div>
            <div class="about_raquty"><p><span>03</span>テニス界のIT化</p></div>
          </div>
          <div class="submit_wrap">
            <button onclick="window.location.href='<?php echo home_url('About_raquty'); ?>'"><span style="font-family: Audiowide;">raquty</span>を知る。</button>
          </div>
        </div>
      </div>
      <div class="wrap">
        <div class="about">CONTACT</div>
        <div class="sub_title">お問い合わせ</div>
        <div class="about_value">
          <div class="tournament_boxes">
            <div class="box_4" style="background-color:#92B3D1;">
              <div style="font-weight:600;text-align: left;">サイト利用規約</div>
              <div>利用規約等は、フッター部分よりご確認いただけます。</div>
            </div>
            <div class="box_5">
              <div style="font-weight:600;text-align: left;">raqutyに問い合わせる（個人様）</div>
              <div>1～2営業日でご返信させていただきます。</div>
            </div>
            <div class="box_6" style="background-color:#C7E8C1;">
              <div style="font-weight:600;text-align: left;">raqutyに問い合わせる（企業様）</div>
              <div>広告掲載、大会協賛等のご依頼は問い合わせより承ります。</div>
            </div>
          </div>
          <div class="submit_wrap">
            <button onclick="window.location.href='<?php echo home_url('Contact'); ?>'">CONTACT へ</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="frontpage_new_post">
  <h2>raquty NEWS</h2>
    <?php 
    $sql = "SELECT post_id FROM raquty_news WHERE post_status = ? ORDER BY post_date DESC LIMIT 5";
    $stmt = $cms_access->prepare($sql);
    $status = 'publish';
    $stmt->bind_param("s", $status); 
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()):
      $raquty_news = get_raquty_news_data( $row['post_id'] );
      $date = trim_post_date($raquty_news['post_date'],'date'); ?>
      <a href="<?php echo home_url('raquty_News/Article?news_id='.$row['post_id']) ?>" class="post_list">
        <div class="date"><?php echo $date ?></div>
        <div class="title"><?php echo $raquty_news['post_title'] ?></div>
      </a>
    <?php endwhile; ?>

    <div class="clearfix">
      <a href="<?php echo home_url('raquty_News') ?>" class="new_post_button">MORE</a>
    </div>
</div>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>