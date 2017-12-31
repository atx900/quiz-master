<?php
  // calls database connectivity configuration
  include_once 'db-config.php';

  // retrieve the current quiz's id number
  if (isset($_POST["id"]) && !empty($_POST["id"])) {

    // declare sql query to delete a quiz entry from the database based on its id number
    $sqlQuery = "DELETE FROM quiz WHERE id=?";

    // prepare the sql statement for execution
    $stmt = mysqli_prepare($dbConnection, $sqlQuery);

    // binds the current quiz's id to the sql statement as a parameter; the 'i' = integer type
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    $param_id = trim($_POST["id"]);

    // executes the deletion of the quiz entry from the database and redirects the user's interface back to the main page
    mysqli_stmt_execute($stmt);
    header("location: index.php");
    exit();

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
      <h1>Quiz Master: Admin Mode (Delete)</h1>
    </div>

    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <div class="container-row text-center">
      <span>Are you certain on deleting this entry?</span>
    </div>

    <!--- content deletion section --->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="container-row content-delete" text-center>
        <span>&nbsp;</span>
        <span>&nbsp;</span>
        <span>&nbsp;</span>
        <span><span><input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" /></span></span>
        <span><span><input type="submit" value="Yes" class="btn btn-danger"></span></span>
        <span><span><a href="index.php" class="btn btn-info">No</a></span></span>
      </div>
    </form>

  </body>
</html>
