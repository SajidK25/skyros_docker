var Forms = (function(){

    var formValues = [];

    function submitForm(e){

        e.preventDefault();

        var _form = $(this);

        var $formId = _form.attr('id').replace('form','');

        if($formId == 1){

            submitFirstStep(_form);

        } else if($formId == 2 || $formId == 3){

            submitSecondStep(_form);

        } else if($formId == 4 || $formId == 5) {

            submitThirdStep(_form,$formId);

        } else if($formId == 6 ) {

            submitFourthStep(_form);

        } else if($formId == 7 || $formId == 8) {

            submitFifthStep(_form);

        }

    }

    function submitFifthStep(form){

        var formFields = form.serializeArray();
        formValues['step5'] = [];

        console.log(formFields);
        for (var i = 0; i < formFields.length; i++) {

            formValues['step5'][formFields[i]['name']] = formFields[i]['value'];

        }

        console.log(formValues);

    }

    function submitFourthStep(form,id) {


        var formFields = form.serializeArray();
        formValues['step4'] = [];

        console.log(formFields);
        for (var i = 0; i < formFields.length; i++) {

            formValues['step4'][formFields[i]['name']] = formFields[i]['value'];

        }

        console.log(formValues);
        changeForm(7);


    }

    function submitThirdStep(form,id) {


        var formFields = form.serializeArray();
        formValues['step3'] = [];

        var myid = 0;
        if(id == 5 && formValues['step1']['group1'] == 2){
            myid = 1;
        }

        formValues['step3'][myid] = [];

        console.log(formFields);
        for (var i = 0; i < formFields.length; i++) {

            formValues['step3'][myid][formFields[i]['name']] = formFields[i]['value'];

        }

        console.log(formValues);
        if (id == 4 && formValues['step1']['group1'] == 2){
            changeForm(5);
        } else {
            changeForm(6);
        }


    }

    function submitSecondStep(form){

        var formFields = form.serializeArray();
        formValues['step2'] = [];
        console.log(formFields);
        for(var i=0; i<formFields.length; i++){
            formValues['step2'][formFields[i]['name']] = formFields[i]['value'];
        }
        var req = [];
        if(formValues['step1']['group2']==0){

            req[req.length] = 'fp_lname';
            req[req.length] = 'fp_fname';
            req[req.length] = 'fp_adt';
            req[req.length] = 'fp_afm';
            req[req.length] = 'fp_doy';
            req[req.length] = 'fp_address';
            req[req.length] = 'fp_town';
            req[req.length] = 'fp_tk';
            req[req.length] = 'fp_phone';
            req[req.length] = 'fp_mobile';
            req[req.length] = 'fp_email';


            if(formValues['step2']['fp_second']){


                req[req.length] = 'fp_lname2';
                req[req.length] = 'fp_fname2';
                req[req.length] = 'fp_phone2';
                req[req.length] = 'fp_email2';
                req[req.length] = 'fp_thesi2';

            }


        } else if(formValues['step1']['group2']==1){

            req[req.length] = 'es_address';
            req[req.length] = 'es_adt';
            req[req.length] = 'es_afm';
            req[req.length] = 'es_company';
            req[req.length] = 'es_doy';
            req[req.length] = 'es_email';
            req[req.length] = 'es_email2';
            req[req.length] = 'es_email3';
            req[req.length] = 'es_fname';
            req[req.length] = 'es_fname3';
            req[req.length] = 'es_gemi';
            req[req.length] = 'es_lname';
            req[req.length] = 'es_lname3';
            req[req.length] = 'es_mobile';
            req[req.length] = 'es_nomikimorfi';
            req[req.length] = 'es_phone';
            req[req.length] = 'es_phone2';
            req[req.length] = 'es_phone3';
            req[req.length] = 'es_thesi3';
            req[req.length] = 'es_tk';
            req[req.length] = 'es_town';

        } else if(formValues['step1']['group2']==2){

            if(formValues['step1']['group2a']==0){

                req[req.length] = 'fp_lname';
                req[req.length] = 'fp_fname';
                req[req.length] = 'fp_adt';
                req[req.length] = 'fp_afm';
                req[req.length] = 'fp_doy';
                req[req.length] = 'fp_address';
                req[req.length] = 'fp_town';
                req[req.length] = 'fp_tk';
                req[req.length] = 'fp_phone';
                req[req.length] = 'fp_mobile';
                req[req.length] = 'fp_email';


                if(formValues['step2']['fp_second']){


                    req[req.length] = 'fp_lname2';
                    req[req.length] = 'fp_fname2';
                    req[req.length] = 'fp_phone2';
                    req[req.length] = 'fp_email2';
                    req[req.length] = 'fp_thesi2';

                }

            } else if(formValues['step1']['group2a']==1){

                req[req.length] = 'es_address';
                req[req.length] = 'es_adt';
                req[req.length] = 'es_afm';
                req[req.length] = 'es_company';
                req[req.length] = 'es_doy';
                req[req.length] = 'es_email';
                req[req.length] = 'es_email2';
                req[req.length] = 'es_email3';
                req[req.length] = 'es_fname';
                req[req.length] = 'es_fname3';
                req[req.length] = 'es_gemi';
                req[req.length] = 'es_lname';
                req[req.length] = 'es_lname3';
                req[req.length] = 'es_mobile';
                req[req.length] = 'es_nomikimorfi';
                req[req.length] = 'es_phone';
                req[req.length] = 'es_phone2';
                req[req.length] = 'es_phone3';
                req[req.length] = 'es_thesi3';
                req[req.length] = 'es_tk';
                req[req.length] = 'es_town';

            }

        }
        var error = 0;
        $('input[id^="fp_"]').css('border','1px solid #ced4da');

        for(var i=0;i<req.length;i++){

            if(formValues['step2'][req[i]]==''){

                $('#' + req[i]).css('border','1px solid red');
                error = 1;

            }

        }
        console.log(formValues);
        if(error==0) {

            if (formValues['step1']['group1'] == 0 || formValues['step1']['group1'] == 2) {
                changeForm(4);
            } else if (formValues['step1']['group1'] == 1) {
                changeForm(5);
            }

        }

    }

    function submitFirstStep(form){

        var group1 = form.find('input[name=group1]:checked').attr('id');
        var group2 = form.find('input[name=group2]:checked').attr('id');
        var group2a = form.find('input[name=group2a]:checked').attr('id');
        var group3 = form.find('input[name=group3]:checked').attr('id');
        var group4 = form.find('input[name=group4]:checked').attr('id');
        var error = 0;

        console.log([group1,group2,group2a,group3,group4]);
        if(typeof group1 === 'undefined' || group1 ==''){

            error = 1;
            console.log(1);

        } else {

            group1 = group1.replace('group1','');

        }

        if(error == 1 || typeof group2 === 'undefined' || group2==''){

            error = 1;
            console.log(2);

        } else {

            group2 = group2.replace('group2','');

            if(group2==2){

                if ( error == 1 || typeof group2a === 'undefined' || group2a == '') {

                    error = 1;
                    console.log('2a');

                } else {

                    group2a = group2a.replace('group2a', '');

                }

            }

        }

        if( group1 == '0' || group1 == '2' ) {

            if ( error == 1 || typeof group3 === 'undefined' || group3 == '') {

                error = 1;
                console.log(3);

            } else {

                group3 = group3.replace('group3', '');

            }

        }

        if( group1 == '1' || group1 == '2' ) {

            if (error == 1 || typeof group4 === 'undefined' || group4 == '' ) {

                error = 1;

                console.log(4)
            } else {

                group4 = group4.replace('group4', '');

            }

        }

        console.log([group1,group2,group2a,group3,group4]);
        if(error == 0 ) {
            formValues['step1'] = [];
            formValues['step1']['group1'] = group1;
            formValues['step1']['group2'] = group2;
            formValues['step1']['group2a'] = group2a;
            formValues['step1']['group3'] = group3;
            formValues['step1']['group4'] = group4;

            if(formValues['step1']['group2']==0){

                changeForm(2);

            } else if(formValues['step1']['group2']==1){

                changeForm(3);

            } else if(formValues['step1']['group2']==2){

                if(formValues['step1']['group2a']==0){

                    changeForm(2);

                } else if(formValues['step1']['group2a']==1){

                    changeForm(3);

                }

            }

        } else {
            form.find('.error-message').html('Παρακαλώ επιλέξτε τα απαραίτητα πεδία.')
        }
    }


    function changeForm($formId){

        console.log('formid => ' + $formId);

        if($formId>0) {
            console.log('ON 1');
            $('.steps #step1 svg g .main').attr('fill', 'url(#grad4)');
            if ($formId > 1) {

                console.log('ON 2');
                $('.steps #step2 svg g .main').attr('fill', 'url(#grad4)');
                if ($formId > 3) {

                    console.log('ON 3');
                    $('.steps #step3 svg g .main').attr('fill', 'url(#grad4)');
                    if ($formId > 5) {

                        console.log('ON 4');
                        $('.steps #step4 svg g .main').attr('fill', 'url(#grad4)');
                        if ($formId > 6) {

                            console.log('ON 5');
                            $('.steps #step5 svg g .main').attr('fill', 'url(#grad4)');
                        }
                    }
                }
            }
        }

        $('.wizard-form').removeClass('active');

        $('#form' + $formId ).addClass('active');


    }

    function initialize() {

        $('.wizard-form').on('submit',submitForm);

        $('#group1').find('input').on('change',function(){
            console.log($('#group1 input:checked').attr('id'));
            var valId = $('#group1 input:checked').attr('id').replace('group1','');
            if(valId==0){
                $('#group3').show();
                $('#group4').hide();
            } else if(valId==1){
                $('#group4').show();
                $('#group3').hide();
            } else if(valId==2) {
                $('#group3').show();
                $('#group4').show();
            }

        });
        $('#group2').find('input[name=group2]').on('change',function(){
            console.log($('#group2 input:checked').attr('id'));
            var valId = $('#group2 input:checked').attr('id').replace('group2','');
            if(valId==0){
                $('#group2a').hide();
            } else if(valId==1){
                $('#group2a').hide();
            } else if(valId==2) {
                $('#group2a').show();
            }

        });
        changeForm(1);

        console.log('Forms Init');

    }

    return {
        init : initialize
    }


})();