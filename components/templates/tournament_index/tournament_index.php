<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//必要情報呼び出し
require_once(dirname(__FILE__).'/material.php')
?>

<div class="Tournament_index">
    <div class="Tournament_pick_up">TOURNAMENT&nbsp;PICK&nbsp;UP</div>
    <div class="liner"></div>
    <div class="top">
        <div class="search">
            <div class="title">大会検索</div>
            <form action="" method="get">
                <input type="text" name="s" placeholder="大会名で検索">
                <select name="age">
                    <option value="">年齢</option>
                    <?php for ($age = 1; $age <= 120; $age++): ?>
                        <option value="<?php echo $age ?>"><?php echo $age ?>歳</option>
                    <?php endfor; ?>
                </select>
                <select name="type">
                    <option value="">種目</option>
                    <option value="シングルス">シングルス</option>
                    <option value="ダブルス">ダブルス</option>
                </select>
                <select name="region">
                    <option value="">地域</option>
                    <?php $regions = array('北海道','東北','関東','中部','北陸','関西','四国','中国','九州','沖縄');
                    foreach($regions as $region):?>
                    <option value="<?php echo $region ?>"><?php echo $region ?></option>
                    <?php endforeach;?>
                </select>
                <select name="date">
                    <option value="">年月</option>
                    <?php create_date_option() ?>
                </select>

                <input type="submit" value="検索">
            </form>
            <div class="sub_title">出場したい大会を検索。</div>
        </div>
        <div class="other">
            <div class="organizataions">
                <div class="title">知りたい団体が見つかる</div>
                <a href="<?php echo home_url('Organizations')?>" class="text">団体<br>検索</a>
            </div>
            <div class="player">
                <div class="title">注目選手が分かる</div>
                <a href="" class="text">選手<br>検索</a>
            </div>
        </div>
    </div>
    <?php if (!empty($_GET['s']) || !empty($_GET['age']) || !empty($_GET['type']) || !empty($_GET['region'])|| !empty($_GET['date'])): ?>
        <div class="search_result">
            <div class="h2_wrap">
                <h2>検索結果</h2>
            </div>
            <div class="main">
                <div class="Tournament">
                    <?php $result_tournament_ids = get_result_tournament_search(h($_GET['s']), h($_GET['age']), h($_GET['type']), h($_GET['region']), h($_GET['date'])); 
                    if ($result_tournament_ids !== false) {
                        get_result_tournament($result_tournament_ids);
                    } else {
                        echo '<p style="text-align: center;">お探しの条件の大会は見つかりませんでした。</p>';
                    }    
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="h2_wrap">
        <h2>新着大会</h2>
    </div>
    <div class="main">
        <div class="Tournament">
            <?php get_new_tournament() ?>
        </div>
    </div>
</div>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>