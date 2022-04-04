<?php
    session_start();
    
    include('db_connection.php');
    $con = db();
    
    /************* register ************/
    if (isset($_POST['register'])) {
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_psw = $_POST['user_psw'];
        $user_psw2 = $_POST['user_psw2'];
        
        $sql = "SELECT * FROM user WHERE user_email = '$user_email' LIMIT 1";
        $rs = mysqli_query($con, $sql);
        if ($user_psw != $user_psw2) {
            echo "<script language='javascript'>alert('密碼輸入不一致!請重新輸入!', location.href='register.php?user_email=$user_email&user_name=$user_name');</script>"; //位置待改
        }
        else if (empty(mysqli_fetch_row($rs))) {
            $sql = "INSERT INTO user (user_email, user_psw, user_name, identity, status) VALUES ('$user_email', '$user_psw', '$user_name', 'user', 1)";
            mysqli_query($con, $sql);

            echo "<script language='javascript'>alert('註冊成功!', location.href='../betty/index.php');</script>"; //位置待改


            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_idy'] = "user";
        }
        else
        {
            echo "<script language='javascript'>alert('帳號已被註冊！請重新註冊！', location.href='register.php');</script>"; //位置待改
        }
    }
    /************* login ************/
    
    if (isset($_POST['login'])) {
        $user_email = $_POST['user_email'];   
        $user_psw = $_POST['user_psw'];
        
        /************* user ************/
        $sql = "SELECT * FROM user WHERE user_email = '$user_email' AND user_psw = '$user_psw' AND identity = 'user'";
        $rs = mysqli_query($con, $sql);
        $record = mysqli_fetch_row($rs);
        if(empty($record)) {
            echo "<script language='javascript'>alert('帳號密碼錯誤，請重新輸入！', location.href='login.php');</script>";
        }
        else {
            switch ($record[4]) {
            case 1:
                $_SESSION['user_email'] = $user_email;
                $_SESSION['user_name'] = $record[2];
                $_SESSION['user_idy'] = "user";

                header('location: ../betty/index.php'); //位置待改

                break;
            case 0:
                echo "<script language='javascript'>alert('帳號已被停權', location.href='../index.html');</script>"; //位置待改
                break;
            }    
        }
        /************* administrator ************/
        $sql = "SELECT * FROM user WHERE user_email = '$user_email' AND user_psw = '$user_psw' AND identity = 'admin' AND status = 1";
        $rs = mysqli_query($con, $sql);
        $record = mysqli_fetch_row($rs);
        if (!empty($record)) {
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_name'] = $record[2];
            $_SESSION['user_idy'] = "admin";
            header('location: news.php');
        }
        else {
            echo "<script language='javascript'>alert('帳號密碼錯誤，請重新輸入！', location.href='login.php');</script>";
        }
    }
