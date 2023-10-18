<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;
//必要情報呼び出し
require_once(dirname(__FILE__).'/material.php')
?>

<div class="Group_PickUP">
    <div class="Group_pick_up">GROUP&nbsp;PICK&nbsp;UP</div>
    <div class="liner"></div>
    <div class="top">
        <div class="search">
            <div class="title">団体検索</div>
            <form action="" method="get">
                <input type="text" name="s">
                <input type="submit" value="検索">
            </form>
            <div class="sub_title">知りたい団体を検索。</div>
            <?php if(!empty($_GET['s'])): ?>
                <div class="result">
                    <div class="result_title">『<?php echo h($_GET['s']) ?>』の検索結果</div>
                    <p><?php result_group_search( h($_GET['s']) ) ?></p>
                </div>
            <?php endif;?>
        </div>
        <div class="other">
            <div class="tour">
                <div class="title">出場したい大会が見つかる</div>
                <a href="<?php echo home_url('Tournament')?>" class="text">大会<br>検索</a>
            </div>
            <div class="player">
                <div class="title">注目選手が分かる</div>
                <a href="" class="text">選手<br>検索</a>
            </div>
        </div>
    </div>
    <div class="h2_wrap">
        <h2>地区別検索</h2>
    </div>
    <div class="rigions">
        <div class="single_region_img">
            <?php foreach ($regions as $index => $single_region): ?>
                <?php $class = ($index >= 4) ? '-custom-width' : ''; ?>
                    <div class="value<?php echo $class; ?> img" data-target="<?php echo $single_region['region'] ?>">
                        <img src="<?php echo $single_region['img'] ?>">
                        <p><?php echo $single_region['region'] ?></p>
                    </div>
            <?php endforeach;?>
        </div>
        <div class="single_region">
            <?php foreach ($regions as $single_region):
                $group_data = get_group_by_regions($single_region['region']);
            ?>
                <div class="h3_wrap">
                    <h3 id="<?php echo $single_region['region'] ?>"><?php echo $single_region['region'] ?></h3>
                </div>
                <div class="wrap">
                    <div class="links">
                        <?php foreach ($group_data as $single_group_data):?>
                            <?php if (!empty($single_group_data)): ?>
                                <a href="<?php echo home_url($single_group_data['permalink']) ?>"><?php echo $single_group_data['organization_name'] ?></a>
                            <?php else: ?>
                                <p>この地域には加盟団体がありません。</p>
                            <?php endif; ?>
                        <?php endforeach;?>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
    <div class="bottom">
        <div class="tour">
            <div class="title">出場したい大会が見つかる</div>
            <a href="<?php echo home_url('Tournament')?>" class="text">大会<br>検索</a>
        </div>
        <div class="player">
            <div class="title">注目選手が分かる</div>
            <a href="" class="text">選手<br>検索</a>
        </div>
    </div>
</div>

<script src="/components/templates/organizations/organizations.min.js"></script>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>