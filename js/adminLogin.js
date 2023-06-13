function sendDaData(){
    var xmlhttp = new XMLHttpRequest();
    
    var adminUsername = document.getElementById("usernameInputBox").value;
    var adminPassword = document.getElementById("passwordInputBox").value;

    let variables = "adminUsername=" + adminUsername + "&adminPassword=" + adminPassword;

    xmlhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            if (this.responseText == "supersecuresessiontoken"){
                console.log("The problem was incredibly stupid");
                /*Like, so stupid. login.php was continuing to run because
                there wasn't an exit statement. Once the exit statement was
                added, it worked fine. Redirects as intended and everything.*/
                window.location.href="/veterans-website-project/html-admin/indexAdmin.html";
            }
        }
    }
    xmlhttp.open("POST", "login.php?", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(variables); 
}

