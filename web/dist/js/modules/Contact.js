var Contact = (function () {


    var $contactForm;
    var ajaxResponseSelector = '.errors'; // used inside a form to display the response by ajax

    function onSubmitContactForm(e) {

        console.log('contact initialized2');

        e.preventDefault();

        var $form = $(this);
        var toUrl = $form.attr('action');
        var valid = true;
        $form.find('.required').each(function(){
            if($(this).val()==''){

                $(this).css('border', '1px solid red' );
                valid = false;

            } else {

                $(this).css('border', '1px solid #eee' );

            }
        });

        if ( valid && !$form.data('postingForm')) {

            //set the data postingForm to form to prevent the multiple submit from user while expecting the response
            $form.data('postingForm', true);

            var posting = $.post( toUrl, $form.serialize(), {}, "json");
            var $ajaxResponse = $form.find(ajaxResponseSelector);
            posting.done(function(data) {
                console.log(data,'done');
                // grecaptcha.reset();
                if (data.error) {
                    if ($ajaxResponse.length) {
                        $ajaxResponse.html('<div class="errorMessage">' + data.error + '</div>').fadeIn();
                    }


                } else if ( data.success ) {
                    if ($ajaxResponse.length) {
                        $ajaxResponse.html('<div class="successMessage">' + data.success + '</div>').fadeIn();
                    }

                    $form.find('.formInput').val('');

                }
                $form.data('postingForm', false);


            });

        }
    }
    function contactSubmit(token) {
        $contactForm.submit();

    }


    function initialize() {


        $contactForm = $('#contactForm');

        $contactForm.on('submit', onSubmitContactForm);
        console.log('contact initialized');

    }

    return {
        init : initialize,
        onSubmit: contactSubmit
    }



})();