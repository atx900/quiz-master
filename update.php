<?php
  // calls database connectivity configuration
  include_once 'db-config.php';

  // initialize variables that will tentatively store quiz data to be updated
  $question = "";
  $answer1  = "";
  $answer2  = "";

  // perform checks on the updated quiz data
  if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];

    $inputQuestion = trim($_POST["question"]);
    if (!empty($inputQuestion)) {
      $question = $inputQuestion;
    }

    $inputAnswer1 = trim($_POST["answer1"]);
    if (!empty($inputAnswer1)) {
      $answer1 = $inputAnswer1;
    }

    $inputAnswer2 = trim($_POST["answer2"]);
    if (!empty($inputAnswer2)) {
      $answer2 = $inputAnswer2;
    }

    if (!empty($question) && !empty($answer1) && !empty($answer2)) {

      // declare the sql query to update quiz data stored on the quiz master's database
      $sqlQuery = "UPDATE quiz SET question = ?, answer1 = ?, answer2 = ? WHERE id = ?";

      // prepare the sql statement for execution
      $stmt = mysqli_prepare($dbConnection, $sqlQuery);

      // binds the updated quiz data to the sql statement as paramters; the 's' = string type, 'i' = integer type
      mysqli_stmt_bind_param($stmt, "sssi", $param_question, $param_answer1, $param_answer2, $param_id);
      $param_question = $question;
      $param_answer1 = $answer1;
      $param_answer2 = $answer2;
      $param_id = $id;

      // commits the updated quiz data to database and redirects the user's interface back to the main page
      mysqli_stmt_execute($stmt);
      header("location: index.php");
      exit();

      // closes the prepared sql statement; deallocates the statement handle
      mysqli_stmt_close($stmt);
    }

    // temrinates database connection
    mysqli_close($dbConnection);

  } else {

    // check the quiz's id and retrieve current associated contents
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
      $id = trim($_GET["id"]);

      $sqlQuery = "SELECT * FROM quiz WHERE id = ?";

      $stmt = mysqli_prepare($dbConnection, $sqlQuery);

      // binds the retrieved quiz's id to the SQL statement as a parameter; the 'i' refers to the paramter of being an integer type
      mysqli_stmt_bind_param($stmt, "i", $param_id);
      $param_id = $id;

      // retrieve the current quiz's contents from the database
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      // copy the retrieve contents of the current quiz to its corresponding variables that will be updated later
      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $question = $row["question"];
        $answer1 = $row["answer1"];
        $answer2 = $row["answer2"];
      }

      // frees memory allocated by $result
      mysqli_free_result($result);

      // closes the sql statement; deallocates the statement handle
      mysqli_stmt_close($stmt);

    }

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
      <h1>Quiz Master: Admin Mode (Update)</h1>
    </div>

    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <div class="container-row text-center">
      <span>Please update input data and click Save.</span>
    </div>

    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <!--- content update section --->
    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
      <div class="container-row content-create">
        <span>&nbsp;</span>
        <span>Question:</span>
        <span><input type="text" name="question" value="<?php echo $question; ?>" /></span>
        <span>&nbsp;</span>
        <span>Answer:</span>
        <span><input type="text" name="answer1" value="<?php echo $answer1; ?>" /></span>
        <span>&nbsp;</span>
        <span>Alternative Answer:</span>
        <span><input type="text" name="answer2" value="<?php echo $answer2; ?>" /></span>
        <span><input type="hidden" name="id" value="<?php echo $id; ?>"></span>
        <span><input type="submit" class="btn btn-danger" value="Save"></span>
        <span><a href="index.php" class="btn btn-info">Cancel</a></span>
      </div>
    </form>

  </body>
</html>
