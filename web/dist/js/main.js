// initializing libraries
$( document ).ready(function() {
    // scroll to top
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#top").offset().top
    }, 100);
    // load svg logo on load
    $('#logo_white img').css({'width': '100%', 'transition': '0.5s'});
    //initialize wow
    new WOW().init();
    // scroll to top button
    if (document.getElementById("myBtn")) {
        var mybutton = document.getElementById("myBtn");
        //console.log(maxSize);
        window.onscroll = function() {scrollFunction()};
        function scrollFunction() {
    //  if document is scrolled more than 20px
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                mybutton.style.display = "block";
                $('#mainNav').addClass('bg-blue');
                $('#header').addClass('shadowb');
                $('.arrows').addClass('hidden');
                $('#logo_white img').css({'width': '50%', 'transition': '0.5s'});
    // restore defaults
            } else {
                mybutton.style.display = "none";
                $('#mainNav').removeClass('bg-blue');
                $('#header').removeClass('shadowb');
                $('.arrows').removeClass('hidden');
                $('#logo_white img').css({'width': '100%', 'transition': '0.5s'});
            }
        }
    }
    $("#go").click(function() {
        $('html,body').animate({
                scrollTop: $("#main").offset().top},
            'slow');
    });
    // hide loader image
    $(".se-pre-con").fadeOut(1000);
    console.log('document ready');
});
//for top button
function topFunction() {
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#top").offset().top
    }, 2000);
}

$(".navbar-toggler").click(function () {
    $('#navbarSupportedContent').toggleClass('showNav');
});

function showpopmodal()
{
    var d = new Date();
    var n = d.getDate()
    localStorage.setItem("isftime",1)
    localStorage.setItem("isftimet",n)

    $("#mypopupvideo iframe").attr("src","https://www.youtube.com/embed/cmKN4jcppnU?autoplay=1")

    setTimeout(function () {
        $("#mypopuplayer").fadeIn();
        $("#mypopupvideo").fadeIn();

        $("#mypopupclose").click(function () {
            $("#mypopuplayer").fadeOut();
            $("#mypopupvideo").fadeOut();
            $("#mypopupvideo iframe").attr("src","")
        })

        $("#mypopuplayer").click(function () {
            $("#mypopuplayer").fadeOut();
            $("#mypopupvideo").fadeOut();
            $("#mypopupvideo iframe").attr("src","")
        })

    }, 1000);
}




function showpopmodal()
{
    var d = new Date();
    var n = d.getDate()
    localStorage.setItem("isftime",1)
    localStorage.setItem("isftimet",n)

    $("#mypopupvideo iframe").attr("src","https://www.youtube.com/embed/cmKN4jcppnU?autoplay=1")

    setTimeout(function () {
        $("#mypopuplayer").fadeIn();
        $("#mypopupvideo").fadeIn();

        $("#mypopupclose").click(function () {
            $("#mypopuplayer").fadeOut();
            $("#mypopupvideo").fadeOut();
            $("#mypopupvideo iframe").attr("src","")
        })

        $("#mypopuplayer").click(function () {
            $("#mypopuplayer").fadeOut();
            $("#mypopupvideo").fadeOut();
            $("#mypopupvideo iframe").attr("src","")
        })

    }, 1000);
}


