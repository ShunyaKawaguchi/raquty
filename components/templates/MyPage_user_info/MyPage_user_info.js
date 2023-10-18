
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('Update').addEventListener('click', function(event) {
        var userNameField = document.getElementById('user_name');
        var userKanaField = document.getElementById('user_name_kana');
        var userMailField = document.getElementById('user_mail');
        
        // 名前（漢字）と名前（カナ）のバリデーション
        if (!validateName(userNameField.value) || !validateName(userKanaField.value)) {
          alert('名前（漢字）と名前（カナ）は半角スペースを含む必要があります。');
          event.preventDefault();
        } else if (!validateEmail(userMailField.value)) {
          alert('メールアドレスが正しくありません。');
          event.preventDefault();
        } else {
          // すべてのチェックに通過した場合、フォームを送信
          var insertForm = document.getElementById('UserInfo');
          insertForm.method = 'post'; 
          insertForm.action = '/components/templates/MyPage_user_info/update_data.php';
          insertForm.submit();
        }
      });
      
      function validateName(name) {
        // 名前のバリデーション
        // 半角スペースが1回必ず含まれているかを確認
        return name.trim().split(' ').length === 2;
      }
      
      function validateEmail(email) {
        // メールアドレスのバリデーション
        // 一般的なメールアドレスの形式かどうかを確認
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailPattern.test(email);
      }
    });