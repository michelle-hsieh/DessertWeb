<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>個人頁面</title>

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

    <!-- sierra.css -->
    <link rel="stylesheet" href="css/sierra.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="../betty/betty_style.css" type="text/css">

</head>

<body>

    <?php 
    include "db.php";
    include "../betty/header.php";
    
    #連 database
    $db = db();
    if(!$db){
        echo "db_con_wrong";
    }
    
    #連 user_email session
    $user_email = user();
    if(empty($user_email)){
        header("location:../michelle/login.php");
    }
    else{
        head("islogin");
    }

    ?>
    
    <?php
    
    $check1 = '';
    $check2 = '';
    $check3 = '';
    $method = $_GET['method'];
    
    if($method == "publish"){
        $check1 = 'class="active"';
        $method = "publish";
    }
    else if($method == "unpublish"){
        $check2 = 'class="active"';
        $method = "unpublish";
    }
    else if($method == "love"){
        $check3 = 'class="active"';
        $method = "love";
    }
    
    ?>

    <!-- Blog Section Begin -->
    <section class="blog user_pad">
        <div class="container">
            <div class="row">

                <!-- 左邊導覽列 START -->

                <div class="col-lg-4 col-md-5">
                    <div class="user_sidebar">
                        <div class="user_sidebar_item">
                            <ul>
                                <li><a href="user_detail.php?method=publish" <?php echo $check1; ?>>食譜</a></li>
                                <li><a href="user_detail.php?method=unpublish" <?php echo $check2; ?>>草稿</a></li>
                                <li><a href="user_detail.php?method=love" <?php echo $check3; ?>>我的最愛</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 左邊導覽列 END -->
                <?php
                # 食譜(已發布)
                if($method == "publish"){
                    ?>
                    <div class="col-lg-8 col-md-7 user_bg">
                        <div class="row">
                            <div class="user_report_rec">
                                <p>
                                    食譜
                                </p>
                            </div>

                            <?php
                            $sql2 = "SELECT * FROM recipe WHERE user_email='$user_email' AND rec_status='1' ORDER BY rec_date DESC";
                            $result2 = mysqli_query($db, $sql2);
                            if(mysqli_num_rows($result2) > 0){
                                while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                                    ?>
                                    <form enctype="multipart/form-data" action="recipe_new_con.php" method="post" class="user_report_border">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="unreport_form_image">
                                                    <img src="<?php echo $row['rec_image']; ?>">
                                                </div>

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="write_form">
                                                    <p>
                                                        <?php echo $row['rec_name']; ?>
                                                    </p>

                                                    <input type="hidden" name="rec_id" id="rec_id" value="<?php echo $row['rec_id']; ?>">

                                                    <input type="submit" class="write_form_submit" value="查看食譜" name="list_publish_recipe">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                }
                            }
                            else{
                                ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="write_form">
                                            <input type="button" class="write_form_submit" onclick="javascript:location.href='recipe_new.php'" value="新增食譜">
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                
                    
                
                else if($method == "unpublish"){
                    ?>
                    <div class="col-lg-8 col-md-7 user_bg">
                        <div class="row">
                            <div class="user_report_rec">
                                <p>
                                    草稿
                                </p>
                            </div>

                            <?php
                            $sql3 = "SELECT * FROM recipe WHERE user_email='$user_email' AND rec_status='0' ORDER BY rec_date DESC";
                            $result3 = mysqli_query($db, $sql3);
                            if(mysqli_num_rows($result3) > 0){
                                while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)){
                                    ?>
                                    <form enctype="multipart/form-data" action="recipe_new_con.php" method="post" class="user_report_border">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="unreport_form_image">
                                                    <img src="<?php echo $row['rec_image']; ?>">
                                                </div>

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="write_form">
                                                    <p>
                                                        <?php echo $row['rec_name']; ?>
                                                    </p>

                                                    <input type="hidden" name="rec_id" id="rec_id" value="<?php echo $row['rec_id']; ?>">

                                                    <input type="submit" class="write_form_submit" value="繼續寫食譜" name="list_unpublish_recipe">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                }
                            }
                            else{
                                ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="write_form">
                                            <input type="button" class="write_form_submit" onclick="javascript:location.href='recipe_new.php'" value="新增食譜">
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                
                
                else if($method == "love"){
                    ?>
                    <div class="col-lg-8 col-md-7 user_bg">
                        <div class="row">
                            <div class="user_report_rec">
                                <p>
                                    我的最愛
                                </p>
                            </div>

                            <?php
                            $sql4 = "SELECT * FROM mylike l, recipe r WHERE l.user_email='$user_email' AND l.rec_id=r.rec_id AND r.rec_status='1'";
                            $result4 = mysqli_query($db, $sql4);
                            if(mysqli_num_rows($result4) > 0){
                                while($row = mysqli_fetch_array($result4, MYSQLI_ASSOC)){
                                    ?>
                                    <form enctype="multipart/form-data" action="recipe_new_con.php" method="post" class="user_report_border">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="unreport_form_image">
                                                    <img src="<?php echo $row['rec_image']; ?>">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="write_form">
                                                    <p>
                                                        <?php echo $row['rec_name']; ?>
                                                    </p>

                                                    <input type="hidden" name="rec_id" id="rec_id" value="<?php echo $row['rec_id']; ?>">

                                                    <input type="submit" class="write_form_submit" value="前往食譜" name="list_mylove_recipe">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                }
                            }
                            else{
                                ?>
                                <div class="row">
                                    <div class="col-lg-12 write_form">
                                        <p>
                                            沒有食譜
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>


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
