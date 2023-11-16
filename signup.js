"use strict";

function validateForm() {
  let name = document.forms["myForm"]["name"].value;
  console.log(name);
  if (name.length < 10) {
    alert("Name should atleast be 10 characters");
    return false;
  }
}
