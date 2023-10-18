<?php 
//タイトル表示関数呼び出し
require_once(dirname(__FILE__).'/title_setting.php');

//ログイン後リダイレクトURL設定
if($template !== 'login'){
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
  $host = $_SERVER['HTTP_HOST'];
  $uri = $_SERVER['REQUEST_URI'];
  $full_url = $protocol . "://" . $host . $uri;
  $_SESSION['request_url'] = $full_url;
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <?php title_settings($post_data); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"content="raquty-Make tennis management easier- 0. 楽にクオリティの高いテニス運営を。raqutyを使えば、大会を探すところからエントリー、大会当日、結果まですべてをデバイス1台で完結することができます。1.raqutyがテニスを「速く」する。テニスの大会に出場したいとき、出場可能な大会をすぐに探すことができます。また、自分の結果や大会情報などをすべて一括で管理するために楽に「速く」情報を知ることができます。2.テニスに新しい「ミル」カタチraqutyはテニスに新しい「接点」を作ることを目指します。デバイス1台で情報が共有されるからこそ、離れて応援する親御さんや友達も、選手の結果をリアルタイムに知ることができます。場所を気にせず、予定に縛られないこともraqutyの強みです。3.テニス界のIT化 一説によると、世界のテニス人口は1億人を超えると言われています。世界がこれだけIT化の波にさらされる中、スポーツ界のIT化も急速に進んでいます。 raqutyを使えば、オンライン上で試合進行状況を確認できたり、大会情報、運営からのお知らせなどをリアルタイムで知ることができます。"> 
    <link rel="canonical" href="<?php echo $full_url ?>">
    <link rel="icon" href="/files/material/raquty_fabicon.ico" id="favicon">
    <link rel="stylesheet" href="/components/common/global-css.min.css" media="screen,print">
    <link rel="stylesheet" href="/components/common/structure/header/header_logo.min.css" media="screen,print">
    <link rel="stylesheet" href="/components/templates/<?php echo  $template.'/' .$template.'.min.css' ;?>" media="screen,print">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" media="screen,print">
    <?php require_once(dirname(__FILE__).'/../structure-css_loder.php') ; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
    <script src="/components/common/global-js.min.js"></script>
    <!-- Google tag (gtag.js) -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-2XFVBHPYBT"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-2XFVBHPYBT');
    </script> -->
    <!-- Google tag (gtag.js) 終了 -->
  </head>
<body>
