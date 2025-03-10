<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiving_email_address = 'habibfebriansyah453@gmail.com'; // Email tujuan

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Server SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'habibfebriansyah453@gmail.com'; // Ganti dengan email Anda
        $mail->Password   = 'password_aplikasi_gmail_anda'; // Ganti dengan password aplikasi Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Pengaturan email pengirim dan penerima
        $mail->setFrom($email, $name);
        $mail->addAddress($receiving_email_address);

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "<b>Nama:</b> $name <br> <b>Email:</b> $email <br> <b>Pesan:</b> <br> $message";

        if ($mail->send()) {
            echo 'Pesan berhasil dikirim!';
        } else {
            echo 'Pesan gagal dikirim.';
        }
    } catch (\Exception $e) {
        echo "Pesan gagal dikirim. Error: {$mail->ErrorInfo}";
    }
}
?>
