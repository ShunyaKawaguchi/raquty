<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
?>

<div class="Not_Found">
    <div class="raquty">raquty</div>
    <div class="liner"></div>
    <div class="main">
        <div class="title">404</div>
        <div class="sub_title">
            <div class="left">NOT</div>
            <div class="right">FOUND</div>
        </div>
        <div class="sentence">
            <p>It's just a 404 error.<br>Press this button to return to the top page.</p>
        </div>
        <div class="link">
            <a href="<?php echo home_url() ?>">raquty top page</a>
        </div>
    </div>
</div>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>
