<?php 
function db(){
    $db = mysqli_connect("????", "????", "????????", "????????");
    return $db;
}

function user(){
    session_start();
      $user_email = "";
      if(!empty($_SESSION['user_email'])){
          $user_email = $_SESSION['user_email'];
          return $user_email;
      }
      else{
          return $user_email;
      }
}
?>