<?php
include "../betty/sql.php";
#連 database
$db = db();
if(!$db){
    echo "db_con_wrong";
}


#初始recipe_pic_path
$origin_pic_path = '../sierra/pic/origin.JPG';
$rec_path_text = $origin_pic_path;

#user_id
$user_email = mysqli_real_escape_string($db, $_POST['user_email']);


if(isset($_POST['list_unreport_recipe'])){
    $recipe_id = mysqli_real_escape_string($db, $_POST['rec_id']);
    header("location:recipe_new_detail.php?rec_id=$recipe_id");
}

/*** 新增食譜 ***/
if(isset($_POST['recipe_new_add'])){
    #食譜名稱
    $recipe_name = mysqli_real_escape_string($db, $_POST['rec_name']);
    
    #判斷食譜名稱
    if(empty($recipe_name)){
        echo "<script> alert('請輸入食譜名稱'); location.href = 'recipe_new.php'</script>";
    }
    else if(mb_strlen($recipe_name,"utf-8") >= 20){
        echo "<script> alert('請輸入20個字以內'); location.href = 'recipe_new.php'</script>";
    }
    else{
        #session user.email
        
        #insert new recipe
        $sql1 = "INSERT INTO recipe(rec_name, rec_image, rec_qty, rec_cooktime, rec_sort, rec_status, user_email) VALUES ('$recipe_name', '$origin_pic_path', '0', '0', '鬆餅', '0', '$user_email')";
        mysqli_query($db, $sql1);
        
        #search new recipe_id
        $sql2 = "SELECT rec_id FROM recipe WHERE user_email='$user_email' AND rec_date=(SELECT MAX(rec_date) FROM recipe WHERE user_email='$user_email') AND rec_name='$recipe_name'";
        $result2 = mysqli_query($db, $sql2);
        
        if(mysqli_num_rows($result2) == 1){
            $rec_id = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            
            #傳食譜id到寫步驟
            $recipe_id = $rec_id['rec_id'];
            header("location:recipe_new_detail.php?rec_id=$recipe_id");
        }
        else{
            echo "sql_search_nothing";
        }
        
    }
}


/*** 新增食譜作法 ***/

#從recipe_new_detail接收變數
#食譜id
    $recipe_id = mysqli_real_escape_string($db, $_POST['rec_id']);
    
    #食譜名稱
    $recipe_name = mysqli_real_escape_string($db, $_POST['rec_name']);
    
    #分類
    $sort_name = mysqli_real_escape_string($db, $_POST['rec_sort']);
    
    if($sort_name == "1"){
        $recipe_sort = "鬆餅";
    }
    else if($sort_name == "2"){
        $recipe_sort = "蛋糕";
    }
    else if($sort_name == "3"){
        $recipe_sort = "布丁果凍";
    }
    else if($sort_name == "4"){
        $recipe_sort = "甜湯";
    }
    else if($sort_name == "5"){
        $recipe_sort = "派塔";
    }
    else if($sort_name == "6"){
        $recipe_sort = "麵包";
    }
    else if($sort_name == "7"){
        $recipe_sort = "巧克力糖果";
    }
    else if($sort_name == "8"){
        $recipe_sort = "餅乾";
    }
    
    #份量
    $recipe_qty = mysqli_real_escape_string($db, $_POST['rec_qty']);
    if($recipe_qty == '0'){
        $recipe_qty = "";
    }
    
    #時間
    $recipe_cooktime = mysqli_real_escape_string($db, $_POST['rec_cooktime']);
    if($recipe_cooktime == '0'){
        $recipe_cooktime = "";
    }
    
    #照片
    $rec_path_text = mysqli_real_escape_string($db, $_POST['rec_pic_text']);
    $pic_name = $_FILES['rec_pic']['name'];
    $pic_size = $_FILES['rec_pic']['size'];
    $pic_tmp = $_FILES['rec_pic']['tmp_name'];
    $pic_type = $_FILES['rec_pic']['type'];
    
    #食材
    if(!empty($_POST['food_name'])){
        $food_name = $_POST['food_name'];
        $recipe_food_name = base64_encode(serialize($food_name));
    }
    else{
        $food_name = array("");
        $recipe_food_name = base64_encode(serialize($food_name));
    }
    
    if(!empty($_POST['food_qty'])){
        $food_qty = $_POST['food_qty'];
        for($i = 0 ; $i < count($food_qty); $i++){
            if($food_qty[$i] == '0'){
                $food_qty[$i] = '';
            }
        }
        $recipe_food_qty = base64_encode(serialize($food_qty));
    }
    else{
        $food_qty = array("");
        $recipe_food_qty = base64_encode(serialize($food_qty));
    }
    
    #步驟
    if(!empty($_POST['rec_step'])){
        $rec_step = $_POST['rec_step'];
        $recipe_step = base64_encode(serialize($rec_step));
    }
    else{
        $rec_step = array("");
        $recipe_step = base64_encode(serialize($rec_step));
    }

    #判斷,recipe_new_detail,recipe_new_con
    if(!empty($pic_tmp)){
        $pic_path = "../sierra/pic/" .$pic_name;
        move_uploaded_file($pic_tmp, $pic_path);
        $rec_path_text = $pic_path;
    }


#儲存按鈕
if(isset($_POST['rec_save'])){    
    
    if(empty($recipe_name)){
        echo "<script> alert('請輸入食譜名稱'); location.href = 'recipe_new_detail.php?rec_id=$recipe_id&rec_name=$recipe_name&rec_sort=$recipe_sort&rec_qty=$recipe_qty&rec_cooktime=$recipe_cooktime&rec_pic=$rec_path_text&food_name=$recipe_food_name&food_qty=$recipe_food_qty&rec_step=$recipe_step'</script>";
    }
    else if(mb_strlen($recipe_name,"utf-8") >= 20){
        echo "<script> alert('請輸入20個字以內'); location.href = 'recipe_new_detail.php?rec_id=$recipe_id&rec_name=$recipe_name&rec_sort=$recipe_sort&rec_qty=$recipe_qty&rec_cooktime=$recipe_cooktime&rec_pic=$rec_path_text&food_name=$recipe_food_name&food_qty=$recipe_food_qty&rec_step=$recipe_step'</script>";
    }
    else{
        $sql1 = "UPDATE recipe SET rec_name='$recipe_name', rec_sort='$recipe_sort', rec_qty='$recipe_qty', rec_cooktime='$recipe_cooktime', rec_image='$rec_path_text', rec_date=(SELECT NOW()) WHERE rec_id='$recipe_id'";
        mysqli_query($db, $sql1);
        
        $sql2 = "DELETE FROM food WHERE rec_id='$recipe_id'";
        mysqli_query($db, $sql2);
        
        for($i = 0; $i < count($food_name); $i++){
            if($food_name[$i] != "" || $food_qty[$i] != ""){
                $sql3 = "INSERT INTO food(food_name, food_qty, rec_id) VALUES ('$food_name[$i]', '$food_qty[$i]', '$recipe_id')";
                mysqli_query($db, $sql3);
            }
        }
        
        $sql4 = "DELETE FROM step WHERE rec_id='$recipe_id'";
        mysqli_query($db, $sql4);
        $num = 0;
        for($i = 0; $i < count($rec_step); $i++){
            $num = $i+1;
            $sql5 = "INSERT INTO step(step_content, step_tag, rec_id) VALUES ('$rec_step[$i]', '$num', '$recipe_id')";
            mysqli_query($db, $sql5);
        }
        
        header("location:recipe_new_detail.php?rec_id=$recipe_id");
    }     
}

#發布按鈕
if(isset($_POST['rec_report'])){
    for($i = 0 ; $i < count($food_name); $i++){
        if($food_name[$i] == "" || $food_qty[$i] == ""){
            echo "<script> alert('請輸入食材'); location.href = 'recipe_new_detail.php?rec_id=$recipe_id&rec_name=$recipe_name&rec_sort=$recipe_sort&rec_qty=$recipe_qty&rec_cooktime=$recipe_cooktime&rec_pic=$rec_path_text&food_name=$recipe_food_name&food_qty=$recipe_food_qty&rec_step=$recipe_step'</script>";
        }
    }
    
    for($i = 0 ; $i < count($rec_step); $i++){
        if($rec_step[$i] == ""){
            echo "<script> alert('請輸入步驟'); location.href = 'recipe_new_detail.php?rec_id=$recipe_id&rec_name=$recipe_name&rec_sort=$recipe_sort&rec_qty=$recipe_qty&rec_cooktime=$recipe_cooktime&rec_pic=$rec_path_text&food_name=$recipe_food_name&food_qty=$recipe_food_qty&rec_step=$recipe_step'</script>";
        }
    }
    
    if(empty($recipe_name)){
        echo "<script> alert('請輸入食譜名稱'); location.href = 'recipe_new_detail.php?rec_id=$recipe_id&rec_name=$recipe_name&rec_sort=$recipe_sort&rec_qty=$recipe_qty&rec_cooktime=$recipe_cooktime&rec_pic=$rec_path_text&food_name=$recipe_food_name&food_qty=$recipe_food_qty&rec_step=$recipe_step'</script>";
    }
    else if(mb_strlen($recipe_name,"utf-8") >= 20){
        echo "<script> alert('請輸入20個字以內'); location.href = 'recipe_new_detail.php?rec_id=$recipe_id&rec_name=$recipe_name&rec_sort=$recipe_sort&rec_qty=$recipe_qty&rec_cooktime=$recipe_cooktime&rec_pic=$rec_path_text&food_name=$recipe_food_name&food_qty=$recipe_food_qty&rec_step=$recipe_step'</script>";
    }
    else if($rec_path_text == $origin_pic_path){
        echo "<script> alert('請選擇圖片'); location.href = 'recipe_new_detail.php?rec_id=$recipe_id&rec_name=$recipe_name&rec_sort=$recipe_sort&rec_qty=$recipe_qty&rec_cooktime=$recipe_cooktime&rec_pic=$rec_path_text&food_name=$recipe_food_name&food_qty=$recipe_food_qty&rec_step=$recipe_step'</script>";
    }
    else if($recipe_qty == "" || $recipe_cooktime == ""){
        echo "<script> alert('請輸入份量和烹調時間'); location.href = 'recipe_new_detail.php?rec_id=$recipe_id&rec_name=$recipe_name&rec_sort=$recipe_sort&rec_qty=$recipe_qty&rec_cooktime=$recipe_cooktime&rec_pic=$rec_path_text&food_name=$recipe_food_name&food_qty=$recipe_food_qty&rec_step=$recipe_step'</script>";
    }
    else{
        $sql1 = "UPDATE recipe SET rec_name='$recipe_name', rec_sort='$recipe_sort', rec_qty='$recipe_qty', rec_cooktime='$recipe_cooktime', rec_image='$rec_path_text', rec_date=(SELECT NOW()), rec_status='1' WHERE rec_id='$recipe_id'";
        mysqli_query($db, $sql1);
        
        $sql2 = "DELETE FROM food WHERE rec_id='$recipe_id'";
        mysqli_query($db, $sql2);
        
        for($i = 0; $i < count($food_name); $i++){
            $sql3 = "INSERT INTO food(food_name, food_qty, rec_id) VALUES ('$food_name[$i]', '$food_qty[$i]', '$recipe_id')";
            mysqli_query($db, $sql3);
        }
        
        $sql4 = "DELETE FROM step WHERE rec_id='$recipe_id'";
        mysqli_query($db, $sql4);
        
        $num = 0;
        for($i = 0; $i < count($rec_step); $i++){
            $num = $i+1;
            $sql5 = "INSERT INTO step(step_content, step_tag, rec_id) VALUES ('$rec_step[$i]', '$num', '$recipe_id')";
            mysqli_query($db, $sql5);
        }
        
        echo "<script> alert('發布成功'); location.href = 'recipe_new.php'</script>";
    }
}

#刪除按鈕
if(isset($_POST['rec_del'])){
    #食譜id
    $recipe_id = mysqli_real_escape_string($db, $_POST['rec_id']);
    
    $sql1 = "DELETE FROM recipe WHERE rec_id='$recipe_id'";
    mysqli_query($db, $sql1);
    
    $sql2 = "DELETE FROM food WHERE rec_id='$recipe_id'";
    mysqli_query($db, $sql2);
    
    $sql3 = "DELETE FROM step WHERE rec_id='$recipe_id'";
    mysqli_query($db, $sql3);
    
    $sql4 = "DELETE FROM mylike WHERE rec_id='$recipe_id'";
    mysqli_query($db, $sql4);
    
    echo "<script> alert('刪除成功'); location.href = 'recipe_new.php'</script>";   
}

#取消按鈕
if(isset($_POST['rec_cel'])){
    header("location:user_detail.php?method=unpublish");
}

#在recipe_publish.php發布後要修改,按修改
if(isset($_POST['rec_update'])){
    #食譜id
    $recipe_id = mysqli_real_escape_string($db, $_POST['rec_id']);
    $sql1 = "UPDATE recipe SET rec_status='0' WHERE rec_id='$recipe_id'";
    mysqli_query($db, $sql1);
    header("location:recipe_new_detail.php?rec_id=$recipe_id");
}

#在user_detail.php按未發布的繼續按紐
if(isset($_POST['list_unpublish_recipe'])){
    $recipe_id = mysqli_real_escape_string($db, $_POST['rec_id']);
    header("location:recipe_new_detail.php?rec_id=$recipe_id");
}

#在user_detail.php按發布的查看按紐
if(isset($_POST['list_publish_recipe'])){
    $recipe_id = mysqli_real_escape_string($db, $_POST['rec_id']);
    header("location:recipe_publish.php?rec_id=$recipe_id");
}

if(isset($_POST['list_mylove_recipe'])){
    $recipe_id = mysqli_real_escape_string($db, $_POST['rec_id']);
    header("location:recipe_detail.php?rec_id=$recipe_id");
}

if(isset($_POST['publish_rec_cel'])){
    header("location:user_detail.php?method=publish");
}


?>