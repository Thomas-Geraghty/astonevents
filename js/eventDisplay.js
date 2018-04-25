function displayEvent($eventID, $userID) {
    $.get('php/view/EventView.php', {'request_type': '3', 'event_ID': $eventID}, function (data) {

        var obj = JSON.parse(data);
        var $html = "";

        //Event doesn't exist
        if(obj == false) {
        } else {
            // EDIT/DELETE button
            if(obj.event_organiser == $userID) {
                $html +=
                    "<h2 id='eventTitle' class='title'>" + obj.event_name + "</h2>" +
                    "<div id='eventOptions'>" +
                    "<h4 style='float: right; background-color: #c12626' class='button' onclick='deleteEvent(" + obj.id + ")'>Delete Event</h4>" +
                    "<h4 style='float: right;' class='button' onclick='editEvent(" + obj.id + ")'>Edit Event</h4>" +
                    "</div>";
            }
            // LIKE button
            else {
                $html +=
                    "<h2 id='eventTitle' class='title'>" + obj.event_name + "</h2>" +
                    "<div id='eventOptions'>" +
                    "<h4 style='float: right; background-color: green' class='button' onclick='likeEvent(" + $eventID + ")'>Like 👍</h4>" +
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
            $('#event-table').html($html);
        }
    });
}

function selectedEventView($id, $userID) {
    $('#event-view-selectors').children('.selectable-title').addClass('unselected');
    $('#' + $id).removeClass('unselected').addClass('selected');

    if($id === 'all-events-label') {
        $.get('php/view/EventView.php', {'request_type': '1'}, function (data) {
            var $table = generateTable(JSON.parse(data));
            $('#event-table').html($table);
        });
    }

    if($id === 'my-events-label') {
        $.get('php/view/EventView.php', {'request_type': '2', 'user_ID': $userID}, function (data) {
            var $table = generateTable(JSON.parse(data));
            $('#event-table').html($table);
        });
    }
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

function filterTable($category) {
    var tableElement, rows;
    tableElement = document.getElementById("eventsTable");

    rows = tableElement.getElementsByTagName("tr");

    for (var i = 0; i < rows.length; i++) {
        rows[i].style.display = '';
        var $rowElements = rows[i].getElementsByTagName('td');
        if($category !== 'All' && $rowElements.length) {
            if($rowElements[1].textContent !== $category) {
                rows[i].style.display = 'none';
            }
        }
    }
}

function sortTable($columnNumber) {
    var tableElement, rows, switching, shouldSwitch, i, x, y, direction, switchcount = 0;
    switching = true;
    direction = "asc";
    tableElement = document.getElementById("eventsTable");

    while (switching) {
        switching = false;
        rows = tableElement.getElementsByTagName("tr");

        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[$columnNumber];
            y = rows[i+1].getElementsByTagName("td")[$columnNumber];
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

function accessEvent($eventID) {
    window.location.href('events.php?eventID='+$eventID);
}

function likeEvent($event_ID) {
    $.post('php/controller/event/Events.php', {'event_id': $event_ID, 'event_like' : true}, function (data) {
    });
}
