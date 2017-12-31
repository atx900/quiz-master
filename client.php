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
      <h1>Quiz Master</h1>
    </div>

    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <!--- content display section --->
    <div class="container-row text-center">
      <span id="questionTitle">
        <h2 id="questionTitleHere">Question:</h2>
      </span>
    </div>

    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <!--- show question here  --->
    <div id="displayQuestion" class="container-row text-center">
      <!--- quiz question placed here --->
    </div>

    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <!--- user input here --->
    <div class="container-row text-center">
      <span id="userInputHere">
        <input type="text" id="userAnswer" value="" autofocus/>
      </span>
    </div>

    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <!--- user submit button here --->
    <div id="submitButtonHere" class="container-row text-center">
      <span>
        <button class="btn btn-default" id="userClickAnswer" name="button">Submit Answer</button>
      </span>
    </div>

    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <div id="qmFeedback" class="container-row text-center">
      <span id="feedBack">&nbsp;</span>
    </div>

    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>


    <!--- database content retrival section --->
    <div class="container-row text-center">
      <span>&nbsp;</span>
    </div>

    <div class="container-row text-center content-client">

      <?php
        // calls database connectivity configuration
        include_once 'db-config.php';

        // declare the sql query that retrieves current quiz data from the quiz master's database
        $sqlQuery = "SELECT * FROM quiz";

        // execute sql query and store returned quiz data to $result
        $result = mysqli_query($dbConnection, $sqlQuery);

        // tentatively store retrieved quiz data on hidden DOM elements for later use by the qm.js (description below)
        if (mysqli_num_rows($result) > 0) {

          while ($row = mysqli_fetch_array($result)) {
            echo "<span hidden id='quiz_id'>".$row['id']."</span>";
            echo "<span hidden id='quiz_question'>".$row['question']."</span>";
            echo "<span hidden id='quiz_answer1'>".$row['answer1']."</span>";
            echo "<span hidden id='quiz_answer2'>".$row['answer2']."</span>";
            echo "<span>&nbsp;</span>";
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

    <!--- calls JavaScript (ES5) that handles both DOM manipulation and client-side quiz operations --->
    <script src="scripts/qm.js" charset="utf-8"></script>
  </body>
</html>
