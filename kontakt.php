<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Indlæs Composer's autoloader
require 'vendor/autoload.php';

// Tjek om formularen er blevet sendt
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hent data fra formularen
    $navn = htmlspecialchars($_POST['navn']); // Navn feltet fra formularen
    $email = htmlspecialchars($_POST['email']); // E-mail feltet fra formularen
    $telefon = htmlspecialchars($_POST['telefon']); // Telefon feltet fra formularen
    $besked = nl2br(htmlspecialchars($_POST['besked'])); // Besked feltet fra formularen

    // Emne for e-mailen
    $subject = 'Besked fra kontaktformular';

    // HTML-indhold til e-mailen
    $message = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { width: 100%; padding: 20px; }
            .header { background-color: #f4f4f4; padding: 10px; font-size: 18px; font-weight: bold; }
            .content { margin-top: 10px; }
            .row { margin-bottom: 10px; }
            .label { font-weight: bold; display: inline-block; width: 100px; }
            .value { display: inline-block; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>Kontaktformular Detaljer</div>
            <div class='content'>
                <div class='row'><span class='label'>Navn:</span> <span class='value'>$navn</span></div>
                <div class='row'><span class='label'>Email:</span> <span class='value'>$email</span></div>
                <div class='row'><span class='label'>Telefon:</span> <span class='value'>$telefon</span></div>
                <div class='row'><span class='label'>Besked:</span> <span class='value'>$besked</span></div>
            </div>
        </div>
    </body>
    </html>
    ";

    // Skab et nyt PHPMailer objekt
    $mail = new PHPMailer(true);

    try {
        // SMTP server indstillinger
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'web-tek1801@outlook.dk'; // Afsender email
        $mail->Password = 'neymar2610'; // Afsenderens adgangskode
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Afsender og modtager oplysninger
        $mail->setFrom('web-tek1801@outlook.dk', 'Dit Navn'); // Afsender
        $mail->addAddress('atek1801@outlook.com'); // Din e-mail, der skal modtage beskederne

        // E-mail indhold
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        // Send e-mail
        if ($mail->send()) {
            header('Location: besked.html');
            exit();
        } else {
            echo 'Der opstod en fejl ved afsendelsen af din besked. Prøv venligst igen.';
        }
        
    } catch (Exception $e) {
        echo "Der opstod en fejl ved afsendelsen af din besked. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Formularen er ikke blevet sendt korrekt.';
}
?>
