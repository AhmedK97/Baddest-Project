(function ($) {
    $.fn.toast = function (options) {
        var settings = $.extend(
            {
                type: "normal",
                message: null,
            },
            options
        );

        var item = $(
            '<div class="notification ' +
                settings.type +
                '"><span>' +
                settings.message +
                "</span></div>"
        );
        this.append($(item));
        $(item).animate({ right: "12px" }, "fast");
        setInterval(function () {
            $(item).animate({ right: "-400px" }, function () {
                $(item).remove();
            });
        }, 1000);
    };

    $(document).on("click", ".notification", function () {
        $(this).fadeOut(400, function () {
            $(this).remove();
        });
    });
})(jQuery);

// $("#toast").toast({
//     message: "This is a toast message",
// });

$("#toast").toast({
    type: "success",
    message: "Success",
});

// $("#toast").toast({
//     type: "error",
//     message: "Error message",
// });
