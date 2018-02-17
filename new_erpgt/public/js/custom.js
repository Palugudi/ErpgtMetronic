$(document).ready(function(){
    var $window = $(window);
    //$('#section-1').css('height',$('#section-1').scrollTop()+$window.height());

    // Animations
    var $animation_elements = $('.animated');
    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');

    // scroll to
    $("a.page-scroll").click(function(e){
        $("html, body").stop().animate({
            scrollTop: $($(this).attr("href")).offset().top - 50
        },850,"linear");
        e.preventDefault();
    })

    // affix navbar
    if ($(window).width() > 700){
        $("body").scrollspy({
            target:".fixed-top",
            offset:51
        });
        // navbar fix
        $window.on('scroll', function(){
            var scrollValue = $(window).scrollTop();
            if (scrollValue > 100) {
                 $('#mainNav').addClass('affix');
            } else if(scrollValue < 100) {
                $('#mainNav').removeClass('affix');
            }
        });
        // $("#mainNav").affix({
        //     offset:{top:100}
        // });
    }

    // navbar toggle
    // $(".navbar-collapse ul li a").click(function(){
    //     $(".navbar-toggle:visible").click()
    // });


    // Animation checking
    function check_if_in_view() {
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);

        $.each($animation_elements, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
              $element.addClass('in-view');
            } else {
              $element.removeClass('in-view');
            }
        });
    }
});