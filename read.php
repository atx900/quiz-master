<?php
  // calls database connectivity configuration
  include_once 'db-config.php';

  // retrieve the current quiz's id number
  if (isset($_GET["id"]) && !empty($_GET["id"])) {

    // declare sql query to retrieve associated quiz data based on the current quiz's id number
    $sqlQuery = "SELECT * FROM quiz WHERE id = ?";

    // prepare the sql statement for execution
    $stmt = mysqli_prepare($dbConnection, $sqlQuery);

    // binds the current quiz's id to the sql statement as a parameter; the 'i' = integer type
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    $param_id = trim($_GET["id"]);

    // execute the retrieval of associated quiz data from the database
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // copy retrieved associated quiz data to the corresponding variables for viewing / to be rendered on the web page
    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $question = $row["question"];
      $answer1 = $row["answer1"];
      $answer2 = $row["answer2"];
    }

    // closes the prepared sql statement; deallocates the statement handle
    mysqli_stmt_close($stmt);

    // temrinates database connection
    mysqli_close($dbConnection);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="stylesheets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheets/bootstrap/qm.css">
    <title>Quiz Master</title>
  </head>
  <body class="container-fluid">

    <!--- header section --->
    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <div class="container-row text-center">
      <h1>Quiz Master: Admin Mode (Read)</h1>
    </div>

    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <!--- content read section --->
    <form action="" method="post">
      <div class="container-row content-create">
        <span>&nbsp;</span>
        <span>Question:</span>
        <span><?php echo $row["question"]; ?></span>
        <span>&nbsp;</span>
        <span>Answer:</span>
        <span><?php echo $row["answer1"]; ?></span>
        <span>&nbsp;</span>
        <span>Alternative Answer:</span>
        <span><?php echo $row["answer2"]; ?></span>
        <span>&nbsp;</span>
        <span><a href="index.php" class="btn btn-info">Back</a></span>
        <span>&nbsp;</span>
      </div>
    </form>

  </body>
</html>
