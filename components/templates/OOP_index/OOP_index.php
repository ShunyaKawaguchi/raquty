
<?php
    //コンテンツ呼び出し
    // if(!is_login()){ 
    //     $is_login = false;
    //     // echo "<script>window.location.href = '".home_url('Login_Authorization')."'</script>";
    // }else{
    //     $is_login = true;
    // }
    // データベースに$_GET['tournament_id']_game_indexが存在するか確認
    //ヘッダー呼び出し
    require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
    require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
    
?>

<script>
    // JavaScript code to dynamically create and insert a link element

    // Create a new link element
    var newLink = document.createElement('script');
    newLink.src = 'components/templates/OOP_index/jquery-3.7.1.min.js';
    // Insert the new link element into the head of the document
    document.head.appendChild(newLink);
</script>
<script>
    function selectPage(_url){
        window.location.href = _url;
    }
</script>
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
    <div class="title"><div class="about_raquty_title"><span style="font-family: Audiowide;">raquty</span>&nbsp;大会当日</div></div>
    <div class="liner"></div>
    <img class="tennis-gif" src="https://raquty.com/files/material/tennis-court.gif" alt="テニスコートgif">
    
    <div class="tournament-wrap" style="display: block;padding-top:0%;margin-top:0%;"><div class="tournament-name"><?php echo getTournamentInformation($_GET['tournament_id']); ?></div></div>
    <!-- <div class="venue-name"></div> -->
    <div class="menu-wrap">
        <div class="menu" onclick="selectPage('<?php echo home_url('OOP/OOP').'?'.http_build_query($_GET); ?>');">
            <div class="menu-icon"><img src="https://raquty.com/files/material/OOP/order-of-play-icon.png" width="75" height="75"></div>    
            <div class="name">order of play</div>
        </div>
        <div class="menu" onclick="selectPage('<?php echo home_url('OOP/Tournament').'?'.http_build_query($_GET); ?>');">
            <div class="menu-icon"><img src="https://raquty.com/files/material/OOP/tournament-icon.png" width="75" height="75"></div>
            <div class="name">tournament</div>
        </div>
        <div class="menu">
            <div class="menu-icon"><img src="https://raquty.com/files/material/OOP/court-icon.png" width="75" height="75"></div>
            <div class="name">court situation</div>
        </div>
    </div>
</div>

<?php
    //フッター呼び出し(フッター → /body → /html まで)
    require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>