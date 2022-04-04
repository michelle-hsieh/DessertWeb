<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Dessert Dessert">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dessert Dessert</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="owl.carousellast.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
   <!-- <link rel="stylesheet" href="../css/style.css" type="text/css"> -->

    <link rel="stylesheet" href="betty_style.css" type="text/css">
</head>

<body>
    <?php
    
    include "sql.php";
    $link = db();
    $user_email = user();
    
    include "header.php";
    if(!empty($user_email)){
        head("islogin");
    }
    else{
        head("nologin");
    }
    
    ?>
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__item set-bg" data-setbg="../img/blueberrycake.jpg">
                        <div class="hero__text">
                            <span>FLOUR POWER</span>
                            <h2>Dessert <br />100% Handmade</h2>
                            <p>Baking people happy</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="../img/sort/sortcake.jpg">
                            <h5><a href="sort.php?method=蛋糕">蛋糕
                            </a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="../img/sort/sortcookie.png">
                            <h5><a href="sort.php?method=餅乾">餅乾</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="../img/sort/sortpudding.png">
                            <h5><a href="sort.php?method=布丁果凍">布丁&果凍</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="../img/sort/sortsweetsoup.jpg">
                            <h5><a href="sort.php?method=甜湯">甜湯</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="../img/sort/bread.jpg">
                            <h5><a href="sort.php?method=麵包">麵包
                            </a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="../img/sort/chocolate.jpg">
                            <h5><a href="sort.php?method=巧克力糖果">巧克力&糖果</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="../img/sort/pancake.png">
                            <h5><a href="sort.php?method=鬆餅">鬆餅</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="../img/sort/pie.jpg">
                            <h5><a href="sort.php?method=塔派">派塔</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

        <!-- Latest Product Section Begin -->

        <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="latest-product__text">
                        <h4>最新發布食譜</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="bg">
                            <?php
                                $sql2 = 'SELECT * FROM recipe r,user u where r.user_email = u.user_email and r.rec_status = 1 ORDER BY rec_date DESC limit 5';
                                $result2 = mysqli_query($link, $sql2);
                                if(mysqli_num_rows($result2) > 0){
                                    while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                                        ?>
                                            <a href="../sierra/recipe_detail.php?rec_id=<?php echo $row2['rec_id']?>" class="latest-product__item">
                                                <div class="latest-product__item__pic">
                                                    <img src="<?php echo $row2['rec_image']; ?>" alt="NO PIC">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <span><?php echo $row2['rec_name']; ?></span>
                                                    <h6>作者:<?php echo $row2['user_name'] ?></h6>
                                                </div>
                                            </a>   
                                       <?php
                                        }
                                }
                                
                            ?> 
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="latest-product__text">
                        <h4>熱門食譜</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="bg">
                            <?php
                                $sql3 = 'SELECT m.rec_id, rec_name, rec_image, COUNT(m.rec_id) as rec_count, u.user_name FROM recipe r, mylike m,user u where r.user_email = u.user_email and r.rec_id=m.rec_id  and r.rec_status = 1 group by m.rec_id order by rec_count DESC limit 5';
                                $result3 = mysqli_query($link, $sql3);
                                if(mysqli_num_rows($result3) > 0){
                                    while($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)){
                                    ?>
                                        <a href="../sierra/recipe_detail.php?rec_id=<?php echo $row3['rec_id']?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="<?php echo $row3['rec_image']; ?>">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <span><?php echo $row3['rec_name']; ?></span>
                                                <h6>作者:<?php echo $row3['user_name'] ?></h6>
                                            </div>
                                        </a>    
                                   <?php
                                    }
                                }
                                else{
                                    echo "nothing";
                                }
                           
                            ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->

    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>最新消息</h2>
                    </div>
                </div>
            </div>
            <div class="row">
        <!-- 連接資料庫 -->
        <?php
            $sql1 = 'SELECT * FROM dessert.news ORDER BY news_date DESC limit 6';
            $result = mysqli_query($link, $sql1);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            
        ?>
            
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i><?php echo $row['news_date'] ?></li>
                            </ul>
                            <h5><a href="../michelle/news_details.php?news_id=<?php echo $row['news_id'] ?>&reader=user&loc=index"><?php echo $row['news_title'] ?></a></h5>
                            <a href="../michelle/news_details.php?news_id=<?php echo $row['news_id'] ?>&reader=user&loc=index" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                        </div>
                    </div>
                </div>
            <?php
            }
            mysqli_close($link);
            ?>
            </div>
            <div align = 'center'>
                <a href="../michelle/news_user.php" class="primary-btn cart-btn">更多最新消息</a>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
            
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