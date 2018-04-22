function myFunction() {

    $(document).on("click", function () {
        var clickedBtnID = $(this).attr('id'); // or var clickedBtnID = this.id
        alert('you clicked on button #' + clickedBtnID);
        $(this).innerText('lol');
    });

    document.getElementById('eventTitle').textContent='newtext';
}

