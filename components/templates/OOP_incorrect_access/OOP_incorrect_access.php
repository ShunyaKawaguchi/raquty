<?php
    //ヘッダー呼び出し
    require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
    require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
    
?>
<div class="main">
    <div class="content">不正な遷移です。大会が選択されていません。</div>
    <div class="link"><a href="<?php echo home_url('/'); ?>"><< raqutyトップページへ戻る</a></div>
    
</div>

<?php
    //フッター呼び出し(フッター → /body → /html まで)
    require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>