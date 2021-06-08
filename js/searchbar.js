var brickGroupA = document.getElementById("ba");

function filter(str) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
		document.getElementById("tem").innerHTML = this.responseText;
	  }
	};
	xhttp.open("GET", "searchBar.php?q="+str, true);
	xhttp.send();
	document.getElementById("tem").innerHTML = "got here";
  
  }
  
  function searchBar(str) {
  
	if (str.length == 0) {
	  document.getElementById("tem2").innerHTML = "";
	  return;
	} else {
	  var xmlhttp = new XMLHttpRequest();
	  xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		  document.getElementById("tem2").innerHTML = this.responseText;
		}
	  };
  
	  let variables = "input=" + str + "&filter=" + document.getElementById("searchFilter").value;
	  console.log(variables);
	  xmlhttp.open("GET", "searchBar.php?" + variables, true);
	  xmlhttp.send();
	}
  }