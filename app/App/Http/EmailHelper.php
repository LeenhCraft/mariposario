<?php

namespace App\Http;

// para enviar correo electronico
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailHelper
{

    public function enviarEmail($data, $template)
    {
        require __DIR__ . '/vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $emailDestino = $data['email'];
        $asunto = $data['asunto'];
        $nombreDestino = $data['nombreUsuario'];
        ob_start();
        require_once("Views/Template/Email/" . $template . ".php");
        $mensaje = ob_get_clean();
        $msg = [];


        try {
            //Server settings
            // $mail->SMTPDebug = local: 0, produccion: 1;
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.leenhcraft.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'no-reply@leenhcraft.com';                     //SMTP username
            $mail->Password   = '*Fqn[JA$TNj+';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('no-reply@leenhcraft.com', NOMBRE_EMPRESA);
            $mail->addAddress($emailDestino, $nombreDestino);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments - archivos adjuntos
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content - mensaje
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $mensaje;
            $mail->AltBody = 'leenhcraft.com';
            $mail->charSet = "UTF-8";
            //To load the French version
            $mail->setLanguage('es', 'libraries/phpmailer/languaje');

            $mail->send();
            return true;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            // $msg['status'] = true;
            // $msg['text'] = "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
            return false;
        }
        return $msg;
    }
}
