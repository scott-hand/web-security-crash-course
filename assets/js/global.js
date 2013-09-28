function toggleInstructions() {
    $('#readme').slideToggle();
    if ($('#toggle-instructions')[0].innerHTML == "Hide Instructions")
        $('#toggle-instructions')[0].innerHTML = "Show Instructions";
    else
        $('#toggle-instructions')[0].innerHTML = "Hide Instructions";
}

function setInstructions(value) {
    $('#readme-text').html(value);
}
