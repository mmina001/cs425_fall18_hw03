<?php
    session_start();
    $source = 'questions.xml';
    // load as string
    $xmlstr = file_get_contents($source);
    $xml=simplexml_load_string($xmlstr) or die("Error: Cannot create object");
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);
    $_SESSION['xml_array']=$array;
    //$array['questions_difficulty_level_one']['multiple_choice_question'][0]['question'];
?>