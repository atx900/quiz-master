<?php
  // MySQL database access setup
  $hostServer = 'localhost';
  $userName = 'root';
  $userPassword = '';
  $databaseName = 'quizmaster';

  // MySQL database connection
  $dbConnection = mysqli_connect($hostServer, $userName, $userPassword, $databaseName);

  // MySQL database connecitivity test
  if ($dbConnection === false) {
    die ("connection failed: " . $dbConnection->connect_error);
  }
?>
