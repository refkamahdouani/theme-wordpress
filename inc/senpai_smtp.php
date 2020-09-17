<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require get_template_directory() . '/vendor/autoload.php';

function Send_mail($email,$name,$msg)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'email-smtp.us-east-1.amazonaws.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'AKIA5LY5LD23R4G62GEW';                     // SMTP username
        $mail->Password   = 'BBDbPjUkjk9KRbIGeaGyP7xn5zRPbjElp7GYbYhI/PG4';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('contact@senpai.codes', 'Contact Form');
        $mail->addAddress('ami16ne@gmail.com');
        $mail->addReplyTo('contact@senpai.codes', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
    
        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Senpai Contact form ${email}";
        $mail->Body    = "<p><b>Name:</b>${name}</p><br><p><b>Email:</b>${email}</p><br><p><b>Contents:</b>${msg}</p>";
        $mail->AltBody = "name:${name} | email:${email} | message:${msg}";
    
        $mail->send();
        $res = 1;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $res = 0;
    }
    return $res;
}

