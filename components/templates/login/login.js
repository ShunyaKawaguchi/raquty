const loginForm = document.getElementById("Login_Authorization"); 
const submitButton = document.getElementById("Login");

submitButton.addEventListener("click", function(event) {
    event.preventDefault();
    loginForm.action = "/raquty-cms-system/login/login.php"; 
    loginForm.submit();
});
