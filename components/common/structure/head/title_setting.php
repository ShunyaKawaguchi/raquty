<?php
function title_settings($post_data){
    if(isset($post_data['tournament_name'])):?>
        <title><?php echo $post_data['tournament_name'];?></title>
        <?php elseif($post_data['template']=='tournament_topics_index'):?>
            <title>トピックス一覧:<?php tournament_name($_GET['tournament_id']);?></title>
        <?php elseif($post_data['template']=='tournament_Entry_List'):?>
            <title>エントリーリスト:<?php tournament_name($_GET['tournament_id']);?></title>
        <?php else:?>
        <title><?php echo $post_data['post_title'];?></title>
      <?php endif;
}