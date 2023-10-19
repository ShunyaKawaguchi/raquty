<?php
function title_settings($post_data) {
    if (isset($post_data['tournament_name'])) {
        $title = $post_data['tournament_name'];
    } elseif (isset($post_data['template']) && $post_data['template'] == 'tournament_topics_index') {
        $title = 'トピックス一覧:' . tournament_name($_GET['tournament_id']);
    } elseif (isset($post_data['template']) && $post_data['template'] == 'tournament_Entry_List') {
        $title = 'エントリーリスト:' . tournament_name($_GET['tournament_id']);
    } else {
        $title = $post_data['post_title'];
    }
    echo "<title>{$title}</title>";
}

