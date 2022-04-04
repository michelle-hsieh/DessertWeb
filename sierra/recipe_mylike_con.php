<?php 
include "db.php";
    
#連 database
$db = db();
if(!$db){
    echo "db_con_wrong";
}

#user_email
$user_email = mysqli_real_escape_string($db, $_GET['user_email']);

#recipe_id
$recipe_id = mysqli_real_escape_string($db, $_GET['rec_id']);

#islike
$islike = mysqli_real_escape_string($db, $_GET['islike']);

if($islike == "1"){
    $sql1 = "DELETE FROM mylike WHERE rec_id='$recipe_id' AND user_email='$user_email'";
    mysqli_query($db, $sql1);
    header('location:'.$_SERVER['HTTP_REFERER'].'');
}
else{
    $sql2 = "INSERT INTO mylike (user_email, rec_id) VALUES ('$user_email', '$recipe_id')";
    mysqli_query($db, $sql2);
    header('location:'.$_SERVER['HTTP_REFERER'].'');
}
?>