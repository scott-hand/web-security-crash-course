var username = "";
var password = "";

function userNameChanged(input) {
    username = input;
    updateQuery();
}

function passwordChanged(input) {
    password = input;
    updateQuery();
}

/*
function updateQuery() {
    $('#query')[0].innerHTML = "select * from users where username = '" + username + "' and password = '" + password + "'";
}
*/

function toggleHelp() {
    $('#help').slideToggle();
    if ($('#hide_button')[0].innerHTML == "Hide Assistance")
        $('#hide_button')[0].innerHTML = "Show Assistance";
    else
        $('#hide_button')[0].innerHTML = "Hide Assistance";
}

