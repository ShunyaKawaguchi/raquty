<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//ページネーション関数関連
require_once(dirname(__FILE__).'/paging.php');
$paging = tournament_topics_paging(10);
//大会情報呼び出し
$tournament_data = get_tournament_data( $_GET['tournament_id'] );
?>

<div class="tournament_topics">
    <div class="h2_wrap">
        <h2>大会運営からのお知らせ</h2> 
    </div>
    <div class="main">
        <p><span>大会名：</span><a href="<?php echo home_url('/Tournament/About?tournament_id=').$_GET['tournament_id'] ?>"><?php echo $tournament_data['tournament_name'] ?></a></p>
        <?php 
        $sql = "SELECT post_id FROM tournament_topics WHERE post_status = ? AND tournament_id = ? ORDER BY post_date DESC LIMIT ? OFFSET ?";
        $stmt = $cms_access->prepare($sql);
        $status = 'publish';
        $stmt->bind_param("siii", $status, $_GET['tournament_id'], $paging['max'], $paging['start']);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            echo '<p style="border:none;font-size:14px;padding:10px;">大会運営団体によるトピックス登録がありません。</p>';
        } else {
            while ($row = $result->fetch_assoc()) {
                $tournament_topics = get_tournament_post_data($row['post_id']);
                $date = trim_post_date($tournament_topics['post_date'], 'date'); ?>
                <div class="article">
                    <a href="<?php echo home_url('Tournament/Topics/Article?topics_id=' . $row['post_id']) ?>"
                       class="title"><?php echo $tournament_topics['post_title'] ?></a>
                    <div class="wrap">
                        <div class="date"><?php echo $date ?></div>
                    </div>
                </div>
            <?php }
        }
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