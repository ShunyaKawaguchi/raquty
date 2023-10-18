const ContactSubmitButton = document.getElementById("Submit");
const ContactForm = document.getElementById("Contact"); 

//フォームに情報を付け加えて送信
ContactSubmitButton.addEventListener("click", function(event) {
    event.preventDefault();
    ContactForm.action = "/components/templates/Contact/Contact_process.php"; 
    ContactForm.submit();
});