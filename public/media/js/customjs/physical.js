function saveProgress(index) {
    let radioValues = [];
    let radioNames = [];
    let radioButton = document.getElementsByClassName("sol" + index);
    let allChecked = true;

    for (let i = 0; i < radioButton.length; i += 10) {
        if (radioButton[i].type === "radio") {
            radioNames.push(radioButton[i].name);
        }
    }

    // next is to now check if they have been checked or not
    for (let i = 0; i < radioNames.length; i++) {
        if ($("input[name=" + radioNames[i] + "]:checked").length == 0) {
            allChecked = false;
            break;
        } else {
            radioValues.push(
                $("input[name=" + radioNames[i] + "]:checked").val()
            );
        }
    }

    if (allChecked) {

        $('#datax').val(JSON.stringify(radioValues));

        $('#myform').submit();

    } else {
        $('#myform').submit();
    }
}
