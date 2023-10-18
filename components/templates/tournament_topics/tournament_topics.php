<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//大会情報も呼び出し
$tournament_data = get_tournament_data( $post_data['tournament_id'] );
//団体情報も呼び出し
$group_data = get_group_data($post_data['post_author'] );
?>

<div class="topics">
    <div class="top">
        <?php $date = trim_post_date($post_data['post_date'],'time'); ?>
        <div class="date"><?php echo $date ?></div>
        <div class="title"><strong><?php echo $post_data['post_title'] ?></strong></div>
        <div class="wrap">
            <a href="<?php echo home_url('Tournament/About?tournament_id=').$post_data['tournament_id'] ?>" class="editor"><?php echo $tournament_data['tournament_name'] ?></a>
        </div>
    </div>
    <div class="contents">
        <img src='/files/material/site_icon.png'>
        <div class="main_contents"><?php echo nl2br($post_data['post_content']) ?></div>
    </div>
    <div class="bottom">
        <div class="responsibility">この記事は、<?php echo $group_data['organization_name'] ?>が配信しています。</div>
    </div>
    <div class="page_return">
        <button id="backButton">page_return</button>
    </div>
</div>

<script src="/components/templates/raquty_news/raquty_news.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>