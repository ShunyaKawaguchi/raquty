document.getElementById('UserPlayerID').addEventListener('submit', function (event) {
    const playerIDField = document.getElementById('player_id');
    const playerIDValue = playerIDField.value;
    const alphanumericPattern = /^[a-zA-Z0-9]+$/;

    if (playerIDValue.length !== 8 || !alphanumericPattern.test(playerIDValue)) {
        alert('選手IDは半角英数字8文字で入力してください。');
        event.preventDefault(); 
    } else {
        // すべてのチェックに通過した場合、methodとactionを設定してフォームを送信
        const insertForm = document.getElementById('UserPlayerID');
        insertForm.method = 'post';
        insertForm.action = '/components/templates/MyPage_PlayerID/update_data.php'; 
    }
});