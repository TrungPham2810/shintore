var newpassword = document.getElementById("new_password")
    , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
    if(newpassword.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
        confirm_password.setCustomValidity('');
    }
}

newpassword.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

$(function (){

    $(".roles_select").select2({
        placeholder: "Select a roles",
        allowClear: true
    });
});