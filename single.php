<?php

require_once ('lib/MysqlDriver.php');
use Ibrahim\MysqliDatabaseWrapper\MysqlDriver;

$connection = new MysqlDriver('localhost','root','','cms');
$category = $connection
    ->select()
    ->columns('*')
    ->table('category')
    ->execute()
    ->fetchAll();

$content = $connection
    ->select()
    ->columns('*')
    ->table('content')
    ->where()
    ->operations('id','=',$_GET['id'])
    ->execute()
    ->fetch();

$reviews = $connection
    ->select()
    ->columns('*')
    ->table('review')
    ->where()
    ->operations('content_id','=',$_GET['id'])
    ->execute()
    ->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>TheSaaS - Blog post</title>

    <!-- Styles -->
    <link href="assets/front/assets/css/core.min.css" rel="stylesheet">
    <link href="assets/front/assets/css/thesaas.min.css" rel="stylesheet">
    <link href="assets/front/assets/css/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/front/assets/img/apple-touch-icon.png">
    <link rel="icon" href="assets/front/assets/img/favicon.png">
</head>

<body>


<!-- Topbar -->
<nav class="topbar topbar-inverse topbar-expand-md topbar-sticky">
    <div class="container">

        <div class="topbar-left">
            <button class="topbar-toggler">&#9776;</button>
            <a class="topbar-brand" href="index.html">
                <img class="logo-default" src="assets/front/assets/img/logo.png" alt="logo">
                <img class="logo-inverse" src="assets/front/assets/img/logo-light.png" alt="logo">
            </a>
        </div>


        <div class="topbar-right">
            <ul class="topbar-nav nav">

                <?php foreach ($category as $categoryList) : ?>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><?= $categoryList['name']; ?></a>
                    </li>

                <?php endforeach; ?>

            </ul>
        </div>

    </div>
</nav>
<!-- END Topbar -->



<!-- Header -->
<header class="header header-inverse h-fullscreen pb-80" style="frontground-image: url(assets/front/assets/img/bg-cup.jpg);" data-overlay="8">
    <div class="container text-center">

        <div class="row h-full">
            <div class="col-12 col-lg-8 offset-lg-2 align-self-center">

                <p class="opacity-70"><?= $content['name']; ?></p>
                <br>
                <h1 class="display-4 hidden-sm-down"><?= $content['main_content']; ?></h1>
                <br><br>
                <p><span class="opacity-70 mr-8">By</span> <a class="text-white" href="#">Hossein Shams</a></p>
                <p><img class="rounded-circle w-40" src="assets/front/assets/img/avatar/2.jpg" alt="..."></p>

            </div>

            <div class="col-12 align-self-end text-center">
                <a class="scroll-down-1 scroll-down-inverse" href="#" data-scrollto="section-content"><span></span></a>
            </div>

        </div>

    </div>
</header>
<!-- END Header -->




<!-- Main container -->
<main class="main-content">



    <!--
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    | Blog content
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    !-->
    <div class="section" id="section-content">
        <div class="container">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <p>
                        <?= $content['description']; ?>
                    </p>

                </div>
            </div>



            <br>
            <p><img src="assets/front/assets/img/blog-img.jpg" alt="..."></p>
            <br>


        </div>
    </div>




    <!--
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    | Comments
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    !-->
    <div class="section bt-1 bg-grey">
        <div class="container">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <div class="media-list" id="media-list">

                    <?php if (!empty($reviews)) :?>

                        <?php foreach ($reviews as $review) : ?>
                        <div class="media">
                            <img class="rounded-circle w-40" src="assets/front/assets/img/avatar/1.jpg" alt="...">

                            <div class="media-body">
                                <p class="fs-14">
                                    <strong><?= $review['username']; ?></strong>
                                    <time class="ml-16 opacity-70 fs-12" datetime="2017-07-14 20:00">24 min ago</time>
                                </p>
                                <p class="fs-13"><?= $review['review']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <div>
                            Nothing
                        </div>
                    <?php endif; ?>


                    </div>


                    <hr>


                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <input class="form-control" id="name" type="text" placeholder="Name">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <input class="form-control" id="email" type="text" placeholder="Email">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <input class="form-control" id="contentId" value="<?= $_GET['id']; ?>" type="hidden" placeholder="Email">
                        </div>

                    </div>

                    <div class="form-group">
                        <textarea class="form-control" id="review" placeholder="Comment" rows="4"></textarea>
                    </div>

                    <button class="btn btn-primary btn-block" onclick="sendReview()" type="submit">Submit your comment</button>

                </div>
            </div>

        </div>
    </div>





</main>
<!-- END Main container -->






<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="row gap-y align-items-center">
            <div class="col-12 col-lg-3">
                <p class="text-center text-lg-left">
                    <a href="index.html"><img src="assets/front/assets/img/logo.png" alt="logo"></a>
                </p>
            </div>

            <div class="col-12 col-lg-6">
                <ul class="nav nav-primary nav-hero">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog.html">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="block-feature.html">Features</a>
                    </li>
                    <li class="nav-item hidden-sm-down">
                        <a class="nav-link" href="page-pricing.html">Pricing</a>
                    </li>
                    <li class="nav-item hidden-sm-down">
                        <a class="nav-link" href="page-contact.html">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-lg-3">
                <div class="social text-center text-lg-right">
                    <a class="social-facebook" href="https://www.facebook.com/thethemeio"><i class="fa fa-facebook"></i></a>
                    <a class="social-twitter" href="https://twitter.com/thethemeio"><i class="fa fa-twitter"></i></a>
                    <a class="social-instagram" href="https://www.instagram.com/thethemeio/"><i class="fa fa-instagram"></i></a>
                    <a class="social-dribbble" href="https://dribbble.com/thethemeio"><i class="fa fa-dribbble"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END Footer -->



<!-- Scripts -->
<script src="assets/front/assets/js/core.min.js"></script>
<script src="assets/front/assets/js/thesaas.min.js"></script>
<script src="assets/front/assets/js/script.js"></script>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    function sendReview (){

        let name = $("#name").val();
        let email = $("#email").val();
        let review = $("#review").val();
        let contentId = $("#contentId").val();
        $.ajax({
            type:'POST',
            url:'sendReview.php',
            data:{name:name,email:email,review:review,contentId:contentId},
            success:function () {
                let data = `
                    <div class="media">
                        <img class="rounded-circle w-40" src="assets/front/assets/img/avatar/1.jpg" alt="...">

                            <div class="media-body">
                                <p class="fs-14">
                                    <strong>${name}</strong>
                                    <time class="ml-16 opacity-70 fs-12" datetime="2017-07-14 20:00">24 min ago</time>
                                </p>
                                <p class="fs-13">${review}</p>
                            </div>
                    </div>
                `;

                $("#media-list").append(data);
            }
        });
    }
</script>

</body>
</html>
