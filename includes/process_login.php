<?php
include_once '../../private/db_connect.php';
include_once '../../private/functions.php';
 
sec_session_start();
 
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.
 
    if (login($email, $password, $mysqli) == true) {
        // Login success 
        header('Location: ../tutorarea.php?dir=/');
    } else {
        // Login failed 
        header('Location: ../login.php?error=1');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}