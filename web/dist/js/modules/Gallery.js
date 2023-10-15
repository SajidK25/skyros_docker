var Gallery = (function () {

    var $body;
    var $loadMoreButton;
    var $myGallery;

    function createLightGallery() {
        $myGallery.lightGallery({
            selector: '.item'
        });
    }

    function loadMoreGallery() {


        var button = $(this);
        console.log(button);
        var _this = $('body').find('#gallery');
        // var _items = parseInt(_this.attr('data-items'));
        var _step = parseInt(button.attr('data-step'));
        var _allitems = parseInt(button.attr('data-items'));
        var _page = parseInt(button.attr('data-page'));

        var _items = ( _page + 1 ) * _step;

        console.log(_items >= _allitems,_items , _allitems);
        if(_items >= _allitems){
            $loadMoreButton.hide();
        }

        var loadMore = $.post('/gallery/load_more', {
            "step": _step,"page": _page,"items": _items, "max_items": _allitems
        }, {}, 'json');
        loadMore.done(function (data) {


            if (data.error == false) {

                button.attr('data-page', _page + 1);

                $('.se-pre-con').show();

                $.each(data.img_gallery, function (i, item) {
                    //console.log( index + ": " + $( this ).text() );

                    _this.append(
                        "<div class='col-md-3 item' data-src='https://media.skiros.gr/images/0/0/" + item + "'><a href='https://media.skiros.gr/images/0/0/" + item + "'> <img src='https://media.skiros.gr/images/0/400/" + item + "' class='img-fluid maxwidth img-items' alt=''> </a> </div>"
                    )

                });

                $(".se-pre-con").fadeOut(1000);


                //initialize light gallery
                if ($myGallery.data("lightGallery")) {
                    $myGallery.data("lightGallery").destroy(true);
                }
                createLightGallery();

            }


        });


    }

    function initialize() {

        //initialize light gallery
        $body = $('.body');
        $myGallery = $('.lightgallery');
        $loadMoreButton = $('button#loadMore');
        // loadMoreGallery();
        $loadMoreButton.on("click", loadMoreGallery);

        $loadMoreButton.click();

        console.log('Gallery Init');

    }

    return {
        init: initialize
    }


})();