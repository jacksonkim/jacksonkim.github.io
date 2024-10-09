<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather form data
    $name = htmlspecialchars(trim($_POST['custName']));
    $email = htmlspecialchars(trim($_POST['custEmail']));
    $subject = str_replace('%%CustName%%', $name, htmlspecialchars(trim($_POST['subject'])));
    $comment = htmlspecialchars(trim($_POST['custComment']));
    $state = htmlspecialchars(trim($_POST['custState']));
    $items = isset($_POST['items']) ? implode(", ", $_POST['items']) : 'None';
    $agree = htmlspecialchars(trim($_POST['agree']));

    // Hidden fields
    $sendto = htmlspecialchars(trim($_POST['sendto']));
    $thankyou_url = htmlspecialchars(trim($_POST['thankyou_url']));
    $error_url = htmlspecialchars(trim($_POST['error_url']));

    // Prepare the email body
    $body = "Name: $name\nEmail: $email\nSubject: $subject\nState: $state\nComment: $comment\nFavorite Items: $items\nWould like more items: $agree";
    $headers = "From: $email\r\n";

    // Send the email
    if (mail($sendto, $subject, $body, $headers)) {
        // Redirect to thank you page
        header("Location: $thankyou_url");
        exit();
    } else {
        // Redirect to error page
        header("Location: $error_url");
        exit();
    }
} else {
    echo "Invalid request.";
}
?>
