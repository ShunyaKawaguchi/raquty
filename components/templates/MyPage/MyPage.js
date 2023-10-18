// エントリーした大会を確認するページのURL
const entryPageUrl = homeUrl('MyPage/Tournament');

// 登録情報を変更するページのURL
const updatePageUrl = homeUrl('MyPage/UserInfo');

// 選手IDを変更するページのURL
const PlayerIDPageUrl = homeUrl('MyPage/PlayerID');

// パスワードページのURL
const passwordPageUrl = homeUrl('MyPage/Password');

// 退会するページのURL
const leavePageUrl = homeUrl('MyPage/Withdrawal');

// イベントリスナーを設定
document.getElementById('entryLink').addEventListener('click', function() {
    window.location.href = entryPageUrl;
});

document.getElementById('updateLink').addEventListener('click', function() {
    window.location.href = updatePageUrl;
});

document.getElementById('PlayerIDLink').addEventListener('click', function() {
    window.location.href = PlayerIDPageUrl;
});

document.getElementById('passwordLink').addEventListener('click', function() {
    window.location.href = passwordPageUrl;
});

document.getElementById('leaveLink').addEventListener('click', function() {
    window.location.href = leavePageUrl;
});