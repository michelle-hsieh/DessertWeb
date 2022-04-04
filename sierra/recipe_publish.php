<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>寫食譜</title>

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
    
    <!-- sierra 食譜 START -->
    <section class="write_details write_recipe_pad">
        <div class="container">
            <!-- sierra 寫新食譜 START -->

            <?php
            
            #接收從recipe_new_con.php送來的id
            if(isset($_GET['rec_id'])){
                $recipe_id = $_GET['rec_id'];
            }
            
            include "recipe_detail_list.php";
            #抓上面include的值 - START
            
            $check1 = "";
            $check2 = "";
            $check3 = "";
            $check4 = "";
            $check5 = "";
            $check6 = "";
            $check7 = "";
            $check8 = "";
            
            $recipe_name = query("recipe_name");
            $recipe_pic = query("recipe_pic");
            $recipe_sort = query("recipe_sort");
            $recipe_qty = query("recipe_qty");
            $recipe_cooktime = query("recipe_cooktime");
            $food_name = query("food_name");
            $food_qty = query("food_qty");
            $recipe_step = query("recipe_step");
            $recipe_status = query("recipe_status");
            
            #抓上面include的值 - END
            
            if($recipe_sort == "鬆餅"){
                $check1 = 'checked="checked"';
            }
            else if($recipe_sort == "蛋糕"){
                $check2 = 'checked="checked"';
            }
            else if($recipe_sort == "布丁果凍"){
                $check3 = 'checked="checked"';
            }
            else if($recipe_sort == "甜湯"){
                $check4 = 'checked="checked"';
            }
            else if($recipe_sort == "派塔"){
                $check5 = 'checked="checked"';
            }
            else if($recipe_sort == "麵包"){
                $check6 = 'checked="checked"';
            }
            else if($recipe_sort == "巧克力糖果"){
                $check7 = 'checked="checked"';
            }
            else if($recipe_sort == "餅乾"){
                $check8 = 'checked="checked"';
            }
            
            ?>

            <form enctype="multipart/form-data" action="recipe_new_con.php" method="post">

                <input type="hidden" name="rec_id" id="rec_id" value="<?php echo $recipe_id; ?>">
                
                <input type="hidden" name="user_email" id="user_email" value="<?php echo $user_email; ?>">

                <div class="row">
                    <div class="col-lg-8 col-md-7 order-md-1 order-1">
                        <div class="step_button_bg">
                            <input class="write_step_submit" type="submit" value="修改" name="rec_update">
                            <input class="write_step_submit" type="submit" value="取消" name="publish_rec_cel" onclick="javascript: return confirm('確定要取消嗎?');">
                            
                        </div>

                        <!-- 名稱 -->
                        <div class="step_input_bg1">
                            <p>
                                食譜名稱
                            </p>
                            <input class="write_step_input col-lg-12" type="text" name="rec_name" value="<?php echo $recipe_name; ?>" readonly="readonly">
                        </div>

                        <!-- 照片 -->
                        <div class="step_input_bg2">
                            <p>
                                上傳照片
                            </p>

                            <div class="pic_input">
                                <img src="<?php echo $recipe_pic; ?>">
                            </div>

                            <input type="hidden" name="rec_pic_text" id="rec_pic_text" value="<?php echo $recipe_pic; ?>">
                        </div>

                        <!-- 分類 -->
                        <div class="step_input_bg3">
                            <p>
                                分類
                            </p>
                            <div>
                                <input type="radio" name="rec_sort" value="1" class="radio_input" <?php echo $check1; ?> disabled>
                                <lable for="rec_sort" class="radio_font">鬆餅</lable>
                                
                                <input type="radio" name="rec_sort" value="2" class="radio_input" <?php echo $check2; ?> disabled>
                                <lable for="rec_sort" class="radio_font">蛋糕</lable>
                                
                                <input type="radio" name="rec_sort" value="3" class="radio_input" <?php echo $check3; ?> disabled>
                                <lable for="rec_sort" class="radio_font">布丁、果凍</lable>
                                
                                <input type="radio" name="rec_sort" value="4" class="radio_input" <?php echo $check4; ?> disabled>
                                <lable for="rec_sort" class="radio_font">甜湯</lable>
                                
                                <input type="radio" name="rec_sort" value="5" class="radio_input" <?php echo $check5; ?> disabled>
                                <lable for="rec_sort" class="radio_font">派塔</lable>
                                
                                <input type="radio" name="rec_sort" value="6" class="radio_input" <?php echo $check6; ?> disabled>
                                <lable for="rec_sort" class="radio_font">麵包</lable>
                                
                                <input type="radio" name="rec_sort" value="7" class="radio_input" <?php echo $check7; ?> disabled>
                                <lable for="rec_sort" class="radio_font">巧克力、糖果</lable>
                                
                                <input type="radio" name="rec_sort" value="8" class="radio_input" <?php echo $check8; ?> disabled>
                                <lable for="rec_sort" class="radio_font">餅乾</lable>
                            </div>
                        </div>

                        <!-- 份量 -->
                        <div class="step_input_bg3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>
                                        份量(人份)
                                    </p>
                                    <input class="write_step_input2" type="text" placeholder="人份" name="rec_qty" value="<?php echo $recipe_qty; ?>" readonly="readonly">
                                </div>
                                <div class="col-lg-6">
                                    <p>
                                        烹調時間(分鐘)
                                    </p>
                                    <input class="write_step_input2" type="text" placeholder="分鐘" name="rec_cooktime" value="<?php echo $recipe_cooktime; ?>" readonly="readonly">
                                </div>
                            </div>
                        </div>

                        <!-- 食材 -->
                        <!-- food_dynamic_field START-->
                        <div class="step_input_bg4">
                            <p>
                                食材
                            </p>
                            <table id="foodtable_id" class="food_table">
                                <?php
                                
                                for($i = 0; $i < count($food_name); $i++){
                                    ?>
                                    <tr>
                                        <td class="food_td1">
                                            <input class="food_input" type="text" name="food_name[]" placeholder="食材" value="<?php echo $food_name[$i];?>" readonly="readonly">
                                        </td>
                                        <td class="food_td2">
                                            <input class="food_input" type="text" name="food_qty[]" placeholder="份量" value="<?php echo $food_qty[$i];?>" readonly="readonly">
                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>

                            </table>
                        </div>
                        <!-- food_dynamic_field END-->

                        <!-- 步驟 -->
                        <!-- step_dynamic_field START-->
                        <div class="step_input_bg5">
                            <p>
                                步驟
                            </p>
                            <table id="steptable_id" class="food_table">

                                <?php
                                for($i = 0; $i < count($recipe_step); $i++){
                                    ?>
                                    <tr>
                                        <td class="step_td1">
                                            <textarea name="rec_step[]" cols="20" rows="5" class="food_input" readonly="readonly"><?php echo $recipe_step[$i];?></textarea>
                                        </td>
                                    </tr>

                                    <?php
                                }
                                ?>
                                
                            </table>
                        </div>
                        <!-- step_dynamic_field END-->

                    </div>
                </div>
            </form>
            <!-- sierra 寫新食譜 END -->

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

    <!-- sierra js ADD FOOD -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

</body>

</html>
