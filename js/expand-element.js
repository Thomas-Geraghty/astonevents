$('.loginButton').click( function(event){
    event.stopPropagation();
    $('#loginDropdown').toggle(200);
});

$('#loginDropdown').click( function(event){
    event.stopPropagation();
    $('#loginDropdown').show();
});

$(document).click( function(){
    $('#loginDropdown').hide();
});