<?php
function query($q){
    #include db.php $db
    $db = db();
    if(!$db){
        echo "db_con_wrong";
    }
    
    
    #接收從recipe_new_con傳送的recipe_id
    if(isset($_GET['rec_id'])){
        $recipe_id = $_GET['rec_id'];
        
        $sql1 = "SELECT * FROM recipe WHERE rec_id='$recipe_id'";
        $result1 = mysqli_query($db, $sql1);
        if(mysqli_num_rows($result1) == 1){
            $row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
            #search recipe_name
            if($q == "recipe_name"){
                $recipe_name = $row['rec_name'];
                return $recipe_name;
            }
            
            #search recipe_picture
            if($q == "recipe_pic"){
                $recipe_pic = $row['rec_image'];
                return $recipe_pic;
            }
            
            #search recipe_sort
            if($q == "recipe_sort"){
                $recipe_sort = $row['rec_sort'];
                return $recipe_sort;
            }
            
            #search recipe_qty
            if($q == "recipe_qty"){
                $recipe_qty = $row['rec_qty'];
                
                if($recipe_qty == '0'){
                    $recipe_qty = "";
                    return $recipe_qty;
                }
                else{
                    return $recipe_qty;
                }
            }
            
            #search recipe_cooktime
            if($q == "recipe_cooktime"){
                $recipe_cooktime = $row['rec_cooktime'];
                
                if($recipe_cooktime == '0'){
                    $recipe_cooktime = "";
                    return $recipe_cooktime;
                }
                else{
                    return $recipe_cooktime;
                }
                
            }
            #發布與否
            if($q == "recipe_status"){
                $recipe_status = $row['rec_status'];
                return $recipe_status;
            }
            
            if($q == "user_email"){
                $user = $row['user_email'];
                return $user;
            }
           
        }
        
        $sql2 = "SELECT * FROM food WHERE rec_id='$recipe_id'";
        $result2 = mysqli_query($db, $sql2);
        $food_name = array();
        $food_qty = array();
        if(mysqli_num_rows($result2) > 0){
            while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                if($row['food_qty'] == "0"){
                    $row['food_qty'] = "";
                }
                array_push($food_name, $row['food_name']);
                array_push($food_qty, $row['food_qty']);
            }
        }
        else{
            $food_name = array("");
            $food_qty = array("");
        }
        
        if($q == "food_name"){
            return $food_name;
        }
        if($q == "food_qty"){
            return $food_qty;
        }
        
        $sql3 = "SELECT * FROM step WHERE rec_id='$recipe_id' ORDER BY step_tag";
        $result3 = mysqli_query($db, $sql3);
        $recipe_step = array();
        if(mysqli_num_rows($result3) > 0){
            while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)){
                array_push($recipe_step, $row['step_content']);
            }
        }
        else{
            $recipe_step = array("");
        }
        
        if($q == "recipe_step"){
            return $recipe_step;
        }
        
    }
    else{
        echo "recipe_id is missing";
    }
}


?>