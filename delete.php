<?php
include 'Database.php';
include 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $matric = $_GET['matric'];

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->deleteUser($matric);

    $db->close();

    // Redirect to read page after deletion
    header("Location: read.php");
}
?>
