<?php
//リクエストURLを編集
$originalUri = $_SERVER['REQUEST_URI'];
//パラメーターを削除
$uriWithoutParams = strtok($originalUri, '?');
//末尾にスラッシュがついていた場合削除
$cleanedUri = preg_replace('/\/$/', '', $uriWithoutParams);
//トップページだけ特例
if($uriWithoutParams=='/'){
    $cleanedUri = '/'; 
}

//リクエストURLに該当するページがあるか検索
$sql = "SELECT post_id ,template, post_status FROM post_info WHERE permalink = ?";
$stmt = $cms_access->prepare($sql);
//リクエストしたURLを検索する
$stmt->bind_param("s", $cleanedUri); 
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if ($row) {
    if($row['post_status']=='publish'){
        if($row['template']=='raquty_news'){
            if(raquty_news_load( $_GET['news_id'] )){
                $post_data = get_raquty_news_data( $_GET['news_id'] );
                $template = 'raquty_news';
            } else {
                $post_data = get_post_data( 2 );
                $template = $post_data['template'];
            }
        }elseif($row['template']=='tournament'){
            if(tournament_load( $_GET['tournament_id'] )){
                $post_data = get_tournament_data( $_GET['tournament_id'] );
                $template = 'tournament';
            }else{
                $post_data = get_post_data( 2 );
                $template = $post_data['template'];
            }
        }elseif( $row['template']=='tournament_topics' ){
            if(tournament_topics_load( $_GET['topics_id'] )){
                $post_data = get_tournament_post_data( $_GET['topics_id'] );
                $template = 'tournament_topics';
            }else{
                $post_data = get_post_data( 2 );
                $template = $post_data['template'];
            }
        }elseif( $row['template']=='tournament_topics_index' ){
            if(tournament_topics_index_load( $_GET['tournament_id'] )){
                $post_data = get_post_data( $row['post_id'] );
                $template = 'tournament_topics_index';
            }else{
                $post_data = get_post_data( 2 );
                $template = $post_data['template'];
            }
        }else{
            //ノーマルな固定ページを表示
            $post_id = $row['post_id'];
            $post_data = get_post_data( $post_id );
            $template = $post_data['template'];
        }

    }else{
        //post_id = 2 は Not Found Page　の投稿番号（公開していない→存在していないページ）
        $post_data = get_post_data( 2 );
        $template = $post_data['template'];
    }
}else{
    //post_id = 2 は Not Found Page　の投稿番号（公開していない→存在していないページ）
    $post_data = get_post_data( 2 );
    $template = $post_data['template'];
}
$stmt->close();
?>