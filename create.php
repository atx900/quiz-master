<?php
  // calls database connectivity configuration
  include_once 'db-config.php';

  // initialize variables that will store new quiz data
  $question = "";
  $answer1 = "";
  $answer2 = "";

  // perform checks on the new quiz data
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputQuestion = trim($_POST["question"]);
    if (!empty($inputQuestion)) {
      $question = $inputQuestion;
    }

    $inputAnswer1 = strtoLower(trim($_POST["answer1"]));
    if (!empty($inputAnswer1)) {
      $answer1 = $inputAnswer1;
    }

    $inputAnswer2 = strtoLower(trim($_POST["answer2"]));
    if (!empty($inputAnswer2)) {
      $answer2 = $inputAnswer2;
    }

    if (!empty($question) && !empty($answer1) && !empty($answer2)) {

      // declare the sql query to insert the new quiz data on the quiz master's database
      $sqlQuery = "INSERT INTO quiz (question, answer1, answer2) VALUES (?, ?, ?)";

      // prepare the sql statement for execution
      $stmt = mysqli_prepare($dbConnection, $sqlQuery);

      // binds the new quiz data to the prepared sql statement as paramters; the 's' = string type
      mysqli_stmt_bind_param($stmt, "sss", $param_question, $param_answer1, $param_answer2);
      $param_question = $question;
      $param_answer1 = $answer1;
      $param_answer2 = $answer2;

      // commits the new quiz data to database and redirects the user's interface back to the main page
      mysqli_stmt_execute($stmt);
      header("location: index.php");
      exit();

      // closes the prepared sql statement; deallocates the statement handle
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
      <h1>Quiz Master: Admin Mode (Create)</h1>
    </div>

    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <!--- content creation section --->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="container-row content-create">
        <span>&nbsp;</span>
        <span>Question:</span>
        <span><input type="text" name="question" value="<?php echo $question; ?>" placeholder="Type question here" /></span>
        <span>&nbsp;</span>
        <span>Answer:</span>
        <span><input type="text" name="answer1" value="<?php echo $answer1; ?>" placeholder="Type answer here" /></span>
        <span>&nbsp;</span>
        <span>Alternative Answer:</span>
        <span><input type="text" name="answer2" value="<?php echo $answer2; ?>" placeholder="Type alternative answer" /></span>
        <span>&nbsp;</span>
        <span><button class="btn btn-danger" name="btn-save" value="Submit">Save</button></span>
        <span><a href="index.php" class="btn btn-info">Cancel</a></span>
      </div>
    </form>

  </body>
</html>
