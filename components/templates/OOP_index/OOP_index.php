<?php
    //コンテンツ呼び出し
    // if(!is_login()){ 
    //     $is_login = false;
    //     // echo "<script>window.location.href = '".home_url('Login_Authorization')."'</script>";
    // }else{
    //     $is_login = true;
    // }
    // データベースに$_GET['tournament_id']_game_indexが存在するか確認
    if(isset($_GET['tournament_id'])){
        $tournament_id = $_GET['tournament_id'];
        $table_name = $tournament_id."_game_index";
        $query = "SHOW TABLES LIKE '$table_name'";
        global $tournament_access;
        $stmt = $tournament_access -> prepare($query);
        if($stmt ===  false){
            die("プリペアードステートメントの準備に失敗しました。");
        }
        if($stmt->execute() === false){
            die("クエリの実行に失敗しました。");
        }
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $is_start_tournament = true;
            $count = $result->num_rows;
        }else{
            $is_start_tournament = false;
        }
    }else{
        //もし$_GET['tournament_id']が存在しない場合は、不正アクセスとして不正アクセスページにリダイレクト
        echo '<script>window.location.href = "'.home_url('OOP/Incorrect_access').'";</script>';
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
    <div class="title"><div class="about_raquty_title"><span style="font-family: Audiowide;">raquty</span>&nbsp;大会当日</div></div>
    <div class="liner"></div>
    <?php 
        if($is_start_tournament){
            echo '<div>'.$count.'</div>';
        }else{
            echo '<div style="margin-left:5vw;margin-right:5vw;"><strong style="color:red;">注）まだ大会の開催期間ではありません。<br>大会の運営が開催されたタイミングで閲覧できるようになります。</strong></div>';
        }
    ?>
    <div class="menu" onclick="selectPage('<?php echo home_url('OOP/Tournament').'?'.http_build_query($_GET); ?>');">
        <div class="menu-icon"><img src="https://raquty.com/files/material/OOP/tournament-icon.png" width="75" height="75"></div>
        <div class="name">tournament</div>
    </div>
    <div class="menu" onclick="selectPage('<?php echo home_url('OOP/OOP').'?'.http_build_query($_GET); ?>');">
    <div class="menu-icon"><img src="https://raquty.com/files/material/OOP/order-of-play-icon.png" width="75" height="75"></div>    
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