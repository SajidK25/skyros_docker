/**
 *
 * @$loginForm {id -> myLoginForm}
 * Contains the login form element
 *
 * @$registerForm {id -> myRegisterForm}
 * Contains the register form element
 *
 * @$forgotForm {id -> myForgotForm}
 * Contains the forgot form element
 *
 * @$generalFormError {class -> alert-msg}
 * Contains the class of the general error place in the form
 *
 * @$inputFormError {class -> error-message}
 * Contains the class of the input error place in the form
 *
 * @checkInputs (type: contains the type of the input, value: contains the value of the input)
 * Checks if input is empty and other checks by the type
 *
 * @mySubmitFunction
 * Runs when the form is submitted
 *
 * Informations:
 * In order to use this module you have to call it on the pages
 * that contains Login Form or Register Form or Forgot Form.
 *
 * Forms must have, except the correct ids, the bellow attributes:
 *  -action: The Post Url.
 *  -data-error: The message that it will be visible if there is an error.
 *  -data-success: The message that it will be visible if submit is successful.
 *
 * Required Inputs must have the bellow:
 *  -`required` class: in order to be checked by checkInputs function
 *  -data-type attribute {email,text,etc}: the type of the input for the correct check
 *  -data-error attribute: The message that it will be visible bellow input if something goes wrong
 *
 */

var LoReFo = (function () {

    var $loginForm;
    var $registerForm;
    var $forgotForm;
    var $profileForm;
    var $generalFormError = '.alert-msg';
    var $inputFormError = '.error-message';

    function checkInputs(type,value){


        if(value!=''){

            if(type=='email'){
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value))
                {
                    return {'error': false,'type': type};
                }

                return {'error': true,'type': type};

            } else {

                return {'error': false,'type': 'error'};

            }

        }

        return {'error': true,'type': 'error'};

    }

    function mySubmitFunction(e){
        e.preventDefault();

        var form = $(this);
        form.find($generalFormError).text('');
        var checkInput = 0;

        form.find('.required').each(function(){

            var input = $(this);
            input.parent().find($inputFormError).remove();
            var check = checkInputs( input.data('type') , input.val() );

            if( !check.error ){

            } else {

                checkInput = 1;
                input.after('<span class="' + $inputFormError.replace('.','') + '">' + input.data(check.type) + '</span>')

            }

        });

        if( checkInput == 0 ){

            var post = $.post( form.attr('action') , form.serialize(), {},'json' );

            post.done(function(data){
                console.log(data);
                if(data.error==false){
                    form.find($generalFormError).html( form.data('success') );
                    if(form.attr('data-reload')==1) {
                        setTimeout(function () {
                             window.location.reload(true);
                             window.location.replace('/');
                        }, 2000)
                    }
                } else {
                    form.find($generalFormError).text( form.data('error') );
                }
            });

        }
    }

    function initialize() {

        if($('#myLoginForm').length>0){
            $loginForm = $('#myLoginForm');
            $loginForm.on('submit', mySubmitFunction );
            console.log('Login initialized');
        }

        if($('#myRegisterForm').length>0){
            $registerForm = $('#myRegisterForm');
            $registerForm.on('submit', mySubmitFunction );
            console.log('Register initialized');
        }

        if($('#myForgotForm').length>0){
            $forgotForm = $('#myForgotForm');
            $forgotForm.on('submit', mySubmitFunction );
            console.log('Forgot initialized');
        }

        if($('#myProfileForm').length>0){
            $profileForm = $('#myProfileForm');
            $profileForm.on('submit', mySubmitFunction );
            console.log('Profile initialized');
        }


    }

    return {
        init: initialize
    }

})();