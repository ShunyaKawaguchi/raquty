<div class="header">
  <div class="container_left">
    <div class="icon">
      <img class="raquty_site_logo" src="<?php echo home_url('files/material/raquty_site_logo.png')?>">
    </div>
    <a  href="<?php echo home_url()?>" class="raquty">raquty</a>
    <div class="line"></div>
    <div class="sub_title">Make tennis management easier</div>
  </div>
  <div class="container_right">
    <a href="<?php echo home_url('About_raquty') ?>" class="menu">raqutyを知る</a>
    <?php if(!is_login()):?>
      <a href="<?php echo home_url('Login_Authorization') ?>" class="menu">選手ログイン</a>
      <a href="<?php echo home_url('Register') ?>" class="menu_1">選手登録</a>
    <?php else:?>
      <a href="<?php echo home_url('MyPage') ?>" class="menu_1">マイページ</a>
    <?php endif;?>
    <div style="width:50px;position:relative;"></div>
  </div>
</div>
<div class="openbtn1"><span></span><span></span><span></span></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/components/common/structure/header/header.min.js"></script>