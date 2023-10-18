<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//ページネーション関数関連
require_once(dirname(__FILE__).'/paging.php');
$paging = raquty_news_paging(10);
?>

<div class="raquty_news">
    <div class="raquty_NEWS">raquty&nbsp;NEWS</div>
    <div class="liner"></div>
    <div class="h2_wrap">
        <h2>raqutyからのお知らせ</h2> 
    </div>
    <div class="main">
        <?php 
        $sql = "SELECT post_id FROM raquty_news WHERE post_status = ? ORDER BY post_date DESC LIMIT ? OFFSET ?";
        $stmt = $cms_access->prepare($sql);
        $status = 'publish';
        $stmt->bind_param("sii", $status, $paging['max'], $paging['start']);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()):
            $raquty_news = get_raquty_news_data( $row['post_id'] );
            $date = trim_post_date($raquty_news['post_date'],'date');?>
            <div class="article">
                <div class="wrap">
                    <div class="raquty">raquty</div>
                </div>
                <a href="<?php echo home_url('raquty_News/Article?news_id='.$row['post_id']) ?>" class="title"><?php echo $raquty_news['post_title'] ?></a>
                <div class="wrap">
                    <div class="date"><?php echo $date ?></div>
                </div>
            </div>
        <?php endwhile;
              $stmt->close();
              //↑エラーになったらこれが原因かも
        ?>
        <div class="paging">
            <?php generatePagingLinks($paging); ?>
        </div>
    </div>
</div>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>