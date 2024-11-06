<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Charger l'autoloader de Composer
require '../vendor/autoload.php'; // Vérifiez que le chemin est correct

$receiving_email_address = 'andoghekrist@gmail.com';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email']; // Adresse e-mail de l'utilisateur
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Créer une nouvelle instance de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurer le serveur SMTP
        $mail->isSMTP(); 
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true; 
        $mail->Username = 'andoghekrist@gmail.com'; // Votre adresse Gmail pour l'authentification
        $mail->Password = 'jeqn sglw agse uwlk'; // Votre mot de passe ou mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port = 587; 

        // **Configurer l'adresse de l'expéditeur à partir du formulaire**
        $mail->setFrom($email, $name); // Utiliser l'email et le nom fournis par l'utilisateur
        $mail->addAddress($receiving_email_address); // Ajouter le destinataire

        // Contenu de l'e-mail
        $mail->isHTML(true); 
        $mail->Subject = $subject; 
        $mail->Body    = 'From: ' . $name . '<br>Email: ' . $email . '<br>Message: ' . nl2br($message); 

        // Envoyer l'e-mail
        $mail->send();
        echo 'Message envoyé avec succès !';
    } catch (Exception $e) {

        echo "Le message n'a pas pu être envoyé. Erreur de Mailer: {$mail->ErrorInfo}";
    }
}
?>
