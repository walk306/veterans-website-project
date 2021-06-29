var lastBrick = ""
var aDoc = null;
var bDoc = null;
var cDoc = null; 
var dDoc = null; 
var eDoc = null; 
var fDoc = null; 
var gDoc = null;

function loadedUp(){
	var brickGroupA = document.getElementById("ba");
    aDoc = brickGroupA.contentDocument || brickGroupA.contentWindow.document;

	var brickGroupB = document.getElementById("bb");
	bDoc = brickGroupB.contentDocument || brickGroupB.contentWindow.document;
	
	var brickGroupC = document.getElementById("bc");
    cDoc = brickGroupC.contentDocument || brickGroupC.contentWindow.document;

	var brickGroupD = document.getElementById("bd");
	dDoc = brickGroupD.contentDocument || brickGroupD.contentWindow.document;
	
	var brickGroupE = document.getElementById("be");
    eDoc = brickGroupE.contentDocument || brickGroupE.contentWindow.document;

	var brickGroupF = document.getElementById("bf");
	fDoc = brickGroupF.contentDocument || brickGroupF.contentWindow.document;

	var brickGroupG = document.getElementById("bg");
	gDoc = brickGroupG.contentDocument || brickGroupG.contentWindow.document;

}

function searchNameClicked(brick)
{
	if(brick[0] = "a"){
		var doc = aDoc
	}
	if(brick[0] = "b"){
		var doc = bDoc
	}
	if(brick[0] = "c"){
		var doc = cDoc
	}
	if(brick[0] = "d"){
		var doc = dDoc
	}
	if(brick[0] = "e"){
		var doc = eDoc
	}
	if(brick[0] = "f"){
		var doc = fDoc
	}
	if(brick[0] = "g"){
		var doc = gDoc
	}

	if(lastBrick != ""){
		doc.getElementById(lastBrick).innerHTML = "";
	}

	var xmlhttp = new XMLHttpRequest();

	// This Receiving Data back from PHP
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			doc.getElementById(brick).innerHTML = this.responseText;
		}
	};

	
	lastBrick = brick;
	console.log(lastBrick);
	

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
	console.log(lastBrick);
	

	//Sending data to the PHP file
	let variables = "groupName=" + brick[0] + "&brickNumber=" + brick[1] + brick[2] + brick[3];
	console.log(variables);
	xmlhttp.open("GET", "searchDB.php?" + variables, true);
	xmlhttp.send();
}