$(function() {
    $('.fader').addClass('fade');
    $('.fader').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
        $('.fader').remove();
    });
});