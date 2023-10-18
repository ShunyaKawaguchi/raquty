document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('UserPassword').addEventListener('submit', function(event) {
        var passwordField = document.getElementById('user_password');
        var passwordCfmField = document.getElementById('user_password_cfm');
        
        var password = passwordField.value;
        var passwordCfm = passwordCfmField.value;

        if (password !== passwordCfm) {
            alert('新しいパスワードと確認用パスワードが一致しません。');
            event.preventDefault(); // フォーム送信を中止
        } else if (!validatePasswordFormat(password)) {
            alert('パスワードは半角英数字8文字以上16文字以下で登録してください。');
            event.preventDefault(); // ファーム送信を中止
        } else {
            // フォームが正常であれば、methodとactionを追加してフォームを送信
            var form = document.getElementById('UserPassword');
            form.method = 'post';
            form.action = '/components/templates/MyPage_Password/update_data.php';
        }
    });
    
    function validatePasswordFormat(password) {
        // パスワードの形式を検証
        var passwordPattern = /^(?=.*\d)(?=.*[a-zA-Z]).{8,16}$/;
        return passwordPattern.test(password);
    }
});
