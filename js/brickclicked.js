var lastBrick = "";
var lastModal = "";

function searchNameClicked(brick)
{
	var doc = "m" + brick[0];

	if(lastBrick != ""){
		lastModal.getElementById(lastBrick).innerHTML = "";
	}

	var xmlhttp = new XMLHttpRequest();

	console.log('brick: ', brick);
	//docA.getElementById(brick).innerHTML = "WHYYY";

	// This Receiving Data back from PHP
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//click(document.getElementById("bamodal"));
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
			console.log(this.response);
			lastModal = modalDoc;
		}
	};

	
	lastBrick = brick;
	
	
	

	//Sending data to the PHP file
	let variables = "groupName=" + brick[0] + "&brickNumber=" + brick[1] + brick[2] + brick[3];
	console.log(variables);
	xmlhttp.open("GET", "searchDB.php?" + variables, true);
	xmlhttp.send();
}

function brickClicked(brick)
{
	//document.getElementById(brick).innerHTML = brick;
	if(lastBrick != ""){
		document.getElementById(lastBrick).innerHTML = "";
	}

	var xmlhttp = new XMLHttpRequest();

	// This Receiving Data back from PHP
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById(brick).innerHTML = this.responseText;
		}
	};

	
	lastBrick = brick;
	

	//Sending data to the PHP file
	let variables = "groupName=" + brick[0] + "&brickNumber=" + brick[1] + brick[2] + brick[3];
	xmlhttp.open("GET", "searchDB.php?" + variables, true);
	xmlhttp.send();
}