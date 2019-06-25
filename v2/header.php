<!DOCTYPE HTML>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SayChat">
    <meta name="author" content="Berk Cetinsaya">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/modern-business.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/jquery.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <title><?php echo $page_title; ?></title>
    <style type="text/css">
        h1 {
            font-size: 9px;
            margin: 30px 0;
            padding: 0 200px 15px 0;
            border-bottom: 1px solid #E5E5E5;
        }

        .bs-example {
            margin: 20px;
        }

        body {
            background-color: #3E7CB1;
        }

        .panel-body {
            background-color: #3E7CB1;
        }

        #head {
            background-color: #054A91;
        }

        a {
            color: #B6DCFE;
        }

        p,
        h3,
        h4,
        label {
            color: #B6DCFE;
        }

        .btn{
            background-color: #F17300;

        }

        .navbar {
            background-color: #054A91;
        }
    </style>
</head>

<body>
    <!--#054A91 #3E7CB1 #B6DCFE #81A4CD #F17300-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><i class="fa fa-fw fa-qrcode"></i>SayChat</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="signin.php"><i class="fa fa-fw fa-sign-in"></i>Sign In</a>
                    </li>
                    <li>
                        <a href="signup.php"><i class="fa fa-fw fa-user"></i>Sign Up</a>
                    </li>
                    <li>
                        <a href="contact.php"><i class="fa fa-fw fa-compass"></i>Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php if ($page_title == "SayChat") { ?>
        <header id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <div class="fill" style="background-image:url('assets/img/1.jpg');"></div>
                </div>
                <div class="item">
                    <div class="fill" style="background-image:url('assets/img/2.jpg');"></div>
                </div>
                <div class="item">
                    <div class="fill" style="background-image:url('assets/img/3.jpeg');"></div>
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="icon-next"></span>
            </a>
        </header>
    <?php } ?>