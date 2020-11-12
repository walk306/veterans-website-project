function main() {
  // Get the modal bottom of html doc
  var bamodal = document.getElementById("bamodal");
  var bbmodal = document.getElementById("bbmodal");
  var bcmodal = document.getElementById("bcmodal");
  var bdmodal = document.getElementById("bdmodal");
  var bemodal = document.getElementById("bemodal");
  var bfmodal = document.getElementById("bfmodal");
  var bgmodal = document.getElementById("bgmodal");

  // Get the iframe that opens the modal iframe
  var ba = document.getElementById("ba");
  var bb = document.getElementById("bb");
  var bc = document.getElementById("bc");
  var bd = document.getElementById("bd");
  var be = document.getElementById("be");
  var bf = document.getElementById("bf");
  var bg = document.getElementById("bg");

  bamodal.style.display = "none";
  bbmodal.style.display = "none";
  bcmodal.style.display = "none";
  bdmodal.style.display = "none";
  bemodal.style.display = "none";
  bfmodal.style.display = "none";
  bgmodal.style.display = "none";

  ba.contentDocument.onclick = function(){
    click(bamodal);
  }
  bb.contentDocument.onclick = function(){
    click(bbmodal);
  }
  bc.contentDocument.onclick = function(){
    click(bcmodal);
  }
  bd.contentDocument.onclick = function(){
    click(bdmodal);
  }
  be.contentDocument.onclick = function(){
    click(bemodal);
  }
  bf.contentDocument.onclick = function(){
    click(bfmodal);
  }
  bg.contentDocument.onclick = function(){
    click(bgmodal);
  }

}

function click(modal) {
  if(modal.style.display == "none"){
    modal.style.display = "block";
    console.log('got in here');
    }
}

function closeModalSpan() {
  var bamodal = document.getElementById("bamodal");
  var bbmodal = document.getElementById("bbmodal");
  var bcmodal = document.getElementById("bcmodal");
  var bdmodal = document.getElementById("bdmodal");
  var bemodal = document.getElementById("bemodal");
  var bfmodal = document.getElementById("bfmodal");
  var bgmodal = document.getElementById("bgmodal");

  bamodal.style.display = "none";
  bbmodal.style.display = "none";
  bcmodal.style.display = "none";
  bdmodal.style.display = "none";
  bemodal.style.display = "none";
  bfmodal.style.display = "none";
  bgmodal.style.display = "none";
}

function closeModalWindow(event) {
  var bamodal = document.getElementById("bamodal");
  var bbmodal = document.getElementById("bbmodal");
  var bcmodal = document.getElementById("bcmodal");
  var bdmodal = document.getElementById("bdmodal");
  var bemodal = document.getElementById("bemodal");
  var bfmodal = document.getElementById("bfmodal");
  var bgmodal = document.getElementById("bgmodal");

  if(event.target == bamodal) {
    bamodal.style.display = "none";
  }
  else if(event.target == bbmodal) {
    bbmodal.style.display = "none";
  }
  else if(event.target == bcmodal) {
    bcmodal.style.display = "none";
  }
  else if(event.target == bdmodal) {
    bdmodal.style.display = "none";
  }
  else if(event.target == bemodal) {
    bemodal.style.display = "none";
  }
  else if(event.target == bfmodal) {
    bfmodal.style.display = "none";
  }
  else if(event.target == bgmodal) {
    bgmodal.style.display = "none";
  }
}
