<?php
    //ヘッダー呼び出し
    require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
    require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
    
?>
<div class="main">
    <div style="display: block;"><a href="<?php echo home_url('OOP'); ?>">&nbsp<< トップへ戻る</a></div>
    
</div>

<?php
    //フッター呼び出し(フッター → /body → /html まで)
    require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>