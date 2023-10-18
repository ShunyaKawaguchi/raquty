//スクロール
$(function() {
  var pos = 0;
  var header = $('.header');
  var menuBar = $('.site_top_menu_bar');

  function showHeader() {
    header.removeClass('header_hide');
  }

  function hideHeader() {
    if (menuBar.hasClass('show')) {
      showHeader();
    } else {
      header.addClass('header_hide');
    }
  }

  $(window).on('scroll', function() {
    if ($(this).scrollTop() <= 0) {
      showHeader();
    } else if ($(this).scrollTop() < pos) {
      showHeader();
    } else {
      hideHeader();
    }
    pos = $(this).scrollTop();
  });
});

//ハンバーガーメニュー
$(".openbtn1").click(function () {
  $(this).toggleClass('active');
});