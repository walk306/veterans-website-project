var lastBrick = ""
var docA = null;
var docB = null;
var docC = null; 
var docD = null; 
var docE = null; 
var docF = null; 
var docG = null;

function loadUpBrickClicked(){
	console.log("inside loadupbrickclicked");

	var aBrickGroup = document.getElementById("ba");
    docA = aBrickGroup.contentDocument || aBrickGroup.contentWindow.document;

	if(!docA){
		throw "WE CAN't GET IT!";
		console.log("nevermind");
		
	}
	else{
		console.log("em k");
	}
	

	var brickGroupB = document.getElementById("bb");
	docB = brickGroupB.contentDocument || brickGroupB.contentWindow.document;
	
	var brickGroupC = document.getElementById("bc");
    docC = brickGroupC.contentDocument || brickGroupC.contentWindow.document;

	var brickGroupD = document.getElementById("bd");
	docD = brickGroupD.contentDocument || brickGroupD.contentWindow.document;
	
	var brickGroupE = document.getElementById("be");
    docE = brickGroupE.contentDocument || brickGroupE.contentWindow.document;

	var brickGroupF = document.getElementById("bf");
	docF = brickGroupF.contentDocument || brickGroupF.contentWindow.document;

	var brickGroupG = document.getElementById("bg");
	docG = brickGroupG.contentDocument || brickGroupG.contentWindow.document;


}

function searchNameClicked(brick)
{
	//docA.getElementById("a012").innerHTML = "WHY WON";
	console.log(brick);
	if(brick[0] == "a"){
		var doc = docA;
	}
	
	if(brick[0] == "b"){
		var doc = docB;
	}
	if(brick[0] == "c"){
		var doc = docC;
	}
	if(brick[0] == "d"){
		var doc = docD;
	}
	if(brick[0] =="e"){
		var doc = docE;
	}
	if(brick[0] == "f"){
		var doc = docF;
	}
	if(brick[0] == "g"){
		var doc = docG;
	}
	
	console.log(doc);
	console.log(docA);

	// a002
	// Clear last brick filled with information
	if(lastBrick != ""){
		doc.getElementById(lastBrick).innerHTML = "";
	}

	var xmlhttp = new XMLHttpRequest();

	console.log('brick: ', brick);
	//docA.getElementById(brick).innerHTML = "WHYYY";

	// This Receiving Data back from PHP
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			doc.getElementById(brick).innerHTML = this.response; //this.responseText;
			console.log(this.response);
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
	console.log(lastBrick);
	

	//Sending data to the PHP file
	let variables = "groupName=" + brick[0] + "&brickNumber=" + brick[1] + brick[2] + brick[3];
	console.log(variables);
	xmlhttp.open("GET", "searchDB.php?" + variables, true);
	xmlhttp.send();
}