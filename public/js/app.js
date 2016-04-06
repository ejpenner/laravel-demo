/**
 * Created by Eric on 1/26/2016.
 */
$(document).ready(function(){
    $(window).scroll(function() {
        var x = $(this).scrollTop();
        $('#main').css('background-position', '100% ' + parseInt(-x / 4) + 'px' + ', 0% ' + parseInt(-x / 4) + 'px, center top');
    });
});
