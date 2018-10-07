$(".loading").height($(window).height());
$(".loading").width($(window).width());


$(".loading img").css({
    paddingTop: ($(".loading").height() - $(".loading img").height()) / 2,
    paddingLeft: ($(".loading").width() - $(".loading img").width()) / 2
});

$(window).resize(function () {
    "use strict";

    $(".loading").height($(window).height());
    $(".loading").width($(window).width());

    $(".loading img").css({
        paddingTop: ($(".loading").height() - $(".loading img").height()) / 2,
        paddingLeft: ($(".loading").width() - $(".loading img").width()) / 2
    });

});
