var lastBrickClicked = "";
var lastModal = "";
var popupArr = [];

// document.getElementById('myPopup').addEventListener("visibilitychange", () => {
// 	if(document.visibilityState === 'visible'){
// 		document.getElementById('first').value = popupArr[0];
// 	}
// });


function searchNameClicked(brick)
{
	var doc = "m" + brick[0];
	/*if(lastBrick != ""){
		lastModal.getElementById(lastBrick).innerHTML = "";
	}*/

	var xmlhttp = new XMLHttpRequest();

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
				if (this.readyState == 4 && this.status == 200) {
					var popup = modalDoc.getElementById('myPopup');
					modalDoc.getElementById('myPopup').innerHTML = "";
					var popupArr = this.responseText.split('|');
			
					for (var i = 0; i < popupArr.length; i++){
						if (i == popupArr.length - 1){
							modalDoc.getElementById('myPopup').innerHTML += popupArr[i];
						}
						else {
							modalDoc.getElementById('myPopup').innerHTML += popupArr[i] + "<br/>";
						}
					}
					popup.classList.toggle("show");
				}
			}

		}
	};

	
	//lastBrick = brick;
	
	
	

	//Sending data to the PHP file
	let variables = "groupName=" + brick[0] + "&brickID=" + brick[1] + brick[2] + brick[3];
	console.log(variables);
	xmlhttp.open("GET", "searchDBAdmin.php?" + variables, true);
	xmlhttp.send();
}

function brickClicked(brick)
{
	lastBrickClicked = brick;
	var xmlhttp = new XMLHttpRequest();

	// This Receiving Data back from PHP
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var popup = document.getElementById('myPopup');
			// document.getElementById('myPopup').innerHTML = "";
			// console.log(this.responseText);
			// potentially could add in /n instead of using |

			console.log(this.responseText);
			var popupArr;
			if (this.responseText == "default state "){
				popupArr = "empty";
			}
			else{
				popupArr = JSON.parse(this.responseText)
			}
			// popupArr = popupArr.split('^');
			if (popupArr !== "empty" && popupArr !== null){
				var brickDescriptionArray = popupArr[0]['brickDescription'].split('|');
				console.log(popupArr[0]['firstName']);
				document.getElementById('firstInputBox').setAttribute('value', popupArr[0]["firstName"]);
				//figure out why firstInputBox is not working
				document.getElementById('lastInputBox').setAttribute('value', popupArr[0]['lastName']);
			
				//console.log(popupArr[2])
				if (popupArr[0]['brickDescription'].length == 1){
					document.getElementById('brickDescription').innerHTML = null;
					// document.getElementById('brickDescription').placeholder = "Enter brick description here including first and last name... NOTE: Line breaks should be entered as they appear on the brick.";
					
				}
				else{
					document.getElementById('brickDescription').innerHTML = '';
				}

				// document.getElementById('brickDescription').value = '';
				if (popupArr[0].brickDescription.length > 1){
					document.getElementById('brickDescription').value = "";
					for (var i = 0; i < brickDescriptionArray.length; i++){
						if (i == brickDescriptionArray.length - 1){
							document.getElementById('brickDescription').value += brickDescriptionArray[i];
						}
						else {
							document.getElementById('brickDescription').value += brickDescriptionArray[i] + "\n";
						}
					}
				}
			}
			else{
				document.getElementById('firstInputBox').setAttribute('value', "");
				document.getElementById('lastInputBox').setAttribute('value', "");
				document.getElementById('brickDescription').value = "";
			}
			document.getElementById("myPopup").style.display = "block";
			console.log('are we here?');
		}
	};

	//Sending data to the PHP file
	// let groupName = brick[0];
	// let brickID = brick[1] + brick[2] + brick[3];
	// document.getElementById('groupName').setAttribute('value', groupName);
	// document.getElementById('brickID').setAttribute('value', brickID);
	// let variables = "groupName=" + groupName + "&brickID=" + brickID;
	let variables = "brick=" + brick; //+ "&groupName=" + brick[0];
	console.log(variables);
	xmlhttp.open("GET", "searchDBAdmin.php?" + variables, true);
	xmlhttp.send();
	

	// When the user clicks on <div>, open the popup
	/*function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
      }*/
	
}

function updateBrick()
{
	var xmlhttp = new XMLHttpRequest();

	let groupName = document.getElementById('groupName').value;
	let brickID = document.getElementById('brickID').value;
	let firstName = document.getElementById('firstInputBox').value;
	let lastName = document.getElementById('lastInputBox').value;
	let brickDescription = document.getElementById('brickDescription').value;
	let variables = "groupName=" + groupName + "&brickID=" + brickID 
	+ "&firstName=" + firstName + "&lastName=" + lastName + "&brickDescription=" 
	+ brickDescription;

	// This Receiving Data back from PHP
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//try stuff to make the info refresh when save is clicked
			//populatorOfBricks("a");
			//console.log(this.responseText);
			var rText = (this.responseText);
			//console.log(rText);
			if (rText.localeCompare(groupName)){
				console.log("Successfully updated the database!");
				populatorOfBricks(groupName);
				closeEditPopup();
				
				var popup = document.getElementById('myCoolerPopup');
				document.getElementById('myCoolerPopup').innerHTML = "Saved Successfully";
				// popup.classList.toggle("show");
				

			}
			console.log('here!Q!!');
			document.getElementById("myCoolerPopup").style.display = "block";
			setTimeout(getRidOfIt, 3000);
		}
	};

	//Sending data to the PHP file
	xmlhttp.open("GET", "updateDB.php?" + variables, true);
	xmlhttp.send();	
}

function closeEditPopup() {
	document.getElementById("myPopup").style.display = "none";
}

function getRidOfIt(){
	document.getElementById("myCoolerPopup").style.display = "none";
	console.log("heehee");
}

function populatorOfBricks(table) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                       
            var passedArray = JSON.parse(this.response);


            //12 -> a012 getElementById(a012)

            // Need to retrieve all the data from database to show

            for(var i = 0; i < passedArray.length; i++){
                if (passedArray[i].firstName !== null){
                    console.log(passedArray[i].brickNum);
                    document.getElementById(passedArray[i].brickNum).innerHTML = passedArray[i].firstName + " " + passedArray[i].lastName;
                }
                
            }
            

    
        }
    };

    //Sending data to the PHP file
    let variable = "table=" + table;
	xmlhttp.open("GET", "brickGroupPopulatorAdmin.php?" + variable, true);
	xmlhttp.send();
}