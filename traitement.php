<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envoie de message</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <?php
    if (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN'] == "http://localhost:8000") {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // On vérifie que le champ "Pot de miel" est vide
            if (empty($_POST['raison'])) {
                header('Location: index.php');
            } else {
                // On prépare l'URL
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=6LfoXTAnAAAAAPrYn7lImXRNkTdJ29vA7DFnWdU7&response={$_POST['raison']}";

                // On vérifie si curl est installé
                if (function_exists('curl_version')) {
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_HEADER, false);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_TIMEOUT, 1);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    $response = curl_exec($curl);
                } else {
                    // On utilisera file_get_contents
                    $response = file_get_contents($url);
                }

                // On vérifie qu'on a une réponse
                if (empty($response) || is_null($response)) {
                    header('Location: index.php');
                } else {
                    $data = json_decode($response);
                    if ($data->success) {
                        // Google a répondu avec un succès
                        // Traitement du formulaire
                        // On vérifie tous les champs sont remplis
                        if (
                            isset($_POST['lastname']) && !empty($_POST['lastname']) && isset($_POST['firstname']) && !empty($_POST['firstname']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['sujet']) && !empty($_POST['sujet']) && isset($_POST['message']) && !empty($_POST['message']) && htmlspecialchars($_POST['message'])
                        ) {
                            // Nettoyage du contenu
                            $nom = strip_tags($_POST['lastname']);
                            $prenom = strip_tags($_POST['firstname']);
                            $email = strip_tags($_POST['email']);
                            $sujet = strip_tags($_POST['sujet']);
                            $message = $_POST['message'];
                            try {
                                //Server settings
                                // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbosse debug output
                                $mail->isSMTP(); // Send using SMTP
                                $mail->Host = 'pie.o2switch.net'; // Set the SMTP server to send through
                                $mail->SMTPAuth = true; // Enable SMTP Authentification
                                $mail->SMTPSecure = 'tls';
                                $mail->Username = 'wi11remi@wiremi.fr'; // SMTP username
                                $mail->Password = 'S@?Heh-Reyj$'; // SMTP Password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                $mail->Port  = 587;  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
                                //Recipients
                                $mail->setFrom($email, 'WebCV - TSSR');
                                $mail->addAddress('wi11remi@wiremi.fr', 'WebCV');     // Add a recipient
                                $mail->addBCC('wiremi.mailpro@gmail.com');
                                if ($mail->addReplyTo($email, $nom)) {
                                    $mail->Subject = $sujet;
                                    $mail->isHTML(true);
                                    $mail->CharSet = 'UTF-8';
                                    // $body = "";
                                    $body = "<p style='text-align:center'><strong>Message envoyé par le formulaire de contact du webCV :</strong><br>" . $prenom . " " . $nom . " (" . $email . ")</p>";
                                    $body .= "<p><strong><u>Objet :</u></strong> " . $sujet . "</p>";
                                    $body .= "<p><strong><u>Message :</u></strong></p>";
                                    $body .= $message;
        
                                    $mail->Body = $body;
                                    $mail->send();
                                    echo "Votre message a été bien envoyé";
                                    header('Location: index.php');
                                }
                            } catch (Exception $e) {
                                echo "Le message n'a pas pu être envoyé. Le message d'erreur : {$mail->ErrorInfo}";
                            }
                        }
                    } else {
                        header('Location: index.php');
                    }
                }

            }
        } else {
            http_response_code(405);
            echo "Méthode non autorisé";
        }
    }
    ?>
</body>

</html>