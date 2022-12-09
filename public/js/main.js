$(document).ready(function () {
    var token = document.getElementsByName("csrf-token")[0].content;
    var currentURL = $(location).attr("href");
    var currentURL = window.location.href;
    var url = currentURL;

    window.onbeforeunload = function (e) {
        localStorage.setItem("scrollpos", window.scrollY);
    };
    $(window).on("load", function () {
        setTimeout(removeLoader, 300); //wait for page load PLUS two seconds.
    });

    function removeLoader() {
        $("#spinnerLoading").css("display", "none");
    }

    function refresh() {
        $("#notsdiv").load(location.href + " #notsdiv");
    }
    function JSalert() {
        swal("Congrats!", ", Your account is created!", "success");
    }

    $("#mySelect").on("change", function () {
        swal({
            title: "Successful",
            text: "Loading...",
            icon: "https://www.boasnotas.com/img/loading2.gif",
            buttons: false,
            closeOnClickOutside: false,
            timer: 1000,
            icon: "success",
        });
        var value = $(this).val();
        if (value) {
            $("#reloadall").load(location.href + " #reloadall");
        }
        var hashid = url.substring(url.indexOf("/") + 32);

        var data = {
            _method: "PATCH",
            _token: token,
            status: value,
        };

        $.ajax({
            url: hashid,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            type: "PATCH",
            data: data,
            success: function (data, textStatus, jQxhr) {},
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            },
        });
        $("#reloadall").load(location.href + " #reloadall");
    });
});

$(function () {
    $("#datepicker").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast",
    });
});

/* Please ❤ this if you like it! */

(function ($) {
    "use strict";

    $(function () {
        var header = $(".start-style");
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 10) {
                header.removeClass("start-style").addClass("scroll-on");
            } else {
                header.removeClass("scroll-on").addClass("start-style");
            }
        });
    });

    //Animation

    $(document).ready(function () {
        $("body.hero-anime").removeClass("hero-anime");
    });

    //Menu On Hover

    $("body").on("mouseenter mouseleave", ".nav-item", function (e) {
        if ($(window).width() > 750) {
            var _d = $(e.target).closest(".nav-item");
            _d.addClass("show");
            setTimeout(function () {
                _d[_d.is(":hover") ? "addClass" : "removeClass"]("show");
            }, 1);
        }
    });

    //Switch light/dark

    $("#switch").on("click", function () {
        if ($("body").hasClass("dark")) {
            $("body").removeClass("dark");
            $("#switch").removeClass("switched");
        } else {
            $("body").addClass("dark");
            $("#switch").addClass("switched");
        }
    });
})(jQuery);



