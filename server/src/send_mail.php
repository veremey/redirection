<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// php .\src\send_mail.php >>TODO запуск

require __DIR__ . '\..\vendor\autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Використання змінних середовища
$db_host = $_ENV['DB_HOST'];
$db_user = $_ENV['DB_USER'];
$db_pass = $_ENV['DB_PASS'];
$smtp_host = $_ENV['SMTP_HOST'];
$smtp_port = $_ENV['SMTP_PORT'];
$smtp_user = $_ENV['SMTP_USER'];
$smtp_pass = $_ENV['SMTP_PASS'];
$mail = new PHPMailer(true);

$recipients = readRecipientsFromCSV(__DIR__ . '/recipients.csv');

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

try {
    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_user;  // 'your_email@example.com';
    $mail->Password = $smtp_pass;  // 'your_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $smtp_port;

        // $mail->SMTPDebug = 2; // TODO: delete


    $mail->setFrom($smtp_user, $smtp_user);

    
    foreach ($recipients as $recipient) {
        $mail->clearAddresses(); // Очищення адрес для наступного одержувача
        $mail->addAddress($recipient['email'], $recipient['name']);

        // зміст листа
    
        $mail->isHTML(true);
        $mail->Subject = 'Here is the subject';
        $mail->Body = createEmailBody($recipient['name']);
    
        $mail->send();
    }
    
    echo 'Message has been sent to ' . $recipient['email'] . '<br>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
