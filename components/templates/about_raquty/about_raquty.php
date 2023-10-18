<?php
//ヘッダー呼び出し
require_once(dirname(__FILE__).'/../../common/structure/header/header.php') ;
require_once(dirname(__FILE__).'/../../common/structure/menu_bar/menu_bar.php') ;

if(!empty( $_SESSION['about_raquty_messege'] )){ ?>
    <script> 
        alert("<?php echo $_SESSION['about_raquty_messege'];?>");
    </script>'; 
<?php
    unset( $_SESSION['about_raquty_messege'] );
    }
?>

<div class="About_raquty">
    <div class="about_raquty_title"><span style="font-family: Audiowide;">raquty</span>&nbsp;を知る</div>
    <div class="liner"></div>
    <div class="main">
        <div class="top">
            <img class="tennis-gif_smartphone" src="https://raquty.com/files/material/tennis-court.gif" alt="テニスコートgif">
            <div class="wrap">
                <div class="about">0.&nbsp;楽にクォリティの高いテニス運営を。</div>
                <div class="about_value"><span style="font-family: Audiowide;">raquty</span>を使えば、大会を探すところからエントリー、大会当日、結果まですべてをデバイス1台で完結することができます。</div>
            </div>
            <img class="tennis-gif" src="https://raquty.com/files/material/tennis-court.gif" alt="テニスコートgif">
        </div>
        <div class="middle">
            <img src="/files/material/About_raquty/photo1.png">
            <div class="wrap">
                <div class="about">1.&nbsp;<span style="font-family: Audiowide;">raquty</span>がテニスを「速く」する。</div>
                <div class="about_value">テニスの大会に出場したいとき、出場可能な大会をすぐに探すことができます。また、自分の結果や大会情報などをすべて一括で管理するために楽に「速く」情報を知ることができます。</div>
            </div>
        </div>
        <div class="bottom">
            <img src="/files/material/About_raquty/photo3.png" class="photo4">
            <img src="/files/material/About_raquty/photo2.png" class="photo2">
            <div class="pre_wrap">
                <div class="wrap">
                    <div class="about">2.&nbsp;テニスに新しい「ミル」カタチ</div>
                    <div class="about_value"><span style="font-family: Audiowide;">raquty</span>はテニスに新しい「接点」を作ることを目指します。デバイス1台で情報が共有されるからこそ、離れて応援する親御さんや友達も、選手の結果をリアルタイムに知ることができます。場所を気にせず、予定に縛られないことも<span style="font-family: Audiowide;">raquty</span>の強みです。</div>
                </div>
                <div class="inner_wrap">
                    <img src="/files/material/About_raquty/photo2.png" class="photo5">
                    <div class="wrap">
                        <div class="about">3.&nbsp;テニス界のIT化</div>
                        <div class="about_value">一説によると、世界のテニス人口は1億人を超えると言われています。世界がこれだけIT化の波にさらされる中、スポーツ界のIT化も急速に進んでいます.<br><br><span style="font-family: Audiowide;">raquty</span>を使えば、オンライン上で試合進行状況を確認できたり、大会情報、運営からのお知らせなどをリアルタイムで知ることができます。</div>
                    </div>
                </div>
            </div>
            <img src="/files/material/About_raquty/photo3.png" class="photo3">
        </div>
    </div>
</div>

<?php
//フッター呼び出し(フッター → /body → /html まで)
require_once(dirname(__FILE__).'/../../common/structure/footer/footer.php') ;
?>