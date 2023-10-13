var Home = (function(){


    //console.log("HOME");

    var $formaEndiaferontos;
    var ekdilosiEndiaferontosButton = 'ekdilosi_endiaferontos_button';

    function ekdilosiEndiaferontos(e){

        e.preventDefault();

        $('#success_alert').hide();
        $('#warning_alert').hide();
        var _this = $(this);
        var fields = _this.serializeArray();
        var action = _this.attr('action');
        var myFields = [];
        var required=["fee_fname","fee_lname","fee_phone"];
        var error = false;

        for(var i = 0; i<fields.length;i++){

            myFields[fields[i]['name']] = fields[i]['value'];

            if(required.includes(fields[i]['name']) && fields[i]['value']==''){

                error = fields[i]['name'];
            }

        }
        console.log(myFields);



        if( error == 0 && myFields['fee_gdpr'] == 'on' ){

            var posting = $.post(action,_this.serialize(),[],'json');
            posting.done(function(data){
                console.log(data);
                if(data.error){

                    $('#warning_alert').html( data.message );

                    $('#warning_alert').show();

                    setTimeout(function(){
                        $('#warning_alert').hide();
                    },2500);

                } else {

                    $('#success_alert').html(data.message);

                    $('#success_alert').show();

                    _this.trigger('reset');

                    setTimeout(function(){
                        $('#exampleModal3').modal('hide');
                    },2000);

                }

            });

        } else {

            $('#warning_alert').html( error );

            $('#warning_alert').show();

        }

    }

    function initialize() {

        $('#success_alert').hide();
        $('#warning_alert').hide();
        $formaEndiaferontos = $('#formaEndiaferontos');

        $formaEndiaferontos.on('submit',ekdilosiEndiaferontos);

        if ($(window).width() < 1024) {
            $('.slider1 .item').each(function(){
                var img = $(this).find('img');
                var image = img.data('image');
                var mobile = img.data('imagemobile');

                img.attr('src',mobile);

            })
        } else {
            $('.slider1 .item').each(function(){
                var img = $(this).find('img');
                var image = img.data('image');
                var mobile = img.data('imagemobile');

                img.attr('src',image);

            })
        }

        $(window).on('load', function(){
            $('.dragon-loader').hide();
        });
        console.log('Home Init');

    }

    return {
        init : initialize
    }


})();