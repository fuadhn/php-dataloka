$(document).ready(function() {
    if($('.cs-nav-menu ul li a').length) {
        $('.cs-nav-menu ul li a').click(function() {
            var _state_submenu = $(this).nextAll('ul').outerHeight();

            if(_state_submenu == 0) {
                $(this).nextAll('ul').css('height', 'auto')
            } else {
                $(this).nextAll('ul').css('height', '0')
            } 
        })
    }
})