<?php
require_once 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } else {
        $database = new Database("localhost", "root", "", "pdraivok");
        $database->connect();

        $success = $database->insertData($name, $email, $message);
        if ($success) {
            echo "Message submitted successfully.";
        } else {
            echo "Error submitting message.";
        }

        $database->closeConnection();
    }
}
?>
