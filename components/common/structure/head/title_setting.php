<?php
function title_settings($post_data) {
    if (isset($post_data['tournament_name'])) {
        $title = $post_data['tournament_name'];
    } elseif (isset($post_data['template']) && $post_data['template'] == 'tournament_topics_index') {
        $title = 'トピックス一覧:' . tournament_name($_GET['tournament_id']);
    } elseif (isset($post_data['template']) && $post_data['template'] == 'tournament_Entry_List') {
        $title = 'エントリーリスト:' . tournament_name($_GET['tournament_id']);
    } elseif (isset($post_data['template']) && $post_data['template'] == 'tournament_draw') {
        $title = 'ドロー:' . tournament_name($_GET['tournament_id']);
    }elseif (isset($post_data['template']) && $post_data['template'] == 'tournament_draw_view') {
        $tournament_data = check_tournament_existance($_GET['tournament_id']);
        $child_event_data = get_single_draw($tournament_data['tournament_id'] , $_GET['child_event_id']);
        $title = 'ドロー:' . tournament_name($_GET['tournament_id']).'/'.$child_event_data['child_event_name'];
    } else {
        $title = $post_data['post_title'];
    }
    echo "<title>{$title}</title>";
}

