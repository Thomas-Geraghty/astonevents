function addEventView() {
    $html = "<form id='event_create' method='POST'>" +
        "<table class='table'>" +
        "<tr><td><h4 class='label'>Event name:</h4></td> <td><input name='event_name' class='form' type='text' required maxlength='255'></td></tr>" +
        "<tr><td><h4 class='label'>Event type:</h4></td> <td><select name='event_type' class='form' required > <option value='Sport'>Sport</option> <option value='Culture'>Culture</option> <option value='Other'>Other</option></td></tr>" +
        "<tr><td><h4 class='label'>Event date/time:</h4></td> <td><input name='event_time' class='form' type='datetime-local' required></td></tr>" +
        "<tr><td><h4 class='label'>Event location:</h4></td> <td><input name='event_location' class='form' type='text' required></td></tr>" +
        "<tr><td><h4 class='label'>Event description:</h4></td> <td><input name='event_description' class='form' type='text'></td></tr>" +
        "<tr><td><input type='submit' class='linkButton' value='Add Event'></td></tr>" +
        "</table>" +
        "<input type='hidden' name='newEvent_submit' value='1'/>" +
        "</form>";
    document.getElementById('eventView').innerHTML=$html;
    document.getElementById('eventTitle').textContent='Add New Event';
}