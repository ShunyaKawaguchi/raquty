document.addEventListener("DOMContentLoaded", function() {
    var scrollTriggers = document.querySelectorAll(".img");
    
    scrollTriggers.forEach(function(trigger) {
        trigger.addEventListener("click", function() {
            var targetId = trigger.getAttribute("data-target");
            var targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: "smooth" });
            }
        });
    });
});
