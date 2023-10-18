<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
?>

<div class='Register_Cmp'>
    <div class="raquty">raquty</div>
    <div class="liner"></div>
    <div class="h2_wrap">
        <h2>選手登録完了</h2>
    </div>
    <div class="main">
        <div class="wrap">
            <div class="Msg">選手登録が完了しました。</div>
            <div class="Msg_2">これよりマイページへのアクセスが可能です。</div>
            <div class="Msg_3">以下のボタンより、マイページへアクセスしてください。</div>
            <button onclick="location.href='<?php echo home_url('MyPage') ?>'">マイページ</button>
        </div>
    </div>
</div>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>