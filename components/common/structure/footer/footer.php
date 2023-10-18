<div class="footer">
  <div class="raquty">raquty</div>
  <div class="footer_menu">
    <div class="wrap">
        <h3>TOP</h3>
        <ul>
            <li><a href="<?php echo home_url('')?>">TOP</a></li>
        </ul>
    </div>
    <div class="wrap">
        <h3>MY PAGE</h3>
        <ul>
            <?php if(!is_login()):?>
                <li><a href="<?php echo home_url('Login_Authorization') ?>">ログイン</a></li>
                <li><a href="<?php echo home_url('Register') ?>">選手登録</a></li>
            <?php else:?>
                <li><a href="<?php echo home_url('MyPage') ?>">マイページ</a></li>
                <li><a data-logout-action="raquty_user_logout" href="#">ログアウト</a></li>
            <?php endif;?>
        </ul>
    </div>
    <div class="wrap">
        <h3>SERVICE</h3>
        <ul>
            <li><a href="<?php echo home_url('Tournament')?>">大会を探す</a></li>
            <li>選手を探す</li>
            <li><a href="<?php echo home_url('Organizations')?>">団体を探す</a></li>
        </ul>
    </div>
    <div class="wrap">
        <h3>INFORMATION</h3>
        <ul>
            <li><a href="<?php echo home_url('About_raquty') ?>"><span style="font-family: Audiowide;">raquty</span>&nbsp;を知る</a></li>
            <li><span style="font-family: Audiowide;">raquty</span>&nbsp;大会運営</li>
            <li><a href="<?php echo home_url('raquty_News') ?>"><span style="font-family: Audiowide;">raquty</span>&nbsp;ニュース</a></li>
        </ul>
    </div>
    <div class="wrap_last">
        <h3>FAQ&nbsp;&&nbsp;TERMS</h3>
        <ul>
            <li><a href="<?php echo home_url('Terms') ?>">サイト利用規約</a></li>
            <li><a href="<?php echo home_url('Commercial_law') ?>">特定商取引法に基づく表記</a></li>
            <li><a href="<?php echo home_url('Privacy_policy') ?>">プライバシーポリシー</a></li>
            <li><a href="<?php echo home_url('Contact') ?>">お問い合わせ</a></li>
        </ul>
    </div>
  </div>
</div>

<div class="raqury_copyright">Copyright&nbsp;raquty&nbsp;2023&nbsp;-&nbsp;<?php $year = date('Y');echo $year;?></div>

<a href="#" id="page-top" class="top-button">
    <span>&#8593;</span> 
</a>

<script src="/components/common/structure/footer/footer.min.js"></script>

</body>
</html>