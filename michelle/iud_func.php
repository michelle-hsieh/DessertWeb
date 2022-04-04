<?php
    session_start();
    
    $user_email = $_SESSION['user_email'];
    
    include('db_connection.php');
    $con = db();

    /************* insert news ************/
    if (isset($_POST['insert_news'])) {
        $news_title = $_POST['news_title'];
        $news_content = $_POST['news_content'];
        if($user_email != '' && $news_title != '' && $news_content != '')
        {
            $sql = "INSERT INTO news (user_email, news_title, news_content) VALUES ('$user_email', '$news_title', '$news_content')";
            
            mysqli_query($con, $sql);

            header('location: news.php');
        }
    }
    /************* update news ************/
    if (isset($_POST['update_news'])) {
        $news_id = $_POST['news_id'];
        $news_title = $_POST['news_title'];
        $news_content = $_POST['news_content'];
        
        if($news_title != '' && $news_content != '')
        {
            $sql = "update news set news_date = NOW(), user_email = '$user_email', news_title = '$news_title', news_content = '$news_content' where news_id = '$news_id'";

            mysqli_query($con, $sql);

            header("location: news.php");
        }

    }
    /************* delete news ************/
    if (isset($_GET['del_news'])) {
        $news_id = $_GET['news_id'];
        
        $sql = "DELETE FROM news WHERE news_id = $news_id";
        mysqli_query($con, $sql);
        
        header('location: news.php');
    }
    mysqli_close($con);
?>