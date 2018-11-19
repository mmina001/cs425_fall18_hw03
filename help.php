<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="title" content="Questions Game">
  <meta name="author" content="Mariana Mina">
  <meta name="description" content="Implementation of a questions game using PHP">
  <meta name="keywords" content="questions,choices,multiple choice">
  <title>Questions Game</title>
  <link rel="icon" href="" type="image/jpg">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="index-style.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
<header>
    <nav class="navbar fixed-top navbar-expand-sm bg-dark navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="help.php">Help Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="scores.php">High Scores Page</a>
        </li>
      </ul>
    </nav> 
  </header>

  <a href="#top" id="myBtn" title="Go to top">Top</a>

  <h4>This is a questions game related to Internet technologies knowledge. To start the game press the button start.
     By clicking the start button the first question will appear with multiple choice answers. You can select only
     one answer, by clicking on the answer that you think is the correct one. After you choose an answer you must 
     click the Next button. The next button moves you to the next question. You choose again the answer that you believe
     is the correct one and you press again the next button. You repeat this until you reach the last question. As you will 
     see the button of the final question is renamed to Finish. By clicking this button, after you choose an answer of 
     course, you will see for each question if you answered correctly or not, the level of difficulty of the question,
     the score that you have get and your overall score. Also, you can save your overall score by entering a nickname
     in the text box and by clicking the button Save Score. If you do not want to save your score you can press the 
     button Return to start in order to return at start page.  
</h4> 
<footer>
</footer>
</body>
</html>
