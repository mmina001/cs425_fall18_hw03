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
  <link rel="icon" href="favicon.png" type="image/png">
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
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="help.php">Help Page</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="scores.php">High Scores Page</a>
        </li>
      </ul>
    </nav> 
</header>

<a href="#top" id="myBtn" title="Go to top">Top</a>

<?php
    if (!file_exists('players_scores.txt')){ ?>
        <h1 class="display-4">No scores to display</h1>
    <?php }else {
        $array = file('players_scores.txt');
        $size=sizeof($array);
        $scores=array();
        $nicknames=array();
        for($i=0;$i<$size;$i++){
            $tmp_array = explode("\t", $array[$i]);
            array_push($nicknames,$tmp_array[0]);
            array_push($scores,$tmp_array[1]);
        }

        $max = $scores[0]; 
        $max_nickname = $nicknames[0]; 
        for($i=1;$i<$size;$i++){
            if($max<$scores[$i]){
                $tmp_score=$scores[$i];
                $scores[$i]=$max;
                $max=$tmp_score;
                $tmp_name=$nicknames[$i];
                $nicknames[$i]=$max_nickname;
                $max_nickname=$tmp_name;
            }
        }

        if($size>10){
            $size=10;
        } ?>
        <h1 class="display-4"><?php echo "Top $size players" ?></h1>
        <div class="table-responsive">
        <table id="scores_t" class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nickname</th>
              <th scope="col">Score</th>
            </tr>
          </thead>
          <tbody>
        <?php
          for($i=0;$i<$size;$i++){ ?>
              <tr>
                <th scope="row"><?php $tmp=$i+1; echo $tmp; ?></th>
                <td><?php echo $nicknames[$i]; ?></td>
                <td><?php echo $scores[$i]; ?></td>
              </tr>
          <?php
          } ?>
          </tbody>
        </table> 
        <br>
    <?php } ?>
    <footer>
    </footer>
</body>
</html>
