function addEventView() {
    var $html = "<form id='event_create' enctype='multipart/form-data' method='POST'>" +
        "<table class='table'>" +
        "<tr><td><h4 class='label'>Event name:</h4></td> <td><input name='event_name' class='form' type='text' required maxlength='255'></td></tr>" +
        "<tr><td><h4 class='label'>Event type:</h4></td> <td><select name='event_type' class='form' required > <option value='Sport'>Sport</option> <option value='Culture'>Culture</option> <option value='Other'>Other</option></td></tr>" +
        "<tr><td><h4 class='label'>Event date/time:</h4></td> <td><input name='event_time' class='form' type='datetime-local' required></td></tr>" +
        "<tr><td><h4 class='label'>Event location:</h4></td> <td><input name='event_location' class='form' type='text' required></td></tr>" +
        "<tr><td><h4 class='label'>Event description:</h4></td> <td><textarea style='height: 100px' name='event_description' class='form'></textarea></td></tr>" +
        "<tr><td><h4 class='label'>Event Photo 1:</h4></td> <td> <input name='event_image1' type='file' accept='image/*'\></td> </tr>" +
        "<tr><td><h4 class='label'>Event Photo 2:</h4></td> <td> <input name='event_image2' type='file' accept='image/*'\></td> </tr>" +
        "<tr><td><h4 class='label'>Event Photo 3:</h4></td> <td> <input name='event_image3' type='file' accept='image/*'\></td> </tr>" +
        "<input type='hidden' name='event_submit' value='1'/>" +
        "<tr><td><input type='submit' class='linkButton' value='Add Event'></td></tr>" +
        "</table>" +
        "</form>";
    document.getElementById('eventView').innerHTML = $html;
    document.getElementById('eventTitle').textContent = 'Add new event';
}

function displayAllEvents() {
    $.get('php/view/EventView.php', {'request_type': '1'}, function (data) {
        var obj = JSON.parse(data);
        document.getElementById('eventView').innerHTML = "<h2 id='eventTitle' class='title'>All events</h2>" + generateTable(obj);
    });

    document.getElementById('eventTitle').textContent = 'View events';
}

function generateTable($records) {
    var $html = "<table id='eventsTable' class='table'>" +
        "<tr class='table-header'> " +
            "<th onclick='sortTable(0)'>Event name</th> <th onclick='sortTable(1)'>Event type</th> " +
            "<th onclick='sortTable(2)'>Event date/time</th> <th onclick='sortTable(3)'>Event location</th> " + "<th onclick='sortTable(4)'>Event likes</th>" +
        "</tr>";
    for(var i = 0; i < $records.length; i++) {
        $html +=
            "<tr class='table-row eventRow' onclick='accessEvent(" + $records[i].id + ")'>"  +
                "<td>" + $records[i].event_name + "</td>" + "<td>" + $records[i].event_type + "</td>" +
                "<td>" + $records[i].event_time + "</td>" + "<td>" + $records[i].event_location + "</td>" + "<td>" + $records[i].event_likes + "</td>" +
            "</tr>";
    }
    $html += "</table>";

    return $html;
}

function displayMyEvents($userID) {
    $.get('php/view/EventView.php', {'request_type': '2', 'user_ID': $userID}, function (data) {
        var obj = JSON.parse(data);
        var $html = generateTable(obj) + "<a class='button' onclick='addEventView()'>Add Event</a>";
        document.getElementById('eventView').innerHTML = $html;
    });
    document.getElementById('eventTitle').textContent = 'Your events';
}

function accessEvent($eventID) {
   window.location.href('events.php?eventID='+$eventID);
}

function displayEvent($eventID, $userID) {
    $.get('php/view/EventView.php', {'request_type': '3', 'event_ID': $eventID}, function (data) {
        var obj = JSON.parse(data);
        if(obj == false) {
            document.getElementById('eventTitle').textContent = "404 - Event does not exist.";
            var $html =
                "<p>No event with ID (# " + $eventID + ").</p>" +
                "<p>Check link for errors.</p>";

            document.getElementById('eventView').innerHTML = $html;
        } else {
            var $html = "";

            if(obj.event_organiser == $userID) {
                $html +=
                    "<h2 id='eventTitle' class='title'>" + obj.event_name + "</h2>" +
                    "<div id='eventOptions'>" +
                        "<h4 style='float: right; background-color: #c12626' class='button' onclick='deleteEvent(" + obj.id + ")'>Delete Event</h4>" +
                        "<h4 style='float: right;' class='button' onclick='editEvent(" + obj.id + ")'>Edit Event</h4>" +
                    "</div>";
            } else {
                $html +=
                    "<h2 id='eventTitle' class='title'>" + obj.event_name + "</h2>" +
                    "<div id='eventOptions'>" +
                        "<h4 style='float: right; background-color: green' class='button' onclick='like(" + $eventID + ")'>Like 👍</h4>" +
                    "</div>";
            }

            $html +=
                "<table style='width: 100%' class='eventInfoTable'>" +
                    "<tr><td>Event Name:</td> <td>" + obj.event_name + "</td></tr>" +
                    "<tr><td>Event Type:</td> <td>" + obj.event_type + "</td></tr>" +
                    "<tr><td>Event Time:</td> <td>" + obj.event_time + "</td></tr>" +
                    "<tr><td>Event Location:</td> <td>" + obj.event_location + "</td></tr>" +
                "</table>" +
                "<div style='display: inline-block; width: 50%; float: left' class='eventInfoDescription'>" +
                    "<h3>Description</h3>" +
                    "<p style='padding-right: 50px'>" + obj.event_description + "</p>" +
                "</div>" +
                "<div style='display: inline-block; width: 30%;' class='eventInfoDescription'>" +
                    "<h3>Contact</h3>" +
                    "<table style='margin: 13px 0 16px 0'>" +
                        "<tr><td>Organiser: </td> <td>" + obj.first_name + " " + obj.last_name + "</td></tr>" +
                        "<tr><td>Phone: </td> <td>" + obj.phone + "</td></tr>" +
                        "<tr><td>Email: </td> <td> <a class='content-link' href='mailto:" + obj.email +"'>" + obj.email + "</a></td></tr>" +
                    "</table>" +
                "</div>" +
            "<div>";
            for (i = 0; i < obj.photos.length; i++) {
                $html += "<img class='eventPhoto' src='" + obj.photos[i]['file_location'] + "'>";
            }
            $html += "</div>";
            document.getElementById('eventView').innerHTML = $html;
        }
    });
}

function like($event_ID) {
    $.post('php/controller/event/Events.php', {'event_id': $event_ID, 'event_like' : true}, function (data) {
        alert(data);
    });
}

function editEvent($eventID) {
    $.get('php/view/EventView.php', {'request_type': '3', 'event_ID': $eventID}, function (data) {
        var obj = JSON.parse(data);
        if(obj == false) {
            document.getElementById('eventTitle').textContent = "404 - Event does not exist.";
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
                        "<button style='float: right; background-color: #c12626' class='button'>Cancel</button>" +
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

function sortTable(columnNumber) {
    var tableElement, rows, switching, shouldSwitch, i, x, y, direction, switchcount = 0;
    switching = true;
    direction = "asc";
    tableElement = document.getElementById("eventsTable");

    while (switching) {
        switching = false;
        rows = tableElement.getElementsByTagName("tr");

        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[columnNumber];
            y = rows[i+1].getElementsByTagName("td")[columnNumber];
            if (direction === "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch= true;
                    break;
                }
            } else if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch= true;
                    break;
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;
        } else if (switchcount === 0 && direction === "asc") {
                direction = "desc";
                switching = true;
        }
    }
}

function deleteEvent($eventID) {
    if(confirm("Do you want to delete this event?")) {
        $.post('php/controller/event/Events.php', {'event_delete': true,'event_ID': $eventID}, function (data) {
            window.location.href('events.php');
        });
    }
}