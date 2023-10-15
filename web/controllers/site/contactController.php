<?php
/**
 * Created by PhpStorm.
 * User: leonidas
 * Date: 5/15/18
 * Time: 2:20 PM
 */

class contactController extends mainController
{

    //public $recipients = 'jsaltapi@ibhellas.gr';

    function getContact()
    {

        $body_classes = 'contact';

        $contact_model = new contactModel();

        $data = $contact_model->getContactPage();

        $data->header_banner = $data->img;

        $this->addJsModule('Contact');

        $this->getSeo($data);

        $this->templates->addData(compact('body_classes','data'));

        echo $this->templates->render("pages/{$this->myTemplate}/contact");

    }

    public function sendContact(){

        $response['error'] = [];

        $recaptcha["success"] = false;

        $secret = Config::get("reCAPTCHASecretKey");
        $remoteip = $_SERVER["REMOTE_ADDR"];
        $url = "https://www.google.com/recaptcha/api/siteverify";

        $googleResponse = $_POST["g-recaptcha-response"];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            'secret' => $secret,
            'response' => $googleResponse,
            'remoteip' => $remoteip
        ));
        $curlData = curl_exec($curl);
        curl_close($curl);
        $recaptcha = json_decode($curlData, true);

        //var_dump( $recaptcha);

            if ($recaptcha["success"] != true) {

                $response['error'][] = "Recaptcha : Το πειστήριο δεν είναι σωστό";

            }

            if (empty($_POST['email'])) {

                $response['error'][] = "E-mail : {$this->language->translate('form.error.required')}";

            }

            if (empty($_POST['name'])) {

                $response['error'][] = "Ονοματεπώνυμο : {$this->language->translate('form.error.required')}";

            }

            if (empty($_POST['subject'])) {

                $response['error'][] = "Θέμα : {$this->language->translate('form.error.required')}";

            }

            if (empty($_POST['message'])) {

                $response['error'][] = "Μήνυμα : {$this->language->translate('form.error.required')}";

            }

        /**
         *  if validation passed
         */
        if ( count($response['error']) == 0 ) {

            $clean = [
                'name' => Helper::string($_POST['name']),
                'subject' => Helper::string($_POST['subject']),
                'email' => Helper::email($_POST['email']),
                'message' => Helper::string($_POST['message'])
            ];

            $from = $clean['email'];
            //$recipients = $this->recipients;
            $recipients = $this->configs->settings->email;

            $subject = "Επικοινωνία - Skyros.gr";

            $message = $this->templates->render("mails/{$this->myTemplate}/contactForm", compact('clean'));


            if ( count( $response['error'] ) == 0 ) {

                try {

                    //Recipients
                    if (Mail::send($recipients, $from, $subject, $message)) {

                        unset($response['error']);
                        $response['success'] = $this->language->translate('contact.success');

                    } else {
                        $response['error'] = $this->language->translate('contact.error.sendMail');
                    }


                } catch (Exception $e) { //---- errors when trying to send mail ----//

                    $response['error'] = $this->language->translate('contact.error.sendMail');

                }
            }

        } else {

            $response['error'] = $this->formatValitronErrorsToArray($response);

        }

        echo json_encode($response);
        exit();

    }

}