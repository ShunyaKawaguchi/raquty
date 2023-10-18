<div class="site_top_menu_bar">
    <div class="raquty">raquty</div>
        <div class="wrap">
            <div class="site_top_menu">
                <h3>TOP</h3>
                <ul>
                    <li><a href="<?php echo home_url('') ?>">TOP</a></li>
                </ul>
            </div>
            <div class="site_top_menu">
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
            <div class="site_top_menu">
                <h3>SERVICE</h3>
                <ul>
                    <li><a href="<?php echo home_url('Tournament')?>">大会を探す</a></li>
                    <li>選手を探す</li>
                    <li><a href="<?php echo home_url('Organizations')?>">団体を探す</a></li>
                </ul>
            </div>
            <div class="site_top_menu site_top_menu_last_0">
                <h3>INFORMATION</h3>
                <ul>
                    <li><a href="<?php echo home_url('About_raquty') ?>"><span style="font-family: Audiowide;">raquty</span>&nbsp;を知る</a></li>
                    <li><span style="font-family: Audiowide;">raquty</span>&nbsp;大会運営</li>
                    <li><a href="<?php echo home_url('raquty_News') ?>"><span style="font-family: Audiowide;">raquty</span>&nbsp;ニュース</a></li>
                </ul>
            </div>
            <div class="site_top_menu site_top_menu_last">
                <h3>FAQ&nbsp;&&nbsp;TERMS</h3>
                <ul>
                    <li><a href="<?php echo home_url('Terms') ?>">サイト利用規約</a></li>
                    <li><a href="<?php echo home_url('Commercial_law') ?>">特定商取引法に基づく表記</a></li>
                    <li><a href="<?php echo home_url('Privacy_policy') ?>">プライバシーポリシー</a></li>
                    <li><a href="<?php echo home_url('Contact') ?>">お問い合わせ</a></li>
                </ul>
            </div>
        </div>
    <div class="site_top_menu_gif">
        <img class="site_top_menu_tennis-gif" src="https://raquty.com/files/material/tennis-court.gif" alt="テニスコートgif">
    </div>
</div>

<script src="/components/common/structure/menu_bar/menu_bar.min.js"></script>