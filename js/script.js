function main() {
  // Get the modal bottom of html doc
  var b1c2modal = document.getElementById("b1c2modal");
  var b2c2modal = document.getElementById("b2c2modal");
  var b3c2modal = document.getElementById("b3c2modal");
  var b1c3modal = document.getElementById("b1c3modal");
  var b2c3modal = document.getElementById("b2c3modal");
  var b3c3modal = document.getElementById("b3c3modal");
  var b1c4modal = document.getElementById("b1c4modal");

  // Get the iframe that opens the modal iframe
  var b1c2 = document.getElementById("b1c2");
  var b2c2 = document.getElementById("b2c2");
  var b3c2 = document.getElementById("b3c2");
  var b1c3 = document.getElementById("b1c3");
  var b2c3 = document.getElementById("b2c3");
  var b3c3 = document.getElementById("b3c3");
  var b1c4 = document.getElementById("b1c4");

  b1c2modal.style.display = "none";
  b2c2modal.style.display = "none";
  b3c2modal.style.display = "none";
  b1c3modal.style.display = "none";
  b2c3modal.style.display = "none";
  b3c3modal.style.display = "none";
  b1c4modal.style.display = "none";

  b1c2.contentDocument.onclick = function(){
    click(b1c2modal);
  }
  b2c2.contentDocument.onclick = function(){
    click(b2c2modal);
  }
  b3c2.contentDocument.onclick = function(){
    click(b3c2modal);
  }
  b1c3.contentDocument.onclick = function(){
    click(b1c3modal);
  }
  b2c3.contentDocument.onclick = function(){
    click(b2c3modal);
  }
  b3c3.contentDocument.onclick = function(){
    click(b3c3modal);
  }
  b1c4.contentDocument.onclick = function(){
    click(b1c4modal);
  }

}

function click(modal) {
  if(modal.style.display == "none"){
    modal.style.display = "block";
    console.log('got in here');
    }
}

function closeModalSpan() {
  var b1c2modal = document.getElementById("b1c2modal");
  var b2c2modal = document.getElementById("b2c2modal");
  var b3c2modal = document.getElementById("b3c2modal");
  var b1c3modal = document.getElementById("b1c3modal");
  var b2c3modal = document.getElementById("b2c3modal");
  var b3c3modal = document.getElementById("b3c3modal");
  var b1c4modal = document.getElementById("b1c4modal");

  b1c2modal.style.display = "none";
  b2c2modal.style.display = "none";
  b3c2modal.style.display = "none";
  b1c3modal.style.display = "none";
  b2c3modal.style.display = "none";
  b3c3modal.style.display = "none";
  b1c4modal.style.display = "none";
}

function closeModalWindow(event) {
  var b1c2modal = document.getElementById("b1c2modal");
  var b2c2modal = document.getElementById("b2c2modal");
  var b3c2modal = document.getElementById("b3c2modal");
  var b1c3modal = document.getElementById("b1c3modal");
  var b2c3modal = document.getElementById("b2c3modal");
  var b3c3modal = document.getElementById("b3c3modal");
  var b1c4modal = document.getElementById("b1c4modal");

  if(event.target == b1c2modal) {
    b1c2modal.style.display = "none";
  }
  else if(event.target == b2c2modal) {
    b2c2modal.style.display = "none";
  }
  else if(event.target == b3c2modal) {
    b3c2modal.style.display = "none";
  }
  else if(event.target == b1c3modal) {
    b1c3modal.style.display = "none";
  }
  else if(event.target == b2c3modal) {
    b2c3modal.style.display = "none";
  }
  else if(event.target == b3c3modal) {
    b3c3modal.style.display = "none";
  }
  else if(event.target == b1c4modal) {
    b1c4modal.style.display = "none";
  }
}
