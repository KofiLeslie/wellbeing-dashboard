function save(parent) {
    var myArr = [];


var radioGroup = document.getElementById($parent);
var radioButtons = radioGroup.getElementsByTagName("input");
var allChecked = true;

for (var i = 0; i < radioButtons.length; i++) {
  if (radioButtons[i].type === "radio" && !radioButtons[i].checked) {
    allChecked = false;
    break;
  }
}

if (allChecked) {
  console.log("All radio buttons are checked.");
} else {
  console.log("Not all radio buttons are checked.");
}


}
