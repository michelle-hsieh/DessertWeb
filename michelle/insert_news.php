<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新增最新消息</title>

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

    
    <!-- hoverable hyperlink& buttons -->
    <style type="text/css">
        .checkout__form h4 a:hover {
            background-color: #f2eee5;             
        }
        
        .buttons button {
            background: #e99883;
            color: white;
        }
        
        .buttons button:hover {
            background-color: #e6866d;
            color: white;
        }
        
        .buttons input {
            background: crimson;
            color: white;
        }
        
        .buttons input:hover {
            background-color: firebrick;
            color: white;
        }
    </style>
</head>

<body>
<?php
    include '../betty/header.php';
    head('manlogin');
    ?>

    <!-- Insert News Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4><a href="news.php" onclick="javascript: return confirm('確定返回最新消息?');" style="color: black;"><span class="fa fa-angle-left"></span>&nbsp;返回最新消息</a></h4>
                <form method="post" action="iud_func.php">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>作者<span>*</span></p>
                                <input type="text" name="user_email" value="<?php 
                                if (isset($_SESSION['user_name'])) {
                                echo $_SESSION['user_name'];
                                } ?>" required>
                            </div>
                            <div class="checkout__input">
                                <p>標題<span>*</span></p>
                                <input type="text" name="news_title" required>
                            </div>
                            <div class="checkout__input">
                                <p>內容<span>*</span></p>
                                <textarea name="news_content" rows="10" style="width:100%; border: 1px solid #ebebeb; border-radius: 4px; padding-left: 20px; padding-top: 10px; color: #b2b2b2;" required></textarea>
                            </div>
                            <div class="buttons">
                                <input name="insert_news" type="submit" onclick="javascript: return confirm('確認送出?');" class="site-btn" value="送出">
                                <button type="reset" class="site-btn">取消</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Insert News Section End -->

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