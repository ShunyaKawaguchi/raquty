function togglePageTopButton() {
    var button = document.getElementById("page-top");
    if (window.scrollY > 300) {
      button.classList.add("show");
    } else {
      button.classList.remove("show"); 
    }
  }
  function scrollToTop() {
    var currentPosition = window.scrollY;
    var targetPosition = 0;
    var distance = targetPosition - currentPosition;
    var duration = 500;
    var startTime = null;
    function step(timestamp) {
      if (!startTime) startTime = timestamp;
      var progress = timestamp - startTime;
      var percentage = Math.min(progress / duration, 1);
      window.scrollTo(0, currentPosition + distance * percentage);
      if (progress < duration) {
        window.requestAnimationFrame(step);
      }
    }
    window.requestAnimationFrame(step);
  }
  document.getElementById("page-top").addEventListener("click", scrollToTop);
  window.addEventListener("scroll", togglePageTopButton);