<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// php .\src\send_mail.php >>TODO запуск

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$mail = new PHPMailer(true);

var_dump($_ENV['SMTP_HOST'],$_ENV['SMTP_PORT'], $_ENV['SMTP_USER'], $_ENV['SMTP_PASS']); // TODO: debuger

try {
    $mail->isSMTP();
    $mail->Host = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['SMTP_USER'];
    $mail->Password = $_ENV['SMTP_PASS'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $_ENV['SMTP_PORT'];

     // Увімкнення відлагодження
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';

    $mail->setFrom($_ENV['SMTP_USER'], 'mol kol');
    $mail->addAddress('veremey4uk@gmail.com', 'Recipient');

    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a test email body';

    $mail->send();
    echo 'Message has been sent';
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
