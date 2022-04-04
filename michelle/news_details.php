<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>最新消息-內文</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">

    <link rel="stylesheet" href="../betty/betty_style.css" type="text/css">
    
    <!-- hoverable hyperlink -->
    <style type="text/css">
        .checkout__form h4 a:hover {
            background-color: #f2eee5;             
        }
    </style>
</head>

<body>
    <?php
    header("Content-Type:text/html; charset=utf-8");
    include "../betty/sql.php";
    include "../betty/header.php";
    $user_email=user();
    $idy=$_SESSION['user_idy'];
    if(!empty($user_email)&&$idy=='user'){
        head("islogin");
    }elseif(!empty($user_email)&&$idy=='admin'){
        head("manlogin");
    }else{
        head("nologin");
    }
    ?>

    <!-- News Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <?php
                    if ($_GET['reader'] == 'user' && $_GET['loc'] == 'all') {
                        $url = 'news_user.php';
                    }
                    else if ($_GET['reader'] == 'user' && $_GET['loc'] == 'index')
                    {
                        $url = '../betty/index.php'; //改為首頁(位置待改
                    }
                    else {
                        $url = 'news.php';
                    }
                ?>
                <h4><a href=<?php echo $url; ?> style="color: black;"><span class="fa fa-angle-left"></span>&nbsp;返回最新消息</a></h4>
                <div class="row">
                    <?php
                        $news_id = $_GET['news_id'];
                        
                        $con = db();
                        
                        $sql = "SELECT * FROM news, user WHERE news.user_email = user.user_email AND news_id = '$news_id'";
                        $rs = mysqli_query($con, $sql);
                        
                        while($record = mysqli_fetch_row($rs))
                        {
                    ?>
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>作者：<?php echo $_SESSION['user_name']?></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p><?php echo $record[3]?></p>
                                </div>
                            </div>
                        </div>
                        <b><h3><?php echo $record[1]?></h3></b>
                        <br>
                        <div class="checkout__input">
                            <p><?php echo $record[2]?></p>
                        </div>
                    </div>
                    <?php
                        }
                        mysqli_close($con);
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- News Section End -->

    <!-- Js Plugins -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.nice-select.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/jquery.slicknav.js"></script>
    <script src="../js/mixitup.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/main.js"></script>

 

</body>

</html>