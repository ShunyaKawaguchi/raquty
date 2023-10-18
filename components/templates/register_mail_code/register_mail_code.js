function validateInput(inputElement, index) {
    const inputValue = inputElement.value;
    if (/^[0-9]$/.test(inputValue)) {
        // 入力が半角数字の場合
        if (inputElement.nextElementSibling) {
            // 次のinput要素にフォーカスを移動
            inputElement.nextElementSibling.focus();
        }
    } else if (inputValue === '' && index > 1) {
        // 入力が空でかつ前のinput要素がある場合、前のinput要素にフォーカスを移動
        const previousInput = document.getElementsByName('num' + (index - 1))[0];
        if (previousInput) {
            previousInput.focus();
        }
    } else {
        // 入力が半角数字でない場合、入力をクリア
        inputElement.value = '';
    }
}

var reZendElement = document.getElementById("Re_send");
var hereElement = document.getElementById("here");
var resendForm = document.getElementById("resendForm");

// id="here"がクリックされたときの処理
hereElement.addEventListener("click", function(event) {
  // クリックイベントの伝播を停止
  event.stopPropagation();
  // 要素の表示を切り替え
  reZendElement.style.display = "flex";
});

// ドキュメント全体のクリックイベントリスナー
document.addEventListener("click", function(event) {
  // クリックされた要素が"id=Re_send"でない場合、要素を非表示にする
  if (event.target !== reZendElement && event.target !== hereElement) {
    reZendElement.style.display = "none";
  }
});

// ボタンがクリックされたときの処理
resendForm.addEventListener("submit", function(event) {
  // リダイレクト先のURLを設定
  event.preventDefault();
  resendForm.action = "/components/templates/register_mail_code/mail_resend.php";
  // フォームを送信
  resendForm.submit();
});

// register_inputのセッションストレージを空にする（共有端末での個人情報保護のために）
function clearSessionStorage() {
    sessionStorage.clear();
}

clearSessionStorage();