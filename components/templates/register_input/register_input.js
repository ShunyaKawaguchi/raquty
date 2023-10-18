window.addEventListener('load', function () {
    const form = document.querySelector('form');
    const formCheck = document.querySelector('.Form_check');
    const lastNameKanjiCheck = document.getElementById('LastName_kanji');
    const firstNameKanjiCheck = document.getElementById('FirstName_kanji');
    const lastNameCheck = document.getElementById('LastName');
    const firstNameCheck = document.getElementById('FirstName');
    const belongingCheck = document.getElementById('Belonging');
    const playerIdCheck = document.getElementById('Player_id');
    const birthdayCheck = document.getElementById('Birthday');
    const emailCheck = document.getElementById('Email');

    // フォームの各入力フィールド要素を取得
    const lastNameKanjiInput = form.querySelector('#Last_name_kanji');
    const firstNameKanjiInput = form.querySelector('#First_name_kanji');
    const lastNameInput = form.querySelector('#Last_name');
    const firstNameInput = form.querySelector('#First_name');
    const belongingInput = form.querySelector('#belonging');
    const playerIdInput = form.querySelector('#player_id');
    const birthdayInput = form.querySelector('#birthday');
    const emailInput = form.querySelector('#email');
    const termsCheckbox = form.querySelector('#terms');

    // セッションストレージからデータを取得してフォームにセットする関数
    function populateForm() {
        if (sessionStorage.getItem('formData')) {
            const formData = JSON.parse(sessionStorage.getItem('formData'));
            lastNameKanjiInput.value = formData.lastNameKanji;
            firstNameKanjiInput.value = formData.firstNameKanji;
            lastNameInput.value = formData.lastName;
            firstNameInput.value = formData.firstName;
            belongingInput.value = formData.belonging;
            playerIdInput.value = formData.playerId;
            birthdayInput.value = formData.birthday;
            emailInput.value = formData.email;
            termsCheckbox.checked = formData.terms;

            // 姓（漢字）の表示を更新
            lastNameKanjiCheck.textContent = formData.lastNameKanji;
            firstNameKanjiCheck.textContent = formData.firstNameKanji;
            lastNameCheck.textContent = formData.lastName;
            firstNameCheck.textContent = formData.firstName;
            belongingCheck.textContent = formData.belonging;
            playerIdCheck.textContent = formData.playerId;
            birthdayCheck.textContent = formData.birthday;
            emailCheck.textContent = formData.email;
        }
    }

    // フォームの各入力フィールドに変更があった場合にデータをセッションストレージに保存する処理
    form.addEventListener('input', function () {
        const formData = {
            lastNameKanji: lastNameKanjiInput.value,
            firstNameKanji: firstNameKanjiInput.value,
            lastName: lastNameInput.value,
            firstName: firstNameInput.value,
            belonging: belongingInput.value,
            playerId: playerIdInput.value,
            birthday: birthdayInput.value,
            email: emailInput.value,
            terms: termsCheckbox.checked,
        };
        sessionStorage.setItem('formData', JSON.stringify(formData));
    });

    // フォームの初期値を設定
    populateForm();

        // 「修正」ボタンがクリックされたときの処理
        const notCorrectButton = document.getElementById('Not_correct');
        notCorrectButton.addEventListener('click', function () {
            formCheck.style.display = 'none'; // 確認画面を非表示にする
        });


        // 「確認画面へ」ボタンがクリックされたときの処理
        const inputCheckButton = document.getElementById('input_check');
        inputCheckButton.addEventListener('click', function (event) {
        event.preventDefault(); // ボタンのデフォルトの動作を無効化

        // セッションストレージからデータを取得して確認画面に表示
        const formData = JSON.parse(sessionStorage.getItem('formData'));
        document.getElementById('LastName_kanji').textContent = formData.lastNameKanji;
        document.getElementById('FirstName_kanji').textContent = formData.firstNameKanji;
        document.getElementById('LastName').textContent = formData.lastName;
        document.getElementById('FirstName').textContent = formData.firstName;
        document.getElementById('Belonging').textContent = formData.belonging;
        document.getElementById('Player_id').textContent = formData.playerId;
        document.getElementById('Birthday').textContent = formData.birthday;
        document.getElementById('Email').textContent = formData.email;

        // フォームを非表示にし、確認画面を表示
        formCheck.style.display = 'flex'; 
    });
});

const birthdayInput = document.getElementById("birthday");

        birthdayInput.addEventListener("input", (event) => {
            const input = event.target.value;
            const cleanedInput = input.replace(/[^0-9]/g, "");
            const formattedInput = formatBirthday(cleanedInput);
            birthdayInput.value = formattedInput;
        });

        function formatBirthday(input) {
            if (input.length > 4) {
                return input.slice(0, 4) + "/" + input.slice(4, 6) + "/" + input.slice(6, 8);
            } else if (input.length > 2) {
                return input.slice(0, 4) + "/" + input.slice(4, 6);
            } else {
                return input;
            }
        }

const confirmButton = document.getElementById('confirmButton');
const form = document.getElementById('Register_Info'); 
confirmButton.addEventListener('click', function (event) {
    event.preventDefault();
    form.action = '/components/templates/register_input/register_process.php'; 
    form.submit();
});