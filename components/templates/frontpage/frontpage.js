//.frontpage_slidebarのアニメーション設定
document.addEventListener("DOMContentLoaded", function() {
    const slidebar = document.querySelector(".frontpage_slidebar");
    slidebar.style.opacity = 0;
    slidebar.style.display = "flex";
  
    const fadeInAnimation = slidebar.animate(
      [{ opacity: 0 }, { opacity: 1 }],
      {
        duration: 2000,
        fill: "forwards", // アニメーション終了時にスタイルを維持
      }
    );
  });

//スライドショー設定
  let currentIndex = 0;
  let intervalId;
  let frontpageSliderContents;
  
  function updateSliderContents() {
    const sliderContentsData = document.querySelector(".frontpage_slidebar").getAttribute("data-slider-contents");
    frontpageSliderContents = JSON.parse(sliderContentsData); 
    const numContents = frontpageSliderContents.length;
    
    if (currentIndex < 0) {
      currentIndex = numContents - 1;
    } else if (currentIndex >= numContents) {
      currentIndex = 0;
    }
    
    document.querySelector("#frontpage_slider_contents1").innerHTML = frontpageSliderContents[(currentIndex - 1 + numContents) % numContents];
    document.querySelector("#frontpage_slider_contents2").innerHTML = frontpageSliderContents[currentIndex];
    document.querySelector("#frontpage_slider_contents3").innerHTML = frontpageSliderContents[(currentIndex + 1) % numContents];
    document.querySelector("#frontpage_slider_contents4").innerHTML = frontpageSliderContents[(currentIndex + 2) % numContents];
    document.querySelector("#frontpage_slider_contents5").innerHTML = frontpageSliderContents[(currentIndex + 3) % numContents];
  }
  
  function startAutoSlide() {
    intervalId = setInterval(function() {
      currentIndex = (currentIndex + 1) % frontpageSliderContents.length;
      updateSliderContents();
    }, 3000);
  }
  
  function stopAutoSlide() {
    clearInterval(intervalId);
  }
  
  document.querySelector("#contents_back").addEventListener("click", function () {
    currentIndex = (currentIndex - 1 + frontpageSliderContents.length) % frontpageSliderContents.length;
    updateSliderContents();
    stopAutoSlide();
  });
  
  document.querySelector("#contents_foward").addEventListener("click", function () {
    currentIndex = (currentIndex + 1) % frontpageSliderContents.length;
    updateSliderContents();
    stopAutoSlide();
  });
  
  startAutoSlide();
  updateSliderContents();
  
//スライドショーの影設定
updateSliderContents();
function updateShadowStrength() {
  const sliderContents = document.querySelectorAll(".slider_contents");
  const numContents = sliderContents.length;
  const middleIndex = Math.floor(numContents / 2);
  const maxShadowStrength = 0.5; 
  sliderContents.forEach((content, index) => {
    const distanceFromMiddle = Math.abs(index - middleIndex);
    const shadowStrength = maxShadowStrength - (distanceFromMiddle / middleIndex) * maxShadowStrength;
    content.style.boxShadow = `0 0 10px rgba(0, 0, 0, ${shadowStrength})`;
  });
}
window.addEventListener("load", function () {
  updateShadowStrength(); 
});