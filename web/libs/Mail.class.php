<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail {

    public static function send($recipients, $from, $subject, $message, $cc = [] , $bcc = [], $debug = false , $alt_message = '') {

        if (!is_array($recipients)){
            $recipients = array($recipients);
        }

        $mail = new PHPMailer(true);        // Passing `true` enables exceptions

        $mail->CharSet = "UTF-8";

        try {

            if($debug /*|| (isset($_SESSION) && array_key_exists('client_id',$_SESSION) && in_array($_SESSION['client_id'],[57,58]))*/ ) {
                $mail->SMTPDebug = 4;                               // Enable verbose debug output
            }

            if(Config::get('useSMTP')==1) {
                $mail->isSMTP();                                // Set mailer to use SMTP
                $mail->Host = Config::get('Host');              // Specify main and backup SMTP servers
                $mail->SMTPAuth = Config::get('SMTPAuth');      // Enable SMTP authentication
                $mail->Username = Config::get('Username');      // SMTP username
                $mail->Password = Config::get('Password');
                $mail->SMTPSecure = Config::get('SMTPSecure');  // Enable TLS encryption, `ssl` also accepted
                $mail->Port = Config::get('Port');
            }


            //Recipients
            $mail->setFrom($from);

            foreach ($recipients as $recipient) {
                $mail->addAddress($recipient);
            }


            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;

            if(isset($cc) && is_array($cc) && count($cc)){

                foreach ($cc AS $c){

                    $mail->AddCC($c, $c);

                }

            }

            if(isset($bcc) && is_array($bcc) && count($bcc)){

                foreach ($bcc AS $bc){

                    $mail->AddBCC($bc,$bc);

                }

            }

            if (!empty($alt_message)) {
                $mail->AltBody = $alt_message;
            }

            if($mail->send()){
                return true;
            }else{
                $errors[] = 'Mailer Error: ' . $mail->ErrorInfo;
            }

            if($debug){
                return $errors;
            }
            error_log('sended',0);


        } catch (Exception $e) { //---- errors when trying to send mail ----//

            $response['error'] = "Could not send the email. Please try again or send us an email to the address below!";
            $response['errorInfo'] = $e->getMessage();
            $response['mailerError'] = $mail->ErrorInfo;

            error_log('Error: ' . $e->getMessage(),0);
            return false;

        }

    }

}