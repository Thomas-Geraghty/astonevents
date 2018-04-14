$(".header").click(function () {
    //getting the next element
    $content = $(this).next();
    //checking if its already visible
        //open up the content needed
        $content.slideToggle(500);
});
