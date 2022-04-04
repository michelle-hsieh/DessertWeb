<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>註冊</title>

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
    <?php include 'session.php'; ?>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="../betty/index.php"><img src="../img/dessert.png" alt=""></a>
                    </div>
                </div>
            </div>       
        </div>
    </header>

    <!-- Register Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>註冊</h4>
                <form method="post" action="register.php">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>姓名／暱稱<span>*</span></p>
                                <input type="text" name="user_name" required>
                            </div>
                            <div class="checkout__input">
                                <p>帳號<span>*</span></p>
                                <input type="email" name="user_email" required>
                            </div>
                            <div class="checkout__input">
                                <p>密碼<span>*</span></p>
                                <input type="password" name="user_psw" required>
                            </div>
                            <div class="checkout__input">
                                <p>再次輸入密碼<span>*</span></p>
                                <input type="password" name="user_psw2" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6>已有帳號? <a href="login.php">前往登入</a></h6>
                                </div>
                            </div>
                            <div class="buttons">
                                <input type="submit" name="register" onclick="javascript: return confirm('確認註冊?');" class="site-btn" value="送出">
                                <button type="reset" class="site-btn">取消</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Register Section End -->

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