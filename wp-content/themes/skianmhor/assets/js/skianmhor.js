jQuery(document).ready(function ($) {
    var flipboxes = $('.home .fusion-flip-box');
    flipboxes.each(function () {
        var link = $(this).find('a');
        if (link.length === 1) {
            $(this).on('click', function () {
                window.location = link.attr('href');
            });
        }
    });
    if (typeof revapi1 !== 'undefined') {
        revapi1.bind('revolution.slide.onloaded', function () {
            var flipboxes = $('.home .fusion-flip-box');
            flipboxes.each(function (i) {
                if (undefined !== revapi1) {
                    $(this).on('hover', function () {
                        revapi1.revshowslide(i + 1);
                    });
                }
            });
        });
    }
});