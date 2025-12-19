<?php
// Start the session (if not already started)
session_start();

// Check if the user is logged in before destroying the session
if (isset($_SESSION['user_id'])) {
    // Destroy the session for user
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
} elseif (isset($_SESSION['customer'])) {
    // Destroy the session for a member
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

// Default redirect if no session exists
header("Location: ../index.php");
exit();
?>
