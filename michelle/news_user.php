<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>最新消息</title>

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
        a:hover {
            background-color: #f2eee5;
        }
    </style>
    
</head>

<body>
    <?php
    include '../betty/header.php';
    include '../betty/sql.php';
    $user_email=user();
    if(!empty($user_email)){
        head("islogin");
    }else{head("nologin");
    }
    ?>

    <!-- News Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
        
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                    <h4><a href="../betty/index.php" style="color: black;"><span class="fa fa-angle-left"></span><b>&nbsp;返回首頁</b></a></h4>
                    <hr>
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">標題</th>
                                    <th>日期</th>
                                    <th>作者</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $con = db();                               
                                    $sql = 'SELECT * FROM news, user WHERE news.user_email = user.user_email ORDER BY news_date DESC';
                                    $rs = mysqli_query($con, $sql);
                                    while($record = mysqli_fetch_row($rs)) {
                                ?>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <a href="news_details.php?news_id=<?php echo $record[0]?>&reader=user&loc=all"><h5><?php echo $record[1]?></h5></a>
                                    </td>
                                    <td class="shoping__cart__">
                                        <?php echo $record[3]?>
                                    </td>
                                    <td class="shoping__cart__">
                                        <?php echo $record[7]?>
                                    </td>
                                </tr>
                                
                                <?php 
                                    }
                                    mysqli_close($con);      
                                ?> 
                            </tbody>
                        </table>
                        
                    </div>
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