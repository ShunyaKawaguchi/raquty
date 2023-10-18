<?php 
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
?>

<div class="Terms">
<div class="title">利用規約</div>
    <div class="liner"></div>
    <div class="main">
        <div class='terms_service'><?php include_once(dirname(__FILE__).'/../../common/terms/terms_service.php') ?></div>
    </div>
</div>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>