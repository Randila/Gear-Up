function validateEmail() {

    var email = document.getElementById("regEmail").value;
    var len = email.length;
    var at = email.indexOf("@");
    var dot = email.lastIndexOf(".");

    if ((dot - at) > 3 && (len - dot) > 3) {
        return true;
    }
    alert("Please enter a valid email address");
    return false;

}

function validatePwd() {
    var pwd = document.getElementById("regpwd").value;
    var valpwd = document.getElementById("regpwdval").value;
    // var len = pwd.length;
    // var vallen = valpwd.length;
    if (pwd == valpwd) {
        return true;
    }
    alert("Passwords don't match");
    document.getElementById('regpwdval').value = '';
    // event.preventDefault();
    // return false;
}

function validateRegister() {
    if (validatePwd() && validateEmail()) {
        // location.replace('login.html');
        // alert("success");
        // alert
        return true;
    } else {
        event.preventDefault();
    }
}

function checkMobile() {
    var numbers = /^[0-9]+$/;
    var mobile = document.getElementById("txtMobile").value;

    if (mobile.length == 10) {
        if (mobile.match(numbers)) {
            return true;
        }
        alert("Phone number should only consist with digits");
        return false;
        event.preventDefault();
    }
    alert("Invalid Phone Number");
    return false;
    event.preventDefault();
}