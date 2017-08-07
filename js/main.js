/**
 * Created by Bionic on 09.07.2017.
 */

// carousel hover dropdown
jQuery(function($) {
    $('.dropdown').on('mouseenter mouseleave click tap', function () {
        $(this).toggleClass("show");
    });
});