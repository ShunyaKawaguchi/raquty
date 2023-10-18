document.addEventListener("DOMContentLoaded", function() {
    var nextButton1 = document.getElementById("Next");
    var nextButton2 = document.getElementById("Next1");
    var eventForm = document.getElementById("Event");

    nextButton1.addEventListener("click", function(event) {
        // フォーム内のラジオボタンが選択されているか確認
        var radioButtons = eventForm.querySelectorAll("input[type='radio']");
        var radioButtonSelected = false;

        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                radioButtonSelected = true;
                break;
            }
        }

        // ラジオボタンが選択されていない場合
        if (!radioButtonSelected) {
            alert("種目を選択してください。");
            event.preventDefault(); // フォーム送信を中止
        }
    });

    nextButton2.addEventListener("click", function(event) {
        // フォーム内のラジオボタンが選択されているか確認
        var radioButtons = eventForm.querySelectorAll("input[type='radio']");
        var radioButtonSelected = false;

        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                radioButtonSelected = true;
                break;
            }
        }

        // ラジオボタンが選択されていない場合
        if (!radioButtonSelected) {
            alert("種目を選択してください。");
            event.preventDefault(); // フォーム送信を中止
        }
    });
});
