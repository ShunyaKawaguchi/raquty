<?php
    //コンテンツ呼び出し
    if(!is_login()){ 
        echo "<script>window.location.href = '".home_url('Login_Authorization')."'</script>";
    }else{
        $is_login = true;
    }
    //ヘッダー呼び出し
    require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
    require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
    
?>
<div class="main">
    <!-- 
    ゲストモード・ログインモード共通
    ・トーナメント
    ・オーダーオブプレイ
    （・大会情報）
    （・大会参加者）
    ・大会結果（スコアの詳細）
    ログインモードのみ
    ・マイページ
    -->

    <div class="menu" onclick="selectPage('<?php echo home_url('OOP/Tournament'); ?>');">
        <div class="menu-icon"><img src="https://raquty.com/files/material/OOP/tournament-icon.png" width="75" height="75"></div>
        <div class="name">tournament</div>
    </div>
    <div class="menu" onclick="selectPage('<?php echo home_url('OOP/OOP'); ?>');">
        <div class="name">order of play</div>
    </div>
</div>
<script>
    function selectPage(_url){
        window.location.href = _url;
    }
</script>
<?php
    //フッター呼び出し(フッター → /body → /html まで)
    require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>