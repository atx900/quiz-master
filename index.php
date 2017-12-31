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
      <h1>Quiz Master: Admin Mode</h1>
    </div>

    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <div class="container-row create-button">
      <span><a href="create.php" class="btn btn-info">New Question</a></span>
      <span>&nbsp;</span>
    </div>

    <!--- content header section --->
    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <div class="container-row text-center content-header">
      <span>ID #</span>
      <span>Question</span>
      <span>Answer</span>
      <span>Alternative Answer</span>
      <span>Operations</span>
    </div>

    <!--- content section --->
    <div class="container-row text-center content">

      <?php
        // calls database connectivity configuration
        include_once 'db-config.php';

        // declare the sql query that retrieves current quiz data from the quiz master's database
        $sqlQuery = "SELECT * FROM quiz";

        // execute sql query and store returned quiz data to $result
        $result = mysqli_query($dbConnection, $sqlQuery);

        // display retrieve quiz data individually on screen or web page
        if (mysqli_num_rows($result) > 0) {

          while ($row = mysqli_fetch_array($result)) {
            echo "<span>".$row['id']."</span>";
            echo "<span>".$row['question']."</span>";
            echo "<span>".$row['answer1']."</span>";
            echo "<span>".$row['answer2']."</span>";
            echo "<span>
                    <a href='read.php?id=".$row['id']."'> R </a>
                    <a href='update.php?id=".$row['id']."'> U </a>
                    <a href='delete.php?id=".$row['id']."'> D </a>
                  </span>";
          }

          // frees memory allocated by $result
          mysqli_free_result($result);
        }

        // temrinates database connection
        mysqli_close($dbConnection);

      ?>

    </div>

    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>
  </body>
</html>
