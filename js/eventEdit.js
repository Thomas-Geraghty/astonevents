function addEvent() {
    var $html = "<form id='event_create' enctype='multipart/form-data' href='php/view/events.php' method='POST'>" +
        "<table class='table'>" +
        "<tr><td><h4 class='label'>Event name:</h4></td> <td><input name='event_name' class='form' type='text' required maxlength='255'></td></tr>" +
        "<tr><td><h4 class='label'>Event type:</h4></td> <td><select name='event_type' class='form' required > <option value='Sport'>Sport</option> <option value='Culture'>Culture</option> <option value='Other'>Other</option></td></tr>" +
        "<tr><td><h4 class='label'>Event date/time:</h4></td> <td><input name='event_time' class='form' type='datetime-local' required></td></tr>" +
        "<tr><td><h4 class='label'>Event location:</h4></td> <td><input name='event_location' class='form' type='text' maxlength='512' required></td></tr>" +
        "<tr><td><h4 class='label'>Event description:</h4></td> <td><textarea style='height: 100px' name='event_description' class='form'></textarea></td></tr>" +
        "<tr><td><h4 class='label'>Event Photo 1:</h4></td> <td> <input name='event_image1' type='file' accept='image/*'\></td> </tr>" +
        "<tr><td><h4 class='label'>Event Photo 2:</h4></td> <td> <input name='event_image2' type='file' accept='image/*'\></td> </tr>" +
        "<tr><td><h4 class='label'>Event Photo 3:</h4></td> <td> <input name='event_image3' type='file' accept='image/*'\></td> </tr>" +
        "<input type='hidden' name='event_submit' value='1'/>" +
        "<tr><td><input type='submit' class='linkButton' value='Add Event'></td></tr>" +
        "</table>" +
        "</form>";
    $('#event-table').html($html);
    $('#event-view-selectors').fadeOut(150);
    $('#event-category-selectors').slideUp(150);
    $('#add-event-button').hide();
    document.getElementById('eventTitle').textContent = 'Add new event';
}

function editEvent($eventID) {
    $.get('/php/controller/event/Events.php', {'request_type': '3', 'event_ID': $eventID}, function (data) {
        var obj = JSON.parse(data);
        if(obj == false) {
            window.location.href('error.php?e=404');
            var $html =
                "<p>No event with ID (# " + $eventID + ").</p>" +
                "<p>Check link for errors.</p>";
            document.getElementById('eventView').innerHTML = $html;
        } else {
            var $html;
            $html =
                "<form method='POST'>" +
                "<h2 id='eventTitle' class='title'>Editing: " + obj.event_name + "</h2>" +
                "<div id='eventOptions'>" +
                "<button style='float: right; background-color: #c12626' class='button' onclick='accessEvent(" + $eventID + ")'>Cancel</button>" +
                "<button style='float: right; background-color: green' class='button' type='submit'>Save changes</button>" +
                "</div>" +
                "<table style='width: 100%' class='eventInfoTable'>" +
                "<tr><td>Event Name:</td> <td> <input name='event_name' class='form' type='text' required value='" + obj.event_name + "'></td></tr>" +
                "<tr><td>Event Type:</td> <td> <select name='event_type' class='form' required value='" + obj.event_type + "'> <option value='Sport'>Sport</option> <option value='Culture'>Culture</option> <option value='Other'>Other</option></td></tr>" +
                "<tr><td>Event Time:</td> <td> <input name='event_time' class='form' type='datetime-local' required value='" + obj.event_time + "'></td></tr>" +
                "<tr><td>Event Location:</td> <td> <input name='event_location' class='form' type='text' required value='" + obj.event_location + "'></td></tr>" +
                "</table>" +
                "<div style='display: inline-block; width: 50%; float: left' class='eventInfoDescription'>" +
                "<h3>Description</h3>" + "<textarea name='event_description' style='display: block; width: 90%' class='form'>" + obj.event_description + "</textarea>" +
                "</div>" +
                "<div style='display: inline-block; width: 30%;' class='eventInfoDescription'>" +
                "<h3>Contact</h3>" +
                "<table style='margin: 13px 0 16px 0'>" +
                "<tr><td>Organiser: </td> <td>" + obj.first_name + " " + obj.last_name + "</td></tr>" +
                "<tr><td>Phone: </td> <td>" + obj.phone + "</td></tr>" +
                "<tr><td>Email: </td> <td> <a class='content-link' href='mailto:" + obj.email +"'>" + obj.email + "</a></td></tr>" +
                "</table>" +
                "</div>" +
                "<input type='hidden' name='id' value='" + obj.id + "'/>" +
                "<input type='hidden' name='event_edit' value='1'/>" +
                "</form>";
            document.getElementById('eventTitle').textContent = "Editing event";
            document.getElementById('eventView').innerHTML = $html;
        }
    });
}

function deleteEvent($eventID) {
    if(confirm("Do you want to delete this event?")) {
        $.post('/php/controller/event/Events.php', {'event_delete': true,'event_ID': $eventID}, function (data) {
            window.location.href('events.php');
        });
    }
}