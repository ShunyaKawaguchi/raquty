<?php

//raquty_news
function raquty_news_load( $post_id ){
    //大会IDをパラメーターから取得
    if(!empty($_GET['news_id'])){
        $sql = "SELECT * FROM raquty_news WHERE post_id = ?";
        global $cms_access; 
        $stmt = $cms_access->prepare($sql);
        $stmt->bind_param("i", $post_id); 
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
            if ($row) {
                // 投稿が存在する場合
               return true;
            }else{
                // 行が存在しない場合→404
                return false;
            }

    }else{
        header("Location: " . home_url('raquty_News'));   
        exit;
    }
}

//tournament
function tournament_load( $tournament_id ){
    //大会IDをパラメーターから取得
    if(!empty($_GET['tournament_id'])){
        $sql = "SELECT * FROM tournament WHERE tournament_id = ?";
        global $cms_access; 
        $stmt = $cms_access->prepare($sql);
        $stmt->bind_param("i", $tournament_id); 
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
            if ($row) {
                // 投稿が存在する場合
               return true;
            }else{
                // 行が存在しない場合→404
                return false;
            }

    }else{
        header("Location: " . home_url('Tournament'));   
        exit;
    }
}

//tournament_topics
function tournament_topics_load( $topics_id ){
    //トピクスIDをパラメーターから取得
    if(!empty($_GET['topics_id'])){
        $sql = "SELECT * FROM tournament_topics WHERE post_id = ?";
        global $cms_access; 
        $stmt = $cms_access->prepare($sql);
        $stmt->bind_param("i", $topics_id); 
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
            if ($row) {
                // 投稿が存在する場合
               return true;
            }else{
                // 行が存在しない場合→404
                return false;
            }

    }else{
        header("Location: " . home_url('404'));   
        exit;
    }
}

//tournament_topics_index
function tournament_topics_index_load( $tournament_id ){
    //トピクスIDをパラメーターから取得
    if(!empty($_GET['tournament_id'])){
        $sql = "SELECT * FROM tournament WHERE tournament_id = ?";
        global $cms_access; 
        $stmt = $cms_access->prepare($sql);
        $stmt->bind_param("i", $tournament_id); 
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
            if ($row) {
                // 投稿が存在する場合
               return true;
            }else{
                // 行が存在しない場合→404
                return false;
            }

    }else{
        header("Location: " . home_url('404'));   
        exit;
    }
}
?>