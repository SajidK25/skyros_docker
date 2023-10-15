var Content = (function(){

    var $lang;
    var $changeContent;

    function changeContent(e){

        e.preventDefault();

        var $_this = $(this);
        var caption = $_this.data('caption');

        $changeContent.removeClass('active');
        $_this.addClass('active');

        var data = $.post( $lang + '/get/content', { 'caption' : caption } ,[],'json');

        data.done(function(msg){

            console.log(msg);
            $('#content-title').text(msg.title);

            if(msg.image != '' ){

                $('#content-img').html('<img class="mainimg" src="' + msg.image + '" alt="' + msg.title + '">');

            }

            $('#content-subtitle').text(msg.subtitle);
            $('#content-descr').html(msg.description);
            $('html, body').animate({
                scrollTop: $(".breadcrumb").offset().top
            }, 1000);

        });

    }

    function initialize() {

        $lang = ($('html').attr('lang') == 'el') ? '' : '/' + $('html').attr('lang') ;

        $changeContent = $('.change-content-menu');
        $changeContent.on('click', changeContent );
        console.log('Content Init');

    }

    return {
        init : initialize
    }


})();