<?php
  session_start();
  //session_destroy();
  $xml_array=$_SESSION['xml_array'];
  $_SESSION['max_questions']=6;
  if(!isset($_SESSION['array_answers'])){
    $_SESSION['array_answers'] = array();
  }
  if(!isset($_SESSION['array_difficulty'])){
    $_SESSION['array_difficulty'] = array();
  }
  if(!isset($_SESSION['difficulty'])){
    $_SESSION['difficulty']=1;
  }
  if(!isset($_SESSION['num_question'])){
    $_SESSION['num_question']=1;
  }
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
  <script type="text/javascript">
    function hide_div() {
      document.getElementById("questions_page").style.display="none"; 
    }
  </script>
</head>

<body>
  <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['Next']) || isset($_POST['Finish'])) {
        $_SESSION['num_question'] += 1 ;
      } 
      if(isset($_POST['choice_btn'])){
        array_push($_SESSION['array_difficulty'],$_SESSION['difficulty']);
        $choice = $_POST['choice_btn'];
        $correct = $xml_array['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['correct'];
        if(strcmp($choice,$correct) == 0){
          array_push($_SESSION['array_answers'],1);
          if($_SESSION['difficulty']==1 || $_SESSION['difficulty']==0){
            $_SESSION['difficulty'] += 1; 
          }
        }else{
          array_push($_SESSION['array_answers'],0);
          if($_SESSION['difficulty']==1 || $_SESSION['difficulty']==2){
            $_SESSION['difficulty'] -= 1; 
          }
        }
      }
      if (isset($_POST['Finish'])) {
        $_SESSION['overall_score'] = 0;
        for($i=0;$i<$_SESSION['max_questions'];$i++){
          if($_SESSION['array_answers'][$i]==1){
            if($_SESSION['array_difficulty'][$i]==0){
              $_SESSION['overall_score']+=10;
            }else if($_SESSION['array_difficulty'][$i]==1){
              $_SESSION['overall_score']+=20;
            }else if($_SESSION['array_difficulty'][$i]==2){
              $_SESSION['overall_score']+=40;
            } 
          }
        }
      }
      if (isset($_POST['saveScore'])) {
        $file = fopen("players_scores.txt", "a") or die("Unable to open file!");
        $txt =  $_POST['nickname']."\t".$_SESSION['overall_score']."\n"; 
        fwrite($file, $txt);
        fclose($file);
      }
    }
    $_SESSION['random']=mt_rand(0,24);
  ?>
  <!--<header>
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
  </header>-->

  <form action="" method="post">
    <?php if($_SESSION['num_question']<=$_SESSION['max_questions']){ ?>
      <h1 class="display-4"><?php echo $xml_array['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['question'];?><h1>
      <label><input type="radio" name="choice_btn" value="<?php echo $xml_array['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][0];?>"/><?php echo $xml_array['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][0];?></label>
      <label><input type="radio" name="choice_btn" value="<?php echo $xml_array['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][1];?>"/><?php echo $xml_array['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][1];?></label>
      <label><input type="radio" name="choice_btn" value="<?php echo $xml_array['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][2];?>"/><?php echo $xml_array['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][2];?></label>
      <label><input type="radio" name="choice_btn" value="<?php echo $xml_array['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][3];?>"/><?php echo $xml_array['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][3];?></label>
      <label><?php echo $_SESSION['num_question'] ?></label><label>/</label><label><?php echo $_SESSION['max_questions'] ?></label>
      <?php if($_SESSION['num_question']<$_SESSION['max_questions']){ ?>
        <input type="submit" value="Next" name="Next" />
      <?php }else if($_SESSION['num_question']==$_SESSION['max_questions']){ ?>
        <input type="submit" value="Finish" name="Finish" />
      <?php } ?>
    <?php }else{  ?> 
      <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Answer</th>
            <th scope="col">Level of Difficulty</th>
            <th scope="col">Score</th>
          </tr>
        </thead>
        <tbody>
      <?php
        for($i=0;$i<$_SESSION['max_questions'];$i++){ ?>
            <tr>
              <th scope="row"><?php $tmp=$i+1; echo $tmp; ?></th>
              <td><?php if($_SESSION['array_answers'][$i]==1) { echo "Correct"; }else { echo "Wrong"; } ?></td>
              <td><?php if($_SESSION['array_difficulty'][$i]==0) { echo "1"; }else if($_SESSION['array_difficulty'][$i]==1) { echo "2";}else{echo "3"; } ?></td>
              <td><?php if($_SESSION['array_answers'][$i]==1){if($_SESSION['array_difficulty'][$i]==0) { echo "10"; }else if($_SESSION['array_difficulty'][$i]==1) { echo "20";}else{echo "40"; }}else{echo "0";} ?></td>
            </tr>
        <?php
        } ?>
        </tbody>
      </table> 
      <br>
      <h2 style="text-align:center">Overall Score: <?php echo $_SESSION['overall_score'] ?></h2>   
      <div class="form-group">
        <input type="text" class="form-control form-control-lg" placeholder="Enter a nickname" name="nickname">
      </div>
      <input type="submit" value="Save Score" name="saveScore" />
      <?php } 
      ?>
    </div>
  </form>
</body>
</html>
