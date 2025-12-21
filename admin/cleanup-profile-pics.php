<?php
session_start();
require_once('../dist/config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$uploadDir = __DIR__ . '/../dist/assets/images/profilepics/';

if (!is_dir($uploadDir)) {
  $_SESSION['error'] = 'Profile pictures directory not found.';
  header('Location: settings.php');
  exit();
}

try {
  // Get images currently used
  $stmt = $pdo->query("
    SELECT profile_pic 
    FROM users 
    WHERE profile_pic IS NOT NULL AND profile_pic != ''
  ");
  $usedImages = $stmt->fetchAll(PDO::FETCH_COLUMN);

  $files = scandir($uploadDir);
  $deleted = 0;

  foreach ($files as $file) {
    if ($file === '.' || $file === '..') continue;

    if (!in_array($file, $usedImages)) {
      $path = $uploadDir . $file;
      if (is_file($path) && unlink($path)) {
        $deleted++;
      }
    }
  }

  $_SESSION['success'] = "$deleted unused profile pictures deleted successfully.";

} catch (PDOException $e) {
  error_log('Profile pic cleanup error: ' . $e->getMessage());
  $_SESSION['error'] = 'Failed to clean up profile pictures.';
}

header('Location: settings.php');
exit();
