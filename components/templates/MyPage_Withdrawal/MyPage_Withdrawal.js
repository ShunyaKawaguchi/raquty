document.addEventListener('DOMContentLoaded', function() {
    var withdrawalForm = document.getElementById('UserWithdrawal');
    var withdrawalButton = document.getElementById('Withdrawal');
    var agreeCheckbox = document.getElementById('agree');
  
    // 退会ボタンクリック時の処理
    withdrawalButton.addEventListener('click', function(event) {
      event.preventDefault();
  
      if (!agreeCheckbox.checked) {
        alert('退会手続きを行うにはチェックボックスにチェックを入れてください。');
      } else {
        if (confirm('本当に退会しますか？')) {
          if (confirm('本当に退会しますか？この操作は取り消せません。')) {
            withdrawalForm.method = 'post';
            withdrawalForm.action = '/components/templates/MyPage_Withdrawal/delete_data.php';
            withdrawalForm.submit();
          }
        }
      }
    });
  });
  