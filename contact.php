<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if ( empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        http_response_code(400);
        echo "Please fill out all fields correctly.";
        exit;
    }

    $to = "kiranahaniworkspace@gmail.com"; // ganti dengan emailmu
    $subject = "New Contact Form Submission from $name";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $name <$email>";

    if (mail($to, $subject, $body, $headers)) {
        http_response_code(200);
        echo "Email berhasil dikirim!";
    } else {
        http_response_code(500);
        echo "Gagal mengirim email. Silakan coba lagi.";
    }
}
?>