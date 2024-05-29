<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$config = require 'config.php';

// Використання конфігураційних даних
$db_host = $config['db']['host'];
$db_user = $config['db']['user'];
$db_pass = $config['db']['pass'];
$smtp_user = $config['smtp']['user'];
$smtp_pass = $config['smtp']['pass'];


// Функція для читання даних з CSV-файлу
function readRecipientsFromCSV($filename) {
    $recipients = [];
    if (($handle = fopen($filename, 'r')) !== false) {
        // Читання заголовків
        $headers = fgetcsv($handle, 1000, ',');
        // Читання рядків
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $recipients[] = array_combine($headers, $data);
        }
        fclose($handle);
    }
    return $recipients;
}

$recipients = readRecipientsFromCSV('recipients.csv');

// Функція для створення тіла листа з використанням імені отримувача
function createEmailBody($name) {
    return "
        <html>
        <body>
            <p>Dear $name,</p>
            <p>This is the HTML message body <b>in bold!</b></p>
            <p>Best regards,<br>Your Company</p>
        </body>
        </html>
    ";
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@example.com';
    $mail->Password = 'your_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('your_email@example.com', 'Your Name');

    // зміст листа
    
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body = createEmailBody($recipient['name']);
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    
    foreach ($recipients as $recipient) {
        $mail->addAddress($recipient['email'], $recipient['name']);
        $mail->send();
        $mail->clearAddresses(); // Очищення адрес для наступного одержувача
    }
    
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
