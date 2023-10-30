<?php
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
    <div style="display: block;"><a href="<?php echo home_url('OOP').'?'.http_build_query($_GET); ?>">&nbsp<< 大会当日トップへ戻る</a></div>
    
</div>

<?php
    //フッター呼び出し(フッター → /body → /html まで)
    require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>