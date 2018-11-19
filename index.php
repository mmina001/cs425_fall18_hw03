<?php
  session_start();
  $_SESSION['max_questions']=6;
  if(!isset($_SESSION['xml_array'])){
    $source = 'questions.xml';
    // load as string
    $xmlstr = file_get_contents($source);
    $xml=simplexml_load_string($xmlstr) or die("Error: Cannot create object");
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);
    $_SESSION['xml_array']=$array;
  }
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
  if(!isset($_SESSION['flag'])){
    $_SESSION['flag']=0;
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="index-style.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
  <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['Start'])){
        $_SESSION['flag']=1;
      }
      if (isset($_POST['Next']) || isset($_POST['Finish'])) {
        $_SESSION['num_question'] += 1 ;
      } 
      if(isset($_POST['choice_btn'])){
        array_push($_SESSION['array_difficulty'],$_SESSION['difficulty']);
        $choice = $_POST['choice_btn'];
        $correct = $_SESSION['xml_array']['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['correct'];
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
        array_splice($_SESSION['xml_array']['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'], $_SESSION['random'], 1);
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
        $txt =  $_POST['nickname']."\t".$_SESSION['overall_score']."\n"; 
        if(file_put_contents("players_scores.txt", $txt,FILE_APPEND) === strlen($txt)){
        }else{
        }
        session_unset();
        session_destroy();
        echo "<meta http-equiv='refresh' content='0'>";
        exit;
      }

      if (isset($_POST['returnStart'])) {
        session_unset();
        session_destroy();
        echo "<meta http-equiv='refresh' content='0'>";
        exit;
      }

    }
    if($_SESSION['flag']==1){
      $max=sizeof($_SESSION['xml_array']['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question']);
      $max-=1;
      $_SESSION['random']=mt_rand(0,$max);
    }
  ?>
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

  <form action="" method="post">
    <?php if($_SESSION['flag']==0) { ?>
      <h1 class="display-4">Welcome to our Questions Game!Are you ready to test your knowledge?</h1>
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <input id="start" class="btn btn-primary btn-lg" type="submit" value="Start" name="Start" />
          </div>
        </div>
      </div>
    <?php }else {
      if($_SESSION['num_question']<=$_SESSION['max_questions']){ ?>
        <h1 class="display-4"><?php echo $_SESSION['xml_array']['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['question'];?><h1>
        <label><input type="radio" name="choice_btn" value="<?php echo $_SESSION['xml_array']['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][0];?>"/><?php echo $_SESSION['xml_array']['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][0];?></label>
        <br>
        <label><input type="radio" name="choice_btn" value="<?php echo $_SESSION['xml_array']['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][1];?>"/><?php echo $_SESSION['xml_array']['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][1];?></label>
        <br>
        <label><input type="radio" name="choice_btn" value="<?php echo $_SESSION['xml_array']['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][2];?>"/><?php echo $_SESSION['xml_array']['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][2];?></label>
        <br>
        <label><input type="radio" name="choice_btn" value="<?php echo $_SESSION['xml_array']['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][3];?>"/><?php echo $_SESSION['xml_array']['questions_difficulty'][$_SESSION['difficulty']]['multiple_choice_question'][$_SESSION['random']]['choice'][3];?></label>
        <br><br>

        <div>
          <label><?php echo $_SESSION['num_question'] ?></label>
          <label>/</label>
          <label><?php echo $_SESSION['max_questions'] ?></label>
        </div>
        <br>
        <?php if($_SESSION['num_question']<$_SESSION['max_questions']){ ?>
          <input  class="btn btn-success btn-lg" type="submit" value="Next" name="Next" id="next" />
        <?php }else if($_SESSION['num_question']==$_SESSION['max_questions']){ ?>
          <input class="btn btn-danger btn-lg" type="submit" value="Finish" name="Finish" id="finish" />
        <?php } 
      }else { ?> 
         <h1 class="display-4">Score</h1>
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
        <h2 style="text-align:center">Overall Score: <?php echo $_SESSION['overall_score'] ?></h2>   
        <div class="form-group">
          <input type="text" class="form-control form-control-lg" placeholder="Enter a nickname" name="nickname">
        </div>
        <div class="col-12 text-center">
          <input class="btn btn-danger btn-lg" type="submit" value="Save Score" name="saveScore" id="save" />
          <input class="btn btn-primary btn-lg" type="submit" value="Return to start" name="returnStart" id="return" />
        </div>
      <?php } 
    } ?>
    </div>
  </form>

  <footer>
  </footer>
</body>
</html>
