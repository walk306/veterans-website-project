function sendDaData(){
    var xmlhttp = new XMLHttpRequest();
    
    var adminUsername = document.getElementById("usernameInputBox").value;
    var adminPassword = document.getElementById("passwordInputBox").value;

    let variables = "adminUsername=" + adminUsername + "&adminPassword=" + adminPassword;

    xmlhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            //console.log(this.responseText);
            //window.location.href="/veterans-website-project/html-admin/indexAdmin.html";
            window.location.href="/veterans-website-project/html-admin/indexAdmin.php";
        }
    }
    xmlhttp.open("POST", "login.php?", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(variables); 
}