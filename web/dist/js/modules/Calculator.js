var Calculator = (function(){


    var formaEndiaferontos;
    var ekdilosiEndiaferontosButton = 'ekdilosi_endiaferontos_button';

    var $cal1Id = "oikiako_form";
    var $cal2Id = "epaggelmatiko_form";
    var $cal3Id = "oikiako_aerio_form";
    var $cal4Id = "epaggelmatiko_aerio_form";

    var $title1 = 'Πετρογκάζ',
        $title2 = 'Βασικός προμηθευτής';

    var $calId = "calculator_form";
    var $mainChoices;
    var $revmaButton;
    var $aerioButton;
    var $revmaChoices;
    var $oikiakoRevmaButton;
    var $oikiakoRevmaChoices;
    var $epaggelmatikoRevmaButton;
    var $epaggelmatikoRevmaChoices;
    var $aerioChoices;
    var $oikiakoAerioButton;
    var $epaggelmatikoAerioButton;
    var $oikiakoAerioChoices;
    var $epaggelmatikoAerioChoices;



    var kwhPreM2 = 200;

    var g21Pagio = '0.53';
    var g21Kwh = '0.10153';

    var g21Paketo1Title = 'Red Pro 1';
    var g21Paketo1Pagio = '0.00';
    var g21Paketo1KwhPerYear = '0.0796';
    var g21Paketo2Title = 'Red Pro 1 Plus';
    var g21Paketo2Pagio = '6.00';
    var g21Paketo2KwhPerYear = '0.0748';
    var g21Paketo3Title = 'Red Pro 1 Fixed';
    var g21Paketo3Pagio = '0.00';
    var g21Paketo3KwhPerYear = '0.0855';

    var g22Pagio = '0.53';
    var g22Kw = '1.10';
    var g22Kwh = '0.08259';

    var g22Paketo1Title = 'Red Pro 2';
    var g22Paketo1Pagio = '0.00';
    var g22Paketo1Kw = '0.00';
    var g22Paketo1Kwh = '0.0776';

    var g22Paketo2Title = 'Red Pro 2 Plus';
    var g22Paketo2Pagio = '40.00';
    var g22Paketo2Kw = '0.00';
    var g22Paketo2Kwh = '0.0736';

    var g22Paketo3Title = 'Red Pro 2 Fixed';
    var g22Paketo3Pagio = '00.00';
    var g22Paketo3Kw = '0.00';
    var g22Paketo3Kwh = '0.0835';


    var g23Pagio = '0.53';
    var g23KwhDay = '0.11346';
    var g23KwhNight = '0.06610';

    var g23Paketo1Title = 'Red Pro 3';
    var g23Paketo1Pagio = '0.00';
    var g23Paketo1KwhDay = '0.1045';
    var g23Paketo1KwhNight = '0.0639';

    var g23Paketo2Title = 'Red Pro 3 Plus';
    var g23Paketo2Pagio = '15.00';
    var g23Paketo2KwhDay = '0.0955';
    var g23Paketo2KwhNight = '0.0639';

    var g23Paketo3Title = 'Red Pro 3 Fixed';
    var g23Paketo3Pagio = '0.00';
    var g23Paketo3KwhDay = '0.1105';
    var g23Paketo3KwhNight = '0.0699';


    // OIKIAKO


    var oikAtoma = { 1: 2000, 2: 3300, 3: 4300, 4: 5500, 5: 6700 };
    var oikDei1Pagio = '1.52';
    var oikDei3Pagio = '4.80';
    var oikDeiNixtaPagio = '2';
    var oikDeiCostA = '0.0946';
    var oikDeiCostB = '0.10252';
    var oikDeiCostMeraA = '0.0946';
    var oikDeiCostMeraB = '0.10252';
    var oikDeiCostNyxtaA = '0.0661';
    var oikDeiCostNyxtaB = '0.0661';

    var oikSintelestisMeras = '0.65';
    var oikSintelestisNyxtas = '0.35';


// oikiako G1

    var OikPack1Title = 'Red Home';
    var OikPack1Pagio = '0.00';
    var OikPack1Kostos = '0.0840';
    var OikPack2Title = 'Red Home Plus';
    var OikPack2Pagio = '4.00';
    var OikPack2Kostos = '0.0760';
    var OikPack3Title = 'Red Home 24/7';
    var OikPack3Pagio = '4.00';
    var OikPack3Kostos = '0.0717';
    var OikPack4Title = 'Red Home Solar';
    var OikPack4Pagio = '0.00';
    var OikPack4Kostos = '0.0625';

// oikiako G1N

    var Oik3Pack1Title = 'Red Home Night';
    var Oik3Pack1Pagio = '0.00';
    var Oik3Pack1MeraKostos = '0.0840';
    var Oik3Pack1NyxtaKostos = '0.0639';

    var Oik3Pack2Title = 'Red Home Night Plus';
    var Oik3Pack2Pagio = '4.00';
    var Oik3Pack2MeraKostos = '0.0760';
    var Oik3Pack2NyxtaKostos = '0.0630';

    var Oik3Pack3Title = 'Red Home 24/7';
    var Oik3Pack3Pagio = '4.00';
    var Oik3Pack3MeraKostos = '0.0717';
    var Oik3Pack3NyxtaKostos = '0.0717';

    var Oik3Pack4Title = 'Red Home Solar';
    var Oik3Pack4Pagio = '0.00';
    var Oik3Pack4MeraKostos = '0.0625';
    var Oik3Pack4NyxtaKostos = '0.0625';

    var myCheckAtoma=0;
    var myCheckNumberField=0;

    function formatNumbers(n, c, d, t) {
        var c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "," : d,
            t = t == undefined ? "." : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;

        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }

    var elSelected;
    function resetSelect() {
        $(".type1").parent().show();
        $(".boxtype1").removeClass("show");
        $("." + elSelected).addClass("show");
        $(".form__actions .btn").addClass("show");
    }
    $(".flex2").each(function(){
        elSelected = $(this).find("input:checked").val();
        resetSelect();
    })

    function oikInputsDisplay(){

        var fasi = $('#' + $cal1Id + ' #fasi input[type=radio]:checked').val();
        var type = $('#' + $cal1Id + ' #type input[type=radio]:checked').val();

        /**
         *
         *  FASI
         *  mon -> 1
         *  3   -> 2
         *
         *  TYPE
         *  Γ1  -> 1
         *  Γ1Ν -> 2
         *
         */

        $('#' + $cal1Id + ' #atoma').hide().find('input').val('');
        $('#' + $cal1Id + ' #kwh_day').hide().find('input').val('');
        $('#' + $cal1Id + ' #kwh_night').hide().find('input').val('');
        $('#' + $cal1Id + ' #kwh').hide().find('input').val('');
        $('#' + $cal1Id + ' #days').hide().find('input').val('');

        if( fasi == 1 ) {

            if (type == 1) {

                $('#' + $cal1Id + ' #atoma').show();
                $('#' + $cal1Id + ' #kwh').show();
                $('#' + $cal1Id + ' #days').show();

            }
            else if ( type == 2 ) {

                $('#' + $cal1Id + ' #atoma').show();
                $('#' + $cal1Id + ' #kwh_day').show();
                $('#' + $cal1Id + ' #kwh_night').show();
                $('#' + $cal1Id + ' #days').show();

            }

        } else if( fasi == 2 ) {


            if ( type == 1 ) {

                $('#' + $cal1Id + ' #atoma').show();
                $('#' + $cal1Id + ' #kwh').show();
                $('#' + $cal1Id + ' #days').show();

            }
            else if ( type == 2 ) {

                $('#' + $cal1Id + ' #atoma').show();
                $('#' + $cal1Id + ' #kwh_day').show();
                $('#' + $cal1Id + ' #kwh_night').show();
                $('#' + $cal1Id + ' #days').show();

            }

        }



    }

    function oikCalculate(){

        var atoma= $('#' + $cal1Id + ' input#oik_atoma').val();
        var kwh= $('#' + $cal1Id + ' input#oik_kwh').val();
        var days= $('#' + $cal1Id + ' input#oik_days').val();
        var kwhDay= $('#' + $cal1Id + ' input#oik_kwh_day').val();
        var kwhNight= $('#' + $cal1Id + ' input#oik_kwh_night').val();

        var fasi = $('#' + $cal1Id + ' #fasi input[type=radio]:checked').val();
        var type = $('#' + $cal1Id + ' #type input[type=radio]:checked').val();

        var kostosPagio = 0;

        if( fasi == 1 ) {

            if(type == 1 ){

                kostosPagio = ( oikDei1Pagio / 120 ) * 365 ;

            } else if( type == 2 ){

                // kostosPagio = (( oikDei1Pagio / 120 ) * 365 * oikSintelestisMeras) + (( oikDeiNixtaPagio / 120 ) * 365 * oikSintelestisNyxtas);
                kostosPagio = ( oikDei1Pagio / 120 ) * 365;

            }

        }
        else if( fasi == 2 ) {

            if( type == 1 ){

                kostosPagio = ( oikDei3Pagio / 120 ) * 365 ;

            } else if( type == 2 ){

                kostosPagio = (( oikDei3Pagio / 120 ) * 365) + (( oikDeiNixtaPagio / 120 ) * 365);
                // kostosPagio = ( oikDei3Pagio / 120 ) * 365;

            }

        }

        if (type == 1) {

            if (atoma > 0) {

                var KwhPerYear = oikAtoma[atoma];
                var kostosKwhPerYear = KwhPerYear * oikDeiCostA;
                if(KwhPerYear>2000){

                }
                var sunolo = kostosKwhPerYear + kostosPagio;

                var pack1_kostosPagio = ( OikPack1Pagio / 30 ) * 365;
                var pack1_kostosKwhPerYear = KwhPerYear * OikPack1Kostos;
                var pack1_sunolo = pack1_kostosKwhPerYear + pack1_kostosPagio;
                var pack1_ekptwsi = sunolo - pack1_sunolo;
                var pack1_percent = (pack1_ekptwsi * 100) / sunolo;

                var pack2_kostosPagio = ( OikPack2Pagio / 30 ) * 365;
                var pack2_kostosKwhPerYear =  KwhPerYear * OikPack2Kostos;
                var pack2_sunolo = pack2_kostosKwhPerYear + pack2_kostosPagio;
                var pack2_ekptwsi = sunolo - pack2_sunolo;
                var pack2_percent = (pack2_ekptwsi * 100) / sunolo;

                var pack3_kostosPagio = ( OikPack3Pagio / 30 ) * 365;
                var pack3_kostosKwhPerYear = KwhPerYear * OikPack3Kostos;
                var pack3_sunolo = pack3_kostosKwhPerYear + pack3_kostosPagio;
                var pack3_ekptwsi = sunolo - pack3_sunolo;
                var pack3_percent = (pack3_ekptwsi * 100) / sunolo;

                var pack4_kostosPagio = ( OikPack4Pagio / 30 ) * 365;
                var pack4_kostosKwhPerYear = KwhPerYear * OikPack4Kostos;
                var pack4_sunolo = pack4_kostosKwhPerYear + pack4_kostosPagio;
                var pack4_ekptwsi = sunolo - pack4_sunolo;
                var pack4_percent = (pack4_ekptwsi * 100) / sunolo;

                $('#prof_calc_modal .modal-body').html(
                    '<h3 style="color:#0e3e83;">ΤΙΜΟΚΑΤΑΛΟΓΟΣ PETROGAZ</h3>' +
                    '<table class="table table-bordered table-responsive">' +
                    '<tr>' +
                    '<th></th>' +
                    '<th colspan="3" class="petrogaz">' + $title1 + '</th>' +
                    '<th colspan="1" class="basikos_paroxos">' + $title2 + '</th>' +
                    '<th colspan="2"></th>' +
                    '</tr>' +
                    '<thead>' +
                    '<tr>' +
                    '<td></td>' +
                    '<th>ΠΑΓΙΟ</th>' +
                    '<th>ΧΡΕΩΣΗ</th>' +
                    '<th>ΣΥΝΟΛΟ</th>' +
                    '<th>ΧΡΕΩΣΗ</th>' +
                    '<th>ΕΚΠΤΩΣΗ</th>' +
                    '<th>ΕΚΠΤΩΣΗ (%)</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<th>' + OikPack1Title + '</th>' +
                    '<td>' + formatNumbers(pack1_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_percent.toFixed(1)) + '%</td>' +
                    '</tr><tr>' +
                    '<th>' + OikPack2Title + '</th>' +
                    '<td>' + formatNumbers(pack2_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_percent.toFixed(1)) + '%</td>' +
                    '</tr><tr>' +
                    '<th>' + OikPack3Title + '</th>' +
                    '<td>' + formatNumbers(pack3_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_percent.toFixed(1)) + '%</td>' +
                    '</tr><tr>' +
                    '<th>' + OikPack4Title + '</th>' +
                    '<td>' + formatNumbers(pack4_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_percent.toFixed(1)) + '%</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>'
                );

                $('#prof_calc_modal').modal('show');

            }
            else if (kwh > 0 && days > 0) {

                var KwhPerYear = ( kwh / days ) * 365;
                var kostosKwhPerYear = KwhPerYear * oikDeiCostA;
                if(KwhPerYear>2000){

                }
                var sunolo = kostosKwhPerYear + kostosPagio;
                var sunolo_ekptwsi = sunolo - ( sunolo * 0.15 );

                var pack1_kostosPagio = ( OikPack1Pagio / 30 ) * 365;
                var pack1_kostosKwhPerYear = KwhPerYear * OikPack1Kostos;
                var pack1_sunolo = pack1_kostosKwhPerYear + pack1_kostosPagio;
                var pack1_sunolo_ekptwsi = pack1_sunolo - ( pack1_sunolo * 0.15 );
                var pack1_ekptwsi = sunolo_ekptwsi - pack1_sunolo_ekptwsi;
                var pack1_percent = (pack1_ekptwsi * 100) / sunolo_ekptwsi;

                var pack2_kostosPagio = ( OikPack2Pagio / 30 ) * 365;
                var pack2_kostosKwhPerYear =  KwhPerYear * OikPack2Kostos;
                var pack2_sunolo = pack2_kostosKwhPerYear + pack2_kostosPagio;
                var pack2_sunolo_ekptwsi = pack2_sunolo - ( pack2_sunolo * 0.15 );
                var pack2_ekptwsi = sunolo_ekptwsi - pack2_sunolo_ekptwsi;
                var pack2_percent = (pack2_ekptwsi * 100) / sunolo_ekptwsi;

                var pack3_kostosPagio = ( OikPack3Pagio / 30 ) * 365;
                var pack3_kostosKwhPerYear = KwhPerYear * OikPack3Kostos;
                var pack3_sunolo = pack3_kostosKwhPerYear + pack3_kostosPagio;
                var pack3_sunolo_ekptwsi = pack3_sunolo - ( pack3_sunolo * 0.15 );
                var pack3_ekptwsi = sunolo_ekptwsi - pack3_sunolo_ekptwsi;
                var pack3_percent = (pack3_ekptwsi * 100) / sunolo_ekptwsi;

                var pack4_kostosPagio = ( OikPack4Pagio / 30 ) * 365;
                var pack4_kostosKwhPerYear = KwhPerYear * OikPack4Kostos;
                var pack4_sunolo = pack4_kostosKwhPerYear + pack4_kostosPagio;
                var pack4_sunolo_ekptwsi = pack4_sunolo - ( pack4_sunolo * 0.15 );
                var pack4_ekptwsi = sunolo_ekptwsi - pack4_sunolo_ekptwsi;
                var pack4_percent = (pack4_ekptwsi * 100) / sunolo_ekptwsi;

                $('#prof_calc_modal .modal-body').html(
                    '<h3 style="color:#0e3e83;">ΤΙΜΟΚΑΤΑΛΟΓΟΣ PETROGAZ</h3>' +
                    '<table class="table table-bordered table-responsive">' +
                    '<tr>' +
                    '<th></th>' +
                    '<th colspan="4" class="petrogaz">' + $title1 + '</th>' +
                    '<th colspan="2" class="basikos_paroxos">' + $title2 + '</th>' +
                    '<th colspan="2"></th>' +
                    '</tr>' +
                    '<thead>' +
                    '<tr>' +
                    '<td></td>' +
                    '<th>ΠΑΓΙΟ</th>' +
                    '<th>ΧΡΕΩΣΗ</th>' +
                    '<th>ΣΥΝΟΛΟ</th>' +
                    '<th>ΕΚΠΤΩΣΗ 15%</th>' +
                    '<th>ΧΡΕΩΣΗ</th>' +
                    '<th>ΕΚΠΤΩΣΗ (-15%)</th>' +
                    '<th>ΕΚΠΤΩΣΗ</th>' +
                    '<th>ΕΚΠΤΩΣΗ (%)</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<th>' + OikPack1Title + '</th>' +
                    '<td>' + formatNumbers(pack1_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_percent.toFixed(1)) + '%</td>' +
                    '</tr><tr>' +
                    '<th>' + OikPack2Title + '</th>' +
                    '<td>' + formatNumbers(pack2_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_percent.toFixed(1)) + '%</td>' +
                    '</tr><tr>' +
                    '<th>' + OikPack3Title + '</th>' +
                    '<td>' + formatNumbers(pack3_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_percent.toFixed(1)) + '%</td>' +
                    '</tr><tr>' +
                    '<th>' + OikPack4Title + '</th>' +
                    '<td>' + formatNumbers(pack4_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_percent.toFixed(1)) + '%</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>'
                );

                $('#prof_calc_modal').modal('show');

            }

        }
        else if( type == 2 ){

            if(atoma>0) {

                var KwhPerYear = oikAtoma[atoma];
                var kostosKwhPerYear = ( KwhPerYear * oikDeiCostMeraA * oikSintelestisMeras) + ( KwhPerYear * oikDeiCostNyxtaA * oikSintelestisNyxtas);
                var sunolo = kostosKwhPerYear + kostosPagio;


                var pack1_kostosPagio = ( Oik3Pack1Pagio / 30 ) * 365;
                var pack1_kostosKwhMeraPerYear = KwhPerYear * Oik3Pack1MeraKostos * oikSintelestisMeras;
                var pack1_kostosKwhNyxtaPerYear = KwhPerYear * Oik3Pack1NyxtaKostos * oikSintelestisNyxtas;
                var pack1_sunolo = pack1_kostosKwhMeraPerYear + pack1_kostosKwhNyxtaPerYear + pack1_kostosPagio;
                var pack1_ekptwsi = sunolo - pack1_sunolo;
                var pack1_percent = (pack1_ekptwsi * 100) / sunolo;


                var pack2_kostosPagio = ( Oik3Pack2Pagio / 30 ) * 365;
                var pack2_kostosKwhMeraPerYear =  KwhPerYear * Oik3Pack2MeraKostos * oikSintelestisMeras;
                var pack2_kostosKwhNyxtaPerYear =  KwhPerYear * Oik3Pack2NyxtaKostos * oikSintelestisNyxtas;
                var pack2_sunolo = pack2_kostosKwhMeraPerYear + pack2_kostosKwhNyxtaPerYear + pack2_kostosPagio;
                var pack2_ekptwsi = sunolo - pack2_sunolo;
                var pack2_percent = (pack2_ekptwsi * 100) / sunolo;

                var pack3_kostosPagio = ( Oik3Pack3Pagio / 30 ) * 365;
                var pack3_kostosKwhMeraPerYear = KwhPerYear * Oik3Pack3MeraKostos * oikSintelestisMeras;
                var pack3_kostosKwhNyxtaPerYear = KwhPerYear * Oik3Pack3NyxtaKostos * oikSintelestisNyxtas;
                var pack3_sunolo = pack3_kostosKwhMeraPerYear + pack3_kostosKwhNyxtaPerYear + pack3_kostosPagio;
                var pack3_ekptwsi = sunolo - pack3_sunolo;
                var pack3_percent = (pack3_ekptwsi * 100) / sunolo;

                var pack4_kostosPagio = ( Oik3Pack4Pagio / 30 ) * 365;
                var pack4_kostosKwhMeraPerYear = KwhPerYear * Oik3Pack4MeraKostos * oikSintelestisMeras;
                var pack4_kostosKwhNyxtaPerYear = KwhPerYear * Oik3Pack4NyxtaKostos * oikSintelestisNyxtas;
                var pack4_sunolo = pack4_kostosKwhMeraPerYear + pack4_kostosKwhNyxtaPerYear + pack4_kostosPagio;
                var pack4_ekptwsi = sunolo - pack4_sunolo;
                var pack4_percent = (pack4_ekptwsi * 100) / sunolo;

                $('#prof_calc_modal .modal-body').html(
                    '<h3 style="color:#0e3e83;">ΤΙΜΟΚΑΤΑΛΟΓΟΣ PETROGAZ</h3>' +
                    '<table class="table table-bordered table-responsive">' +
                    '<tr>' +
                    '<th></th>' +
                    '<th colspan="4" class="petrogaz">' + $title1 + '</th>' +
                    '<th colspan="1" class="basikos_paroxos">' + $title2 + '</th>' +
                    '<th colspan="2"></th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td></td>' +
                    '<th>ΠΑΓΙΟ</th>' +
                    '<th>ΧΡΕΩΣΗ ΜΕΡΑΣ</th>' +
                    '<th>ΧΡΕΩΣΗ ΝΥΧΤΑΣ</th>' +
                    '<th>ΣΥΝΟΛΟ</th>' +
                    '<th>ΧΡΕΩΣΗ</th>' +
                    '<th>ΕΚΠΤΩΣΗ</th>' +
                    '<th>ΕΚΠΤΩΣΗ(%)</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<th>' + Oik3Pack1Title + '</th>' +
                    '<td>' + formatNumbers(pack1_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_kostosKwhMeraPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_kostosKwhNyxtaPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_percent.toFixed(1)) + '%</td>' +
                    '</tr><tr>' +
                    '<th>' + Oik3Pack2Title + '</th>' +
                    '<td>' + formatNumbers(pack2_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_kostosKwhMeraPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_kostosKwhNyxtaPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_percent.toFixed(1)) + '%</td>' +
                    '</tr><tr>' +
                    '<th>' + Oik3Pack3Title + '</th>' +
                    '<td>' + formatNumbers(pack3_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_kostosKwhMeraPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_kostosKwhNyxtaPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_percent.toFixed(1)) + '%</td>' +
                    '</tr><tr>' +
                    '<th>' + Oik3Pack4Title + '</th>' +
                    '<td>' + formatNumbers(pack4_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_kostosKwhMeraPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_kostosKwhNyxtaPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_percent.toFixed(1)) + '%</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>'
                );
                $('#prof_calc_modal').modal('show');

            }
            else if (kwhDay > 0 && kwhNight > 0 && days > 0) {

                var KwhMeraPerYear = ( kwhDay / days ) * 365;
                var KwhNyxtaPerYear = ( kwhNight / days ) * 365;
                var KwhPerYear = KwhMeraPerYear + KwhNyxtaPerYear;
                var kostosKwhPerYear = ( KwhMeraPerYear * oikDeiCostMeraA) + ( KwhNyxtaPerYear * oikDeiCostNyxtaA );
                var sunolo = kostosKwhPerYear + kostosPagio;
                var sunolo_ekptwsi = sunolo - (sunolo * 0.15);


                var pack1_kostosPagio = ( Oik3Pack1Pagio / 30 ) * 365;
                var pack1_kostosKwhMeraPerYear = KwhMeraPerYear * Oik3Pack1MeraKostos;
                var pack1_kostosKwhNyxtaPerYear = KwhNyxtaPerYear * Oik3Pack1NyxtaKostos;
                var pack1_sunolo = pack1_kostosKwhMeraPerYear + pack1_kostosKwhNyxtaPerYear + pack1_kostosPagio;
                var pack1_sunolo_ekptwsi = pack1_sunolo - (pack1_sunolo * 0.15);
                var pack1_ekptwsi = sunolo_ekptwsi - pack1_sunolo_ekptwsi;
                var pack1_percent = (pack1_ekptwsi * 100) / sunolo_ekptwsi;


                var pack2_kostosPagio = ( Oik3Pack2Pagio / 30 ) * 365;
                var pack2_kostosKwhMeraPerYear =  KwhMeraPerYear * Oik3Pack2MeraKostos;
                var pack2_kostosKwhNyxtaPerYear =  KwhNyxtaPerYear * Oik3Pack2NyxtaKostos;
                var pack2_sunolo = pack2_kostosKwhMeraPerYear + pack2_kostosKwhNyxtaPerYear + pack2_kostosPagio;
                var pack2_sunolo_ekptwsi = pack2_sunolo - (pack2_sunolo * 0.15);
                var pack2_ekptwsi = sunolo_ekptwsi - pack2_sunolo_ekptwsi;
                var pack2_percent = (pack2_ekptwsi * 100) / sunolo_ekptwsi;

                var pack3_kostosPagio = ( Oik3Pack3Pagio / 30 ) * 365;
                var pack3_kostosKwhMeraPerYear = KwhMeraPerYear * Oik3Pack3MeraKostos ;
                var pack3_kostosKwhNyxtaPerYear = KwhNyxtaPerYear * Oik3Pack3NyxtaKostos ;
                var pack3_sunolo = pack3_kostosKwhMeraPerYear + pack3_kostosKwhNyxtaPerYear + pack3_kostosPagio;
                var pack3_sunolo_ekptwsi = pack3_sunolo - (pack3_sunolo * 0.15);
                var pack3_ekptwsi = sunolo_ekptwsi - pack3_sunolo_ekptwsi;
                var pack3_percent = (pack3_ekptwsi * 100) / sunolo_ekptwsi;

                var pack4_kostosPagio = ( Oik3Pack4Pagio / 30 ) * 365;
                var pack4_kostosKwhMeraPerYear = KwhMeraPerYear * Oik3Pack4MeraKostos;
                var pack4_kostosKwhNyxtaPerYear = KwhNyxtaPerYear * Oik3Pack4NyxtaKostos;
                var pack4_sunolo = pack4_kostosKwhMeraPerYear + pack4_kostosKwhNyxtaPerYear + pack4_kostosPagio;
                var pack4_sunolo_ekptwsi = pack4_sunolo - (pack4_sunolo * 0.15);
                var pack4_ekptwsi = sunolo_ekptwsi - pack4_sunolo_ekptwsi;
                var pack4_percent = (pack4_ekptwsi * 100) / sunolo_ekptwsi;

                $('#prof_calc_modal .modal-body').html(
                    '<h3 style="color:#0e3e83;">ΤΙΜΟΚΑΤΑΛΟΓΟΣ PETROGAZ</h3>' +
                    '<table class="table table-bordered table-responsive">' +
                    '<tr>' +
                    '<th></th>' +
                    '<th colspan="5" class="petrogaz">' + $title1 + '</th>' +
                    '<th colspan="2" class="basikos_paroxos">' + $title2 + '</th>' +
                    '<th colspan="2"></th>' +
                    '</tr>' +
                    '<thead>' +
                    '<tr>' +
                    '<td></td>' +
                    '<th>ΠΑΓΙΟ</th>' +
                    '<th>ΧΡΕΩΣΗ ΜΕΡΑΣ</th>' +
                    '<th>ΧΡΕΩΣΗ ΝΥΧΤΑΣ</th>' +
                    '<th>ΣΥΝΟΛΟ</th>' +
                    '<th>ΕΚΠΤΩΣΗ 15%</th>' +
                    '<th>ΧΡΕΩΣΗ</th>' +
                    '<th>ΕΚΠΤΩΣΗ 15%</th>' +
                    '<th>ΕΚΠΤΩΣΗ</th>' +
                    '<th>ΕΚΠΤΩΣΗ(%)</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<th>' + Oik3Pack1Title + '</th>' +
                    '<td>' + formatNumbers(pack1_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_kostosKwhMeraPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_kostosKwhNyxtaPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_percent.toFixed(1)) + '%</td>' +
                    '</tr><tr>' +
                    '<th>' + Oik3Pack2Title + '</th>' +
                    '<td>' + formatNumbers(pack2_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_kostosKwhMeraPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_kostosKwhNyxtaPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_percent.toFixed(1)) + '%</td>' +
                    '</tr><tr>' +
                    '<th>' + Oik3Pack3Title + '</th>' +
                    '<td>' + formatNumbers(pack3_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_kostosKwhMeraPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_kostosKwhNyxtaPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_percent.toFixed(1)) + '%</td>' +
                    '</tr><tr>' +
                    '<th>' + Oik3Pack4Title + '</th>' +
                    '<td>' + formatNumbers(pack4_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_kostosKwhMeraPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_kostosKwhNyxtaPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack4_percent.toFixed(1)) + '%</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>'
                );
                $('#prof_calc_modal').modal('show');


            }

        }



    }

    function profInputsDisplay(){

        var type = $('#' + $cal2Id + ' input[type=radio]:checked').val();


        $('#' + $cal2Id + ' #m2').hide().find('input').val('');
        $('#' + $cal2Id + ' #kw').hide().find('input').val('');
        $('#' + $cal2Id + ' #kwh_day').hide().find('input').val('');
        $('#' + $cal2Id + ' #kwh_night').hide().find('input').val('');
        $('#' + $cal2Id + ' #kwh').hide().find('input').val('');
        $('#' + $cal2Id + ' #days').hide().find('input').val('');

        if(type==1) {

            $('#' + $cal2Id + ' #m2').show();
            $('#' + $cal2Id + ' #kwh').show();
            $('#' + $cal2Id + ' #days').show();
            resetSelect();


        }
        else if(type==2) {

            $('#' + $cal2Id + ' #kw').show();
            $('#' + $cal2Id + ' #kwh').show();
            $('#' + $cal2Id + ' #days').show();
            $(".type1").parent().hide();
            $(".boxtype1").addClass("show");
            $("input#prof_submit").addClass("show");

        }
        else if(type==3) {

            $('#' + $cal2Id + ' #kwh_day').show();
            $('#' + $cal2Id + ' #kwh_night').show();
            $('#' + $cal2Id + ' #days').show();
            $(".type1").parent().hide();
            $(".boxtype1").addClass("show");
            $("input#prof_submit").addClass("show");

        }



    }

    function profCalculate(){

        var m2= $('#' + $cal2Id + ' input#prof_m2').val();
        var kwh= $('#' + $cal2Id + ' input#prof_kwh').val();
        var kw= $('#' + $cal2Id + ' input#prof_kw').val();
        var days= $('#' + $cal2Id + ' input#prof_days').val();
        var kwhDay= $('#' + $cal2Id + ' input#prof_kwh_day').val();
        var kwhNight= $('#' + $cal2Id + ' input#prof_kwh_night').val();

        var type = $('#' + $cal2Id + ' input[type=radio]:checked').val();

        if(type==1) {

            if (m2 > 0) {

                var kwhPerYear = m2 * kwhPreM2;


                var kostosKwhPerYear = g21Kwh * kwhPerYear;
                var kostosPagio = ( g21Pagio / 30 ) * 365;
                var sunolo = kostosKwhPerYear + kostosPagio;

                var pack1_kostosKwhPerYear = g21Paketo1KwhPerYear * kwhPerYear;
                var pack1_kostosPagio = ( g21Paketo1Pagio / 30 ) * 365;
                var pack1_sunolo = pack1_kostosKwhPerYear + pack1_kostosPagio;
                var pack1_ekptwsi = sunolo - pack1_sunolo;
                var pack1_percent = (pack1_ekptwsi * 100 ) / sunolo;

                var pack2_kostosKwhPerYear = g21Paketo2KwhPerYear * kwhPerYear;
                var pack2_kostosPagio = ( g21Paketo2Pagio / 30 ) * 365;
                var pack2_sunolo = pack2_kostosKwhPerYear + pack2_kostosPagio;
                var pack2_ekptwsi = sunolo - pack2_sunolo;
                var pack2_percent = (pack2_ekptwsi * 100 ) / sunolo;

                var pack3_kostosKwhPerYear = g21Paketo3KwhPerYear * kwhPerYear;
                var pack3_kostosPagio = ( g21Paketo3Pagio / 30 ) * 365;
                var pack3_sunolo = pack3_kostosKwhPerYear + pack3_kostosPagio;
                var pack3_ekptwsi = sunolo - pack3_sunolo;
                var pack3_percent = (pack3_ekptwsi * 100 ) / sunolo;


                $('#prof_calc_modal .modal-body').html(

                    '<h3 style="color:#0e3e83;">ΤΙΜΟΚΑΤΑΛΟΓΟΣ PETROGAZ</h3>' +
                    '<table class="table table-bordered table-responsive">' +
                    '<thead>' +
                    '<tr>' +
                    '<th></th>' +
                    '<th colspan="3" class="petrogaz">' + $title1 + '</th>' +
                    '<th colspan="1" class="basikos_paroxos">' + $title2 + '</th>' +
                    '<th colspan="2"></th>' +
                    '</tr>' +
                    '<tr>' +
                    '<th></th>' +
                    '<th>ΠΑΓΙΟ</th>' +
                    '<th>ΧΡΕΩΣΗ</th>' +
                    '<th>ΣΥΝΟΛΟ</th>' +
                    '<th>ΧΡΕΩΣΗ</th>' +
                    '<th>ΕΚΠΤΩΣΗ</th>' +
                    '<th>ΕΚΠΤΩΣΗ (%)</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<th>' + g21Paketo1Title + '</th>' +
                    '<td>' + formatNumbers(pack1_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_percent.toFixed(1)) + '%</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<th>' + g21Paketo2Title + '</th>' +
                    '<td>' + formatNumbers(pack2_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_percent.toFixed(1)) + '%</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<th>' + g21Paketo3Title + '</th>' +
                    '<td>' + formatNumbers(pack3_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_percent.toFixed(1)) + '%</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>'

                );

                $('#prof_calc_modal').modal('show');

            }
            else if (kwh > 0 && days > 0) {


                var kwhPerYear = ( kwh / days ) * 365;

                var kostosKwhPerYear = g21Kwh * kwhPerYear;
                var kostosPagio = ( g21Pagio / 30 ) * 365;
                var sunolo = kostosKwhPerYear + kostosPagio;
                var sunolo_ekptwsi = sunolo - ( sunolo * 0.15 );

                var pack1_kostosKwhPerYear = g21Paketo1KwhPerYear * kwhPerYear;
                var pack1_kostosPagio = ( g21Paketo1Pagio / 30 ) * 365;
                var pack1_sunolo = pack1_kostosKwhPerYear + pack1_kostosPagio;
                var pack1_sunolo_ekptwsi = pack1_sunolo - ( pack1_sunolo * 0.15 );
                var pack1_ekptwsi = sunolo_ekptwsi - pack1_sunolo_ekptwsi;
                var pack1_percent = (pack1_ekptwsi / sunolo_ekptwsi) * 100;

                var pack2_kostosKwhPerYear = g21Paketo2KwhPerYear * kwhPerYear;
                var pack2_kostosPagio = ( g21Paketo2Pagio / 30 ) * 365;
                var pack2_sunolo = pack2_kostosKwhPerYear + pack2_kostosPagio;
                var pack2_sunolo_ekptwsi = pack2_sunolo - ( pack2_sunolo * 0.15 );
                var pack2_ekptwsi = sunolo_ekptwsi - pack2_sunolo_ekptwsi;
                var pack2_percent = (pack2_ekptwsi * 100 ) / sunolo_ekptwsi;

                var pack3_kostosKwhPerYear = g21Paketo3KwhPerYear * kwhPerYear;
                var pack3_kostosPagio = ( g21Paketo3Pagio / 30 ) * 365;
                var pack3_sunolo = pack3_kostosKwhPerYear + pack3_kostosPagio;
                var pack3_sunolo_ekptwsi = pack3_sunolo - ( pack3_sunolo * 0.15 );
                var pack3_ekptwsi = sunolo_ekptwsi - pack3_sunolo_ekptwsi;
                var pack3_percent = (pack3_ekptwsi * 100 ) / sunolo_ekptwsi;
                $('#prof_calc_modal .modal-body').html(

                    '<h3 style="color:#0e3e83;">ΤΙΜΟΚΑΤΑΛΟΓΟΣ PETROGAZ</h3>' +
                    '<table class="table table-bordered table-responsive">' +
                    '<thead>' +
                    '<tr>' +
                    '<th></th>' +
                    '<th colspan="4" class="petrogaz">' + $title1 + '</th>' +
                    '<th colspan="2" class="basikos_paroxos">' + $title2 + '</th>' +
                    '<th colspan="2"></th>' +
                    '</tr>' +
                    '<tr>' +
                    '<th></th>' +
                    '<th>ΠΑΓΙΟ</th>' +
                    '<th>ΧΡΕΩΣΗ</th>' +
                    '<th>ΣΥΝΟΛΟ</th>' +
                    '<th>ΕΚΠΤΩΣΗ 15%</th>' +
                    '<th>ΧΡΕΩΣΗ</th>' +
                    '<th>ΕΚΠΤΩΣΗ 15%</th>' +
                    '<th>ΕΚΠΤΩΣΗ</th>' +
                    '<th>ΕΚΠΤΩΣΗ (%)</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<th>' + g21Paketo1Title + '</th>' +
                    '<td>' + formatNumbers(pack1_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack1_percent.toFixed(1)) + '%</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<th>' + g21Paketo2Title + '</th>' +
                    '<td>' + formatNumbers(pack2_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack2_percent.toFixed(1)) + '%</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<th>' + g21Paketo3Title + '</th>' +
                    '<td>' + formatNumbers(pack3_kostosPagio.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_ekptwsi.toFixed(2)) + '€</td>' +
                    '<td>' + formatNumbers(pack3_percent.toFixed(1)) + '%</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>'
                );

                $('#prof_calc_modal').modal('show');
            }

        }
        else if(type==2){

            var kwhPerYear = ( kwh / days ) * 365;
            var kwPerYear = ( kw / days ) * 365;

            var kostosKwhPerYear = g22Kwh * kwhPerYear;
            var kostosKwPerYear = g22Kw * kwPerYear;
            var kostosPagio = ( g22Pagio / 30 ) * 365;
            var sunolo = kostosKwhPerYear + kostosPagio + kostosKwPerYear;
            var sunolo_ekptwsi = sunolo - ( sunolo * 0.15 );


            var pack1_kostosKwhPerYear = g22Paketo1Kwh * kwhPerYear;
            var pack1_kostosKwPerYear = g22Paketo1Kw * kwPerYear;
            var pack1_kostosPagio = ( g22Paketo1Pagio / 30 ) * 365;
            var pack1_sunolo = pack1_kostosKwhPerYear + pack1_kostosPagio + pack1_kostosKwPerYear;
            var pack1_sunolo_ekptwsi = pack1_sunolo - ( pack1_sunolo * 0.15 );
            var pack1_ekptwsi = sunolo_ekptwsi - pack1_sunolo_ekptwsi;
            var pack1_percent = (pack1_ekptwsi / sunolo_ekptwsi) * 100;


            var pack2_kostosKwhPerYear = g22Paketo2Kwh * kwhPerYear;
            var pack2_kostosKwPerYear = g22Paketo2Kw * kwPerYear;
            var pack2_kostosPagio = ( g22Paketo2Pagio / 30 ) * 365;
            var pack2_sunolo = pack2_kostosKwhPerYear + pack2_kostosPagio + pack2_kostosKwPerYear;
            var pack2_sunolo_ekptwsi = pack2_sunolo - ( pack2_sunolo * 0.15 );
            var pack2_ekptwsi = sunolo_ekptwsi - pack2_sunolo_ekptwsi;
            var pack2_percent = (pack2_ekptwsi / sunolo_ekptwsi) * 100;

            var pack3_kostosKwhPerYear = g22Paketo3Kwh * kwhPerYear;
            var pack3_kostosKwPerYear = g22Paketo3Kw * kwPerYear;
            var pack3_kostosPagio = ( g22Paketo3Pagio / 30 ) * 365;
            var pack3_sunolo = pack3_kostosKwhPerYear + pack3_kostosPagio + pack3_kostosKwPerYear;
            var pack3_sunolo_ekptwsi = pack3_sunolo - ( pack3_sunolo * 0.15 );
            var pack3_ekptwsi = sunolo_ekptwsi - pack3_sunolo_ekptwsi;
            var pack3_percent = (pack3_ekptwsi / sunolo_ekptwsi) * 100;

            $('#prof_calc_modal .modal-body').html(

                '<h3 style="color:#0e3e83;">ΤΙΜΟΚΑΤΑΛΟΓΟΣ PETROGAZ</h3>' +
                '<table class="table table-bordered table-responsive">' +
                '<thead>' +
                '<tr>' +
                '<th></th>' +
                '<th colspan="5" class="petrogaz">' + $title1 + '</th>' +
                '<th colspan="2" class="basikos_paroxos">' + $title2 + '</th>' +
                '<th colspan="2"></th>' +
                '</tr>' +
                '<tr>' +
                '<th></th>' +
                '<th>ΠΑΓΙΟ</th>' +
                '<th>ΙΣΧΥΣ</th>' +
                '<th>ΧΡΕΩΣΗ KWh</th>' +
                '<th>ΣΥΝΟΛΟ</th>' +
                '<th>ΕΚΠΤΩΣΗ 15%</th>' +
                '<th>ΧΡΕΩΣΗ</th>' +
                '<th>ΕΚΠΤΩΣΗ 15%</th>' +
                '<th>ΕΚΠΤΩΣΗ</th>' +
                '<th>ΕΚΠΤΩΣΗ (%)</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '<tr>' +
                '<th>' + g22Paketo1Title + '</th>' +
                '<td>' + formatNumbers(pack1_kostosPagio.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack1_kostosKwPerYear.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack1_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack1_sunolo.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack1_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack1_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack1_percent.toFixed(1)) + '%</td>' +
                '</tr>' +
                '<tr>' +
                '<th>' + g22Paketo2Title + '</th>' +
                '<td>' + formatNumbers(pack2_kostosPagio.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack2_kostosKwPerYear.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack2_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack2_sunolo.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack2_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack2_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack2_percent.toFixed(1)) + '%</td>' +
                '</tr>' +
                '<tr>' +
                '<th>' + g22Paketo3Title + '</th>' +
                '<td>' + formatNumbers(pack3_kostosPagio.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack3_kostosKwPerYear.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack3_kostosKwhPerYear.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack3_sunolo.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack3_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack3_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack3_percent.toFixed(1)) + '%</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>'

            );

            $('#prof_calc_modal').modal('show');

        }
        else if(type==3) {


            var kwhDayPerYear = ( kwhDay / days ) * 365;
            var kwhNightPerYear = ( kwhNight / days ) * 365;


            var kostosKwhDayPerYear = g23KwhDay * kwhDayPerYear;
            var kostosKwhNightPerYear = g23KwhNight * kwhNightPerYear;
            var kostosPagio = ( g23Pagio / 30 ) * 365;
            var sunolo = kostosKwhDayPerYear + kostosPagio + kostosKwhNightPerYear;
            var sunolo_ekptwsi = sunolo - ( sunolo * 0.15 );

            var pack1_kostosKwhDayPerYear = g23Paketo1KwhDay * kwhDayPerYear;
            var pack1_kostosKwhNightPerYear = g23Paketo1KwhNight * kwhNightPerYear;
            var pack1_kostosPagio = ( g23Paketo1Pagio / 30 ) * 365;
            var pack1_sunolo = pack1_kostosKwhDayPerYear + pack1_kostosPagio + pack1_kostosKwhNightPerYear;
            var pack1_sunolo_ekptwsi = pack1_sunolo - ( pack1_sunolo * 0.15 );
            var pack1_ekptwsi = sunolo_ekptwsi - pack1_sunolo_ekptwsi;
            var pack1_percent = (pack1_ekptwsi / sunolo_ekptwsi) * 100;

            var pack2_kostosKwhDayPerYear = g23Paketo2KwhDay * kwhDayPerYear;
            var pack2_kostosKwhNightPerYear = g23Paketo2KwhNight * kwhNightPerYear;
            var pack2_kostosPagio = ( g23Paketo2Pagio / 30 ) * 365;
            var pack2_sunolo = pack2_kostosKwhDayPerYear + pack2_kostosPagio + pack2_kostosKwhNightPerYear;
            var pack2_sunolo_ekptwsi = pack2_sunolo - ( pack2_sunolo * 0.15 );
            var pack2_ekptwsi = sunolo_ekptwsi - pack2_sunolo_ekptwsi;
            var pack2_percent = (pack2_ekptwsi / sunolo_ekptwsi) * 100;

            var pack3_kostosKwhDayPerYear = g23Paketo3KwhDay * kwhDayPerYear;
            var pack3_kostosKwhNightPerYear = g23Paketo3KwhNight * kwhNightPerYear;
            var pack3_kostosPagio = ( g23Paketo3Pagio / 30 ) * 365;
            var pack3_sunolo = pack3_kostosKwhDayPerYear + pack3_kostosPagio + pack3_kostosKwhNightPerYear;
            var pack3_sunolo_ekptwsi = pack3_sunolo - ( pack3_sunolo * 0.15 );
            var pack3_ekptwsi = sunolo_ekptwsi - pack3_sunolo_ekptwsi;
            var pack3_percent = (pack3_ekptwsi / sunolo_ekptwsi) * 100;

            $('#prof_calc_modal .modal-body').html(

                '<h3 style="color:#0e3e83;">ΤΙΜΟΚΑΤΑΛΟΓΟΣ PETROGAZ</h3>' +
                '<table class="table table-bordered table-responsive">' +
                '<tr>' +
                '<th></th>' +
                '<th colspan="5" class="petrogaz">' + $title1 + '</th>' +
                '<th colspan="2" class="basikos_paroxos">' + $title2 + '</th>' +
                '<th colspan="2"></th>' +
                '</tr>' +
                '<thead>' +
                '<tr>' +
                '<th></th>' +
                '<th>ΠΑΓΙΟ</th>' +
                '<th>ΧΡΕΩΣΗ ΜΕΡΑΣ KWh</th>' +
                '<th>ΧΡΕΩΣΗ ΝΥΧΤΑΣ KWh</th>' +
                '<th>ΣΥΝΟΛΟ</th>' +
                '<th>ΕΚΠΤΩΣΗ 15%</th>' +
                '<th>ΧΡΕΩΣΗ</th>' +
                '<th>ΕΚΠΤΩΣΗ 15%</th>' +
                '<th>ΕΚΠΤΩΣΗ</th>' +
                '<th>ΕΚΠΤΩΣΗ (%)</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '<tr>' +
                '<th>' + g23Paketo1Title + '</th>' +
                '<td>' + formatNumbers(pack1_kostosPagio.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack1_kostosKwhDayPerYear.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack1_kostosKwhNightPerYear.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack1_sunolo.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack1_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack1_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack1_percent.toFixed(1)) + '%</td>' +
                '</tr>' +
                '<tr>' +
                '<th>' + g23Paketo2Title + '</th>' +
                '<td>' + formatNumbers(pack2_kostosPagio.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack2_kostosKwhDayPerYear.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack2_kostosKwhNightPerYear.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack2_sunolo.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack2_sunolo_ekptwsi.toFixed(2) )+ '€</td>' +
                '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack2_ekptwsi.toFixed(2)) +'€</td>' +
                '<td>' + formatNumbers(pack2_percent.toFixed(1)) + '%</td>' +
                '</tr>' +
                '<tr>' +
                '<th>' + g23Paketo3Title + '</th>' +
                '<td>' + formatNumbers(pack3_kostosPagio.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack3_kostosKwhDayPerYear.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack3_kostosKwhNightPerYear.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack3_sunolo.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack3_sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(sunolo.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(sunolo_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack3_ekptwsi.toFixed(2)) + '€</td>' +
                '<td>' + formatNumbers(pack3_percent.toFixed(1)) + '%</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>'

            );

            $('#prof_calc_modal').modal('show');

        }


    }

    function oikAerioCalculate(){
        $('#prof_calc_modal .modal-body').html(

            '<h3 style="color:#0e3e83;">ΤΙΜΟΚΑΤΑΛΟΓΟΣ PETROGAZ</h3>' +
            'No Results' +
            '<table class="table table-bordered table-responsive">' +
            '</tbody>' +
            '</table>'

        );

        $('#prof_calc_modal').modal('show');
    }

    function profAerioCalculate(){
        $('#prof_calc_modal .modal-body').html(

            '<h3 style="color:#0e3e83;">ΤΙΜΟΚΑΤΑΛΟΓΟΣ PETROGAZ</h3>' +
            'No Results' +
            '<table class="table table-bordered table-responsive">' +
            '</tbody>' +
            '</table>'

        );

        $('#prof_calc_modal').modal('show');
    }

    function canonicalize(){

        $('#calculator_form form').each(function(){

            $(this).trigger("reset");

        });

    }

    function checkAtoma(){


        var _this = $('#' + $cal1Id + ' #oik_atoma');
        var min = _this.data('min');
        var max = _this.data('max');
        var pre = _this.data('pre');
        var val = ( _this.val() == 0) ? '' : _this.val();

        console.log(_this.val(),'test',val);

        if((val>=min && val <= max) || val == '' ){

            _this.data('pre', val);
            _this.val( val);

        } else {

            _this.val(pre);

        }

        myCheckAtoma=0;

    }


    function initialize() {

        $('#' + $cal1Id + ' #fasi input[type=radio]').on('change',oikInputsDisplay);
        $('#' + $cal1Id + ' #type input[type=radio]').on('change',oikInputsDisplay);

        $('#' + $cal1Id + ' input#oik_submit').on('click',oikCalculate);

        $('#' + $cal2Id + ' input[type=radio]').on('change',profInputsDisplay);

        $('#' + $cal2Id + ' input#prof_submit').on('click',profCalculate);


        $('#' + $cal3Id + ' input#oik_submit').on('click',oikAerioCalculate);

        $('#' + $cal4Id + ' input#prof_submit').on('click',profAerioCalculate);

        $('#' + $cal1Id + ' #oik_atoma').on('keyup',function(){

            if(myCheckAtoma==0){
                myCheckAtoma=1;
                setTimeout(function(){

                    checkAtoma();

                },300);

            }


        });
        $('#' + $cal1Id + ' #oik_atoma').on('change',function(){

            if(myCheckAtoma==0){
                myCheckAtoma=1;
                setTimeout(function(){

                    checkAtoma();

                },300);

            }


        });


        /* NEOS YPOLOGISTIS OIKONOMIAS */

        $mainChoices = $('#main_choices');
        $revmaButton = $('#revma_button');
        $aerioButton = $('#aerio_button');

        $revmaChoices = $('#revma_choices');
        $oikiakoRevmaButton = $('#oikiako_revma_button');
        $oikiakoRevmaChoices = $('#oikiako_revma_choices');

        $epaggelmatikoRevmaButton = $('#epaggelmatiko_revma_button');
        $epaggelmatikoRevmaChoices = $('#epaggelmatiko_revma_choices');

        $aerioChoices = $('#aerio_choices');
        $oikiakoAerioButton = $('#oikiako_aerio_button');
        $epaggelmatikoAerioButton = $('#epaggelmatiko_aerio_button');

        $oikiakoAerioChoices = $('#oikiako_aerio_choices');
        $epaggelmatikoAerioChoices = $('#epaggelmatiko_aerio_choices');

        $revmaButton.on('click',function(){
            // $mainChoices.find('button').removeClass('active');
            // $revmaChoices.find('button').removeClass('active');
            // $(this).addClass('active');
            canonicalize();
            $('.form-sections').addClass('section-hidden');
            $revmaChoices.removeClass('section-hidden');
        });
        $aerioButton.on('click',function(){
            // $mainChoices.find('button').removeClass('active');
            // $revmaChoices.find('button').removeClass('active');
            // $(this).addClass('active');
            canonicalize();
            $('.form-sections').addClass('section-hidden');
            $aerioChoices.removeClass('section-hidden');
        });

        $epaggelmatikoRevmaButton.on('click',function(){
            resetSelect()

            // $revmaChoices.find('button').removeClass('active');
            // $(this).addClass('active');
            canonicalize();
            $('.form-sections').addClass('section-hidden');
            $epaggelmatikoRevmaChoices.removeClass('section-hidden');

        });
        $oikiakoRevmaButton.on('click',function(){
            resetSelect()


            // $revmaChoices.find('button').removeClass('active');
            // $(this).addClass('active');
            canonicalize();
            oikInputsDisplay();
            $('.form-sections').addClass('section-hidden');
            $oikiakoRevmaChoices.removeClass('section-hidden');

        });

        $epaggelmatikoAerioButton.on('click',function(){
            resetSelect()

            // $revmaChoices.find('button').removeClass('active');
            // $(this).addClass('active');
            canonicalize();
            $('.form-sections').addClass('section-hidden');
            $epaggelmatikoAerioChoices.removeClass('section-hidden');

        });
        $oikiakoAerioButton.on('click',function(){
            resetSelect()


            // $revmaChoices.find('button').removeClass('active');
            // $(this).addClass('active');
            canonicalize();
            oikInputsDisplay();
            $('.form-sections').addClass('section-hidden');
            $oikiakoAerioChoices.removeClass('section-hidden');

        });

        $('.go-back').on('click',function(){

            var myId = $(this).data('back');
            $('.form-sections').addClass('section-hidden');
            $('#'+myId).removeClass('section-hidden');

        });

        profInputsDisplay();
        oikInputsDisplay();
        console.log('Calculator Init');
        $(".imgbtn").click(function(){
            $(this).siblings(".btn.btn-primary").click();
        });


        $(".type1").click(function() {

            elSelected = $(this).prev().val();

            // $(".type1").change(function () {

            $(".boxtype1").removeClass("show");
            $("." + elSelected).addClass("show");
            $(".form__actions .btn").addClass("show");

            // });

        });



        $('input.numbered_field').on('keyup',function(){

            // if(myCheckNumberField==0){
            //     myCheckNumberField=1;
            //     setTimeout(function(){

            var _this = $(this);
            var val = ( _this.val() == 0) ? '' : _this.val();

            console.log(_this.val(),'test',val);
            // var newVal = formatNumbers(val);
            // console.log(val,newVal);
            //
            // _this.val(newVal);

            myCheckNumberField=0;

            // },300);

            // }


        });




    }

    return {
        init : initialize
    }


})();