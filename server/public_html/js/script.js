function nav_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function nav_close() {
  document.getElementById("mySidebar").style.display = "none";
}
function show_torecieve(){
  document.getElementById("form-torecieve").style.display = "block";
  document.getElementById("form-myorderhistory").style.display = "none";
  document.getElementById("btn-torecieve").style.backgroundColor="white";
  document.getElementById("btn-myorderhistory").style.backgroundColor="teal";
}
function show_myorderhistory(){
  document.getElementById("form-torecieve").style.display = "none";
  document.getElementById("form-myorderhistory").style.display = "block";
  document.getElementById("btn-myorderhistory").style.backgroundColor="white";
  document.getElementById("btn-torecieve").style.backgroundColor="teal";
}

function button_click(){
  document.getElementById("btnupdprofile").style.backgroundColor="white";
  document.getElementById("btnupdprofilepic").style.backgroundColor="white";
}

function show_customeraccount(){
  document.getElementById("form_customeraccount").style.display = "block";
  document.getElementById("form_rideraccount").style.display = "none";
  document.getElementById("btn-custaccount").style.backgroundColor="white";
  document.getElementById("btn-rideaccount").style.backgroundColor="teal";
}
function show_rideraccount(){
  document.getElementById("form_customeraccount").style.display = "none";
  document.getElementById("form_rideraccount").style.display = "block";
  document.getElementById("btn-rideaccount").style.backgroundColor="white";
  document.getElementById("btn-custaccount").style.backgroundColor="teal";
}