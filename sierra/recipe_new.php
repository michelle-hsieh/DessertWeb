<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新增食譜</title>

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
    <link rel="stylesheet" href="css/sierra.css" type="text/css">
    <link rel="stylesheet" href="../betty/betty_style.css" type="text/css">
</head>

<body>
   
    <?php 
    
    include "../betty/sql.php";
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
    
    <!-- sierra 食譜 START -->
    <section class="write_details write_content_pad">
        <div class="container">

            <!-- sierra 新稱食譜 START -->
            <div class="row">
                <div class="col-lg-8 col-md-7 order-md-1 order-1 write_bg">
                    <div class="write_details_text">
                        <p>
                            新增食譜
                        </p>
                    </div>
                    <div class="write_form">
                        <form action="recipe_new_con.php" method="post">

                            <input type="hidden" name="user_email" id="user_email" value="<?php echo $user_email; ?>">

                            <input class="write_form_input col-lg-12" type="text" placeholder="輸入食譜名稱(最多20個字)" name="rec_name">

                            <input class="write_form_submit" type="submit" value="開始寫食譜" name="recipe_new_add">

                        </form>
                    </div>
                </div>
            </div>
            <!-- sierra 新稱食譜 END -->


            <!-- sierra 未發布食譜 START -->

            <div class="row">
                <div class="col-lg-8 col-md-7 order-md-1 order-1 write_bg">
                    <div class="write_details_text">
                        <p>
                            未發布的食譜
                        </p>
                    </div>

                    <?php
                        $sql1 = "SELECT * FROM recipe WHERE user_email='$user_email' AND rec_status='0' ORDER BY rec_date DESC";
                        $result1 = mysqli_query($db, $sql1);
                        if(mysqli_num_rows($result1) > 0){
                            while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
                                ?>
                                <form enctype="multipart/form-data" action="recipe_new_con.php" method="post" class="unreport_border">
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

                                                <input type="submit" class="write_form_submit" value="寫食譜" name="list_unpublish_recipe">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php
                            }
                        }
                    ?>

                </div>
            </div>
            <!-- sierra 未發布食譜 END -->

        </div>
    </section>
    <!-- sierra 食譜 END -->

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
