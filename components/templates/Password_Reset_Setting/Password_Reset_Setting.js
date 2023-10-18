document.addEventListener("DOMContentLoaded", function() {
    function setFormAction() {
        var password = document.getElementById("user_password").value;
        var confirmPassword = document.getElementById("user_password_cfm").value;

        // パスワードが条件を満たさない場合
        if (!/^(?=.*[0-9])(?=.*[a-zA-Z])[0-9a-zA-Z]{8,16}$/.test(password)) {
            alert("パスワードは半角英数8文字から16文字で登録してください。");
            return false; // フォームの送信を中止
        }

        // パスワードが一致しない場合
        if (password !== confirmPassword) {
            alert("パスワードが一致しません");
            return false; // フォームの送信を中止
        }

        document.getElementById("PasswordForm").action = "/components/templates/Password_Reset_Setting/update_data.php";
        return true; // フォームを送信
    }

    // フォームの送信イベントにリスナーを追加
    var form = document.getElementById("PasswordForm");
    form.addEventListener("submit", function(event) {
        // フォーム送信前にパスワードを検証する処理を記述
        if (!setFormAction()) {
            event.preventDefault(); // フォームの送信を中止
        }
    });
});
