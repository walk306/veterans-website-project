function populatorOfBricks(table) {
    
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            /*
            click(document.getElementById("bamodal"));
            var brickGroup = document.getElementById(doc);
            modalDoc = brickGroup.contentDocument || brickGroup.contentWindow.document;

            if(!modalDoc){
                throw "WE CAN't GET IT!";
                console.log("nevermind");
                
            }
            else{
                console.log("em k");
            }
            modalDoc.getElementById(brick).innerHTML = this.response; //this.responseText;
            lastModal = modalDoc;*/
            var passedArray = this.response;

            // Need to retrieve all the data from database to show

            for(var i = 0; i < passedArray.lenght; i++){
                console.log(passedArray[i]);
            }
        }
    };

    //Sending data to the PHP file
	xmlhttp.open("GET", "brickGroupPopulator.php?" + table, true);
	xmlhttp.send();
}