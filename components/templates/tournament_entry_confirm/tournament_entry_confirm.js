const EntyrSubmitButton = document.getElementById("Next");
const EntyrSubmitButton1 = document.getElementById("Next1");
const EntryForm = document.getElementById("Entry"); 

//フォームに情報を付け加えて送信
EntyrSubmitButton.addEventListener("click", function(event) {
    event.preventDefault();
    EntryForm.action = "/components/templates/tournament_entry_confirm/entry_process.php"; 
    EntryForm.submit();
});

EntyrSubmitButton1.addEventListener("click", function(event) {
    event.preventDefault();
    EntryForm.action = "/components/templates/tournament_entry_confirm/entry_process.php"; 
    EntryForm.submit();
});