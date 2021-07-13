function addBook(bookId) {


    jQuery.ajax({
        beforeSend: (xhr) => {
            xhr.setRequestHeader('X-WP-nonce', goodreadsData.nonce);
        },
        url: `${goodreadsData.root_url}/wp-json/books/v1/manageBooklist`,
        type: 'POST',
        data: { "list_book": bookId },
        success: (response) => {

            console.log(response)
        },
        error: (response) => {
            console.log('sorry');
            console.log(response)
        }

    })

}

var video1 = document.getElementsByClassName('video-1');
var video2 = document.getElementsByClassName('video-2');
var video3 = document.getElementsByClassName('video-3');



function imgTransition() {
    video1.play();
    video1.style.opacity = 1;
}
video1.onended = function() {
    video2.play();
    video1.style.opacity = 0;
    video2.style.opacity = 1;
}
video2.onended = function() {
    video3.play();
    video2.style.opacity = 0;
    video3.style.opacity = 1;
}
video3.onended = function() {
    video3.style.opacity = 0;
    imagen1.style.opacity = 1;
    window.setTimeout(imgTransition, 5000);
}

jQuery(function($) {

    $('.add_to_list').prop('disabled', false);
    $('.add_to_list').click(function(e) {
        if ($(this).data("exists") == "yes") {
            alert('data already added')
        } else {
            var pos = $(this).data("id")
            addBook(pos)
            $(this).prop('disabled', true);
            $(this).text('book added');



        }
    });

    $('.my-reviews-form').hide();
    $(".open_review_form").click(() => {
        $(".my-reviews-form").slideToggle('slow');
        if ($('.open_review_form').text() == 'Close Review') {
            $('.open_review_form').text('Add Review');
        } else {
            $('.open_review_form').text('Close Review');
        }
    })



    $('#next_nav').click(function() {
        $("#itemslider").animate({
            scrollLeft: '-=200px'
        });
    });
    $('#prev_nav').click(function() {
        $("#itemslider").animate({
            scrollLeft: '+=200px'
        });
    });

});