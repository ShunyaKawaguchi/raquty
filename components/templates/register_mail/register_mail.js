const confirmButton = document.getElementById("confirm");
const popup = document.getElementById("Register_cfm");
const popupEmail = document.getElementById("Email_cfm");
const editButton = document.getElementById("edit");
const submitButton = document.getElementById("submit");
const userEmailInput = document.getElementById("user_mail");
const cfmMsg = document.getElementById("cfm_msg");
const emailForm = document.getElementById("emailForm"); 

confirmButton.addEventListener("click", (event) => {
    event.preventDefault();

    if (isValidEmail(userEmailInput.value)) {
        popupEmail.textContent = userEmailInput.value;
        displayPopupWithAnimation(popup);
    } else {
        showError("正しいメールアドレスを入力してください。");
    }
});

editButton.addEventListener("click", () => {
    hidePopupWithAnimation(popup);
    hideError();
});

submitButton.addEventListener("click", function(event) {
    event.preventDefault();
    emailForm.action = "/components/templates/register_mail/temporary_register_process.php"; 
    emailForm.submit();
    hidePopupWithAnimation(popup);
    hideError();
});

userEmailInput.addEventListener("input", () => {
    confirmButton.disabled = !isValidEmail(userEmailInput.value);
});

function displayPopupWithAnimation(element) {
    element.style.display = "flex";
}

function hidePopupWithAnimation(element) {
    element.style.display = "none";
    cfmMsg.style.opacity = 0;
    cfmMsg.style.transform = "translateY(-20px)";
}

function showError(message) {
    cfmMsg.textContent = message;
    cfmMsg.style.opacity = 1;
    cfmMsg.style.transform = "translateY(0)";
}

function hideError() {
    cfmMsg.style.opacity = 0;
    cfmMsg.style.transform = "translateY(-20px)";
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
