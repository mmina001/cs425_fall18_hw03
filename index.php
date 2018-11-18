<?php
  require_once('read_xml.php');
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
      <a class="nav-link" href="#">Help Page</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">High Scores Page</a>
    </li>
  </ul>
</nav>
    </header>

    <form action="question_game_page.php">
      <h1 class="display-4">Welcome to our Questions Game!Are you ready to test your knowledge?</h1>
      <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <input id="start" class="btn btn-primary btn-lg" type="submit" value="Start">
        </div>
      </div>
    </div>
    </form>

</body>

</html>