<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
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
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    
    <!--   sierra.css   -->
    <link rel="stylesheet" href="css/sierra.css" type="text/css">
    <link rel="stylesheet" href="../betty/betty_style.css" type="text/css">
</head>

<body>
   
    <?php 
    
    include "../betty/sql.php";
    
    #連資料庫
    $db = db();
    if(!$db){
        echo "db_con_wrong";
    }
    
    #連user_email session
    $user_email = user();
    
    include "../betty/header.php";
    if(!empty($user_email)){
        head("islogin");
    }
    else{
        head("nologin");
    }
    ?>
    
    <!-- 食譜詳細內容 START -->
    <?php
    
    #接收從別的地方送來的rec_id
    if(isset($_GET['rec_id'])){
        $recipe_id = $_GET['rec_id'];
    }
    
    include "recipe_detail_list.php";
    
    $recipe_name = query("recipe_name");
    $recipe_pic = query("recipe_pic");
    $recipe_qty = query("recipe_qty");
    $recipe_cooktime = query("recipe_cooktime");
    $food_name = query("food_name");
    $food_qty = query("food_qty");
    $recipe_step = query("recipe_step");
    $user = query("user_email");
    
    ?>

    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="<?php echo $recipe_pic; ?>" alt="">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <!-- recipe_name -->
                        <h3><?php echo $recipe_name; ?></h3> 
                        <!-- user_name -->
                        <?php
                        $sql3 = "SELECT * FROM user WHERE user_email='$user'";
                        $result3 = mysqli_query($db, $sql3);
                        $row3 = mysqli_fetch_array($result3);
                        $user_name = $row3['user_name'];
                        ?>
                        <p>by <?php echo $user_name; ?></p>
                        
                        <!-- mylike START -->
                        <?php
                        if(!empty($user_email)){
                            $sql1 = "SELECT * FROM mylike WHERE rec_id='$recipe_id' AND user_email='$user_email'";
                            $result1 = mysqli_query($db, $sql1);
                            if(mysqli_num_rows($result1) > 0){
                                ?>
                                <a href="recipe_mylike_con.php?rec_id=<?php echo $recipe_id; ?>&user_email=<?php echo $user_email; ?>&islike=1">
                                    <i class="fa fa-heart heart_icon fa-2x"></i>
                                </a>
                                <?php
                            }
                            else{
                                ?>
                                <a href="recipe_mylike_con.php?rec_id=<?php echo $recipe_id; ?>&user_email=<?php echo $user_email; ?>&islike=0">
                                    <i class="fa fa-heart-o heart_icon fa-2x"></i>
                                </a>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <a href="../michelle/login.php">
                                <i class="fa fa-heart-o heart_icon fa-2x"></i>
                            </a>
                            <?php
                        }
    
                        $sql2 = "SELECT COUNT(*) FROM mylike WHERE rec_id='$recipe_id'";
                        $result2 = mysqli_query($db, $sql2);
                        $row = mysqli_fetch_array($result2);
                        $count = $row[0];
                        ?>
                        <span class="heart_text"><?php echo $count; ?></span>
                        <!-- mylike END -->
                       
                        <ul>
                            <li>    
                                <b>份量(人份)</b> 
                                <span><?php echo $recipe_qty; ?></span>
                            </li>
                            <li>
                                <b>烹調時間(分鐘)</b> 
                                <span><?php echo $recipe_cooktime; ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">食材需求</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">步驟</a>
                            </li>
                        </ul>
                        
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    
                                    <table class="recipe_food_table" align="center">
                                       <?php
                                        for($i = 0; $i < count($food_name); $i++){
                                            ?>
                                            <tr class="recipe_food_tr">
                                                <td class="recipe_food_td">
                                                    <p><?php echo $food_name[$i]; ?></p>
                                                </td>
                                                <td class="recipe_food_td">
                                                    <p><?php echo $food_qty[$i]; ?></p>
                                                    
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <table class="recipe_step_table" align="center">
                                       <?php
                                        $num = 0;
                                        for($i = 0; $i < count($recipe_step); $i++){
                                            $num++;
                                            ?>
                                            <tr class="recipe_food_tr">
                                                <td class="recipe_num_td">
                                                    <p><?php echo $num; ?></p>
                                                </td>
                                                <td class="recipe_step_td">
                                                    <p><?php echo $recipe_step[$i]; ?></p>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 食譜詳細內容 END -->

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
