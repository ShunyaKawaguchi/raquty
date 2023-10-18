document.addEventListener('DOMContentLoaded', function() {
    var elements = document.querySelectorAll('[id="Document_None"]');
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener('click', function() {
            alert("お探しの大会資料はまだ公開されていません。公開までお待ちください。");
        });
    }
});
