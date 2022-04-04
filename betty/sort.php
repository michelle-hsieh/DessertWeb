<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="分類">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分類</title>

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
    <!-- <link rel="stylesheet" href="../css/style.css" type="text/css"> -->

    <link rel="stylesheet" href="betty_style.css" type="text/css">
</head>

<body>
    <?php
    include "sql.php";
    $link = db();
    #連 user_email session
    $user_email = user();
    
    include "header.php";
    if(!empty($user_email)){
        head("islogin");
    }
    else{
        head("nologin");
    }
    
    ?>
    <?php

    $active1 = "";
    $active2 = "";
    $active3 = "";
    $active4 = "";
    $active5 = "";
    $active6 = "";
    $active7 = "";
    $active8 = "";
    $allactive = "";

    if($_GET['method'] == "蛋糕"){
        $filter = ".蛋糕";
        $active1 = 'class="active"';
    }elseif($_GET['method'] == "餅乾"){
        $filter = ".餅乾";
        $active2 = 'class="active"';
    }elseif($_GET['method'] == "布丁果凍"){
        $filter = ".布丁果凍";
        $active3 = 'class="active"';
    }elseif($_GET['method'] == "甜湯"){
        $filter = ".甜湯";
        $active4 = 'class="active"';
    }elseif($_GET['method'] == "巧克力糖果"){
        $filter = ".巧克力糖果";
        $active5 = 'class="active"';
    }elseif($_GET['method'] == "麵包"){
        $filter = ".麵包";
        $active6 = 'class="active"';
    }elseif($_GET['method'] == "鬆餅"){
        $filter = ".鬆餅";
        $active7 = 'class="active"';
    }elseif($_GET['method'] == "派塔"){
        $filter = ".派塔";
        $active8 = 'class="active"';
    }elseif($_GET['method'] == "全部"){
        $filter = "";
        $allactive = 'class="active"';}
    ?>
    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>全部分類</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li <?php echo $allactive ?> data-filter="*"><a href="sort.php?method=全部" style="color:black;">全部</a></li>
                            <li <?php echo $active1 ?> data-filter=".蛋糕"><a href="sort.php?method=蛋糕" style="color:black;">蛋糕</a></li>
                            <li <?php echo $active2 ?> data-filter=".餅乾"><a href="sort.php?method=餅乾" style="color:black;">餅乾</a></li>
                            <li <?php echo $active3 ?> data-filter=".布丁果凍"><a href="sort.php?method=布丁果凍" style="color:black;">布丁&果凍</a></li>
                            <li <?php echo $active4 ?> data-filter=".甜湯"><a href="sort.php?method=甜湯" style="color:black;">甜湯</a></li>
                            <li <?php echo $active5 ?> data-filter=".巧克力糖果"><a href="sort.php?method=巧克力糖果" style="color:black;">巧克力&糖果</a></li>
                            <li <?php echo $active6 ?> data-filter=".麵包"><a href="sort.php?method=麵包" style="color:black;">麵包</a></li>
                            <li <?php echo $active7 ?> data-filter=".鬆餅"><a href="sort.php?method=鬆餅" style="color:black;">鬆餅</a></li>
                            <li <?php echo $active8 ?> data-filter=".派塔"><a href="sort.php?method=派塔" style="color:black;">派塔</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php
                $sort = $_GET['method'];
                if($sort == "全部"){
                    $sql1 = "SELECT * FROM recipe r,user u where r.user_email = u.user_email and rec_status =1";
                    $result1 = mysqli_query($link, $sql1);
                    if(mysqli_num_rows($result1) > 0){
                        while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){

                            ?>

                            <div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo $filter ?>">

                                <div class="featured__item">
                                    <div class="featured__item__pic set-bg" data-setbg="<?php echo $row1['rec_image'] ?>">
                                    </div>
                                    <div class="featured__item__text">
                                        <h6>
                                            <a href="../sierra/recipe_detail.php?rec_id=<?php echo $row1['rec_id']?>"><?php echo $row1['rec_name'] ?>
                                            </a>
                                        </h6>
                                        <h6>作者:<?php echo $row1['user_name'] ?></h6>

                                    </div>
                                </div>
                            </div>
                            <?php
                        }   
                    }
                }
                else{
                    $sql = "SELECT * FROM recipe r,user u where rec_sort = '$sort' and r.user_email = u.user_email and rec_status =1";
                    $result = mysqli_query($link,$sql);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

                            ?>

                            <div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo $filter ?>">

                                <div class="featured__item">
                                    <div class="featured__item__pic set-bg" data-setbg="<?php echo $row['rec_image'] ?>">
                                    </div>
                                    <div class="featured__item__text">
                                        <h6><a href="../sierra/recipe_detail.php?rec_id=<?php echo $row['rec_id']?>"><?php echo $row['rec_name'] ?></a></h6>
                                        <h6>作者:<?php echo $row['user_name'] ?></h6>

                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                mysqli_close($link);
                ?>
            </div>
        </div>

    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

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
