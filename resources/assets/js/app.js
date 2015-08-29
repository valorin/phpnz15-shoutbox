$(function() {

    // Pop shout off end of array and render
    var popShout = function (shouts) {
        // Nothing in the queue
        if (!shouts.length) {
            return setTimeout(updateShouts, 2000);
        }

        // Pop off last shout
        var shout = shouts.pop();

        // Already exists, pop next
        if ($('#shout-'+shout['id']).length) {
            return popShout(shouts);
        }

        // Hide empty box
        $('.conversation .empty').remove();

        // Add box to page
        var shoutBox = $.parseHTML(shout['html']);
        $(shoutBox).hide().prependTo('.conversation').slideDown(function () {
            $('.conversation').data('latest', shout['id']);
            popShout(shouts);
        });
    };

    // Update Shouts
    var updateShouts = function() {
        var lastId = $('.conversation').data('latest');
        $.ajax({
            method: 'GET',
            url: '/shouts?last='+lastId,
            dataType: 'json',
            success: popShout
        });
    };
    setTimeout(updateShouts, 1000);

    // Shoutbox Elements
    var form = $('.shoutbox form');
    var message = form.find('.message');

    // Focus on message box
    message.focus();

    // Catch submit
    form.on('submit', function (event) {

        // AJAX POST
        $.ajax({
            method: "POST",
            url: "/shout",
            data: { message: message.val() }
        });

        // Reset input and prevent page submit
        message.val('');
        event.preventDefault();
    });
});
