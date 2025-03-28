<!doctype html>
<?php
    session_start();
if (isset($_SESSION['role'])){
    if($_SESSION['role'] != 0 && $_SESSION['role'] !=1)
        $_SESSION['role']=3;
} 
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="icon" href="images/logo.png">

        <title>Trang chủ - Beta</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap" rel="stylesheet">
                        
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <link rel="stylesheet" href="css/bootstrap-icons.css">

        <link rel="stylesheet" href="css/owl.carousel.min.css">
        
        <link rel="stylesheet" href="css/owl.theme.default.min.css">

        <link href="css/templatemo-pod-talk.css" rel="stylesheet">
        
<!--


-->
    </head>
    
    <body>

        <main>

            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand me-lg-5 me-0" href="index.php">
                        <img src="images/logo.png" class="logo-image img-fluid" alt="templatemo pod talk">
                    </a>

                    <form action="search.php" method="get" class="custom-form search-form flex-fill me-3" role="search">  
                        <div class="input-group input-group-lg">  
                            <input name="search" type="search" class="form-control" id="search" placeholder="Tìm khóa học" aria-label="Search" required>  
                            <button type="submit" class="btn btn-primary" id="submit" aria-label="Tìm kiếm">  
                                <i class="bi-search"></i>  
                            </button>  
                        </div>  
                    </form>
    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                </button>
    
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">Trang chủ</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="about.php">Giới thiệu</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Trang</a>

                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                    <li><a class="dropdown-item" href="listing-page.php#section_2">Khóa học</a></li>
                                    <li><a class="dropdown-item" href="Libary.php">Thư viện</a></li>
                                    <?php 
                                        if(isset($_SESSION['role']) && $_SESSION['role']==0){
                                            echo "<li><a class='dropdown-item' href='list_khoahoc.php'>Quản lý</a></li>";
                                        }
                                    ?>
                                </ul>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Liên hệ</a>
                            </li>
                        </ul>

                        <div class="ms-4">
                            <?php
                            if (!isset($_SESSION['role']) || $_SESSION['role']==3 ) 
                                echo "<a href='login-register.php' class='btn custom-btn custom-border-btn smoothscroll'>Đăng nhập</a>";
                            else {
                                echo "<a class='btn custom-btn custom-border-btn smoothscroll' href='user-infor.php'><i class='bi bi-person-check-fill'></i></a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </nav>

            <section class="hero-section">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <div class="text-center mb-5 pb-2">
                                <h1 class="text-white">Học tập - Ôn luyện</h1>

                                <p class="text-white">Các khóa học tiếng Anh</p>

                                <a href="#section_2" class="btn custom-btn smoothscroll mt-3">Xem Thêm</a>
                            </div>

                            <div class="owl-carousel owl-theme">
                                <div class="owl-carousel-info-wrap item">
                                    <img src="images/khoahoc/khoahoc1.jpg" class="owl-carousel-image img-fluid" alt="">

                                    <div class="owl-carousel-info">
                                        <h4 class="mb-2">
                                            Anh văn căn bản
                                            <img src="images/verified.png" class="owl-carousel-verified-image img-fluid" alt="">
                                        </h4>
                                    </div>

                                    <!-- <div class="social-share">
                                        <ul class="social-icon">
                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-twitter"></a>
                                            </li>

                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-facebook"></a>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>

                                <div class="owl-carousel-info-wrap item">
                                    <img src="images/khoahoc/khoahoc2.jpg" class="owl-carousel-image img-fluid" alt="">

                                    <div class="owl-carousel-info">
                                        <h4 class="mb-2">
                                            Ngữ pháp
                                            <img src="images/verified.png" class="owl-carousel-verified-image img-fluid" alt="">
                                        </h4>

                                        <span class="badge">Đầy đủ ngữ pháp</span>

                                        <span class="badge">Ví dụ minh họa cụ thể</span>
                                    </div>

                                    <!-- <div class="social-share">
                                        <ul class="social-icon">
                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-twitter"></a>
                                            </li>

                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-facebook"></a>
                                            </li>

                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-pinterest"></a>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>

                                <div class="owl-carousel-info-wrap item">
                                    <img src="images/khoahoc/khoahoc3.jpg" class="owl-carousel-image img-fluid" alt="">

                                    <div class="owl-carousel-info">
                                        <h4 class="mb-2">Luyện thi</h4>

                                        <span class="badge">Bám sát đề thi</span>

                                        <span class="badge">Đa dạng chủ đề</span>
                                    </div>

                                    <!-- <div class="social-share">
                                        <ul class="social-icon">
                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-twitter"></a>
                                            </li>

                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-facebook"></a>
                                            </li>

                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-pinterest"></a>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>

                                <div class="owl-carousel-info-wrap item">
                                    <img src="images/khoahoc/khoahoc4.jpg" class="owl-carousel-image img-fluid" alt="">

                                    <div class="owl-carousel-info">
                                        <h4 class="mb-2">Luyện đề</h4>

                                        <span class="badge">30+ Đề</span>
                                    </div>

                                    <!-- <div class="social-share">
                                        <ul class="social-icon">
                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-instagram"></a>
                                            </li>

                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-youtube"></a>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>

                                <div class="owl-carousel-info-wrap item">
                                    <img src="images/topics/luyende.PNG" class="owl-carousel-image img-fluid" alt="">

                                    <div class="owl-carousel-info">
                                        <h4 class="mb-2">
                                            Tổng ôn Toeic
                                            <img src="images/verified.png" class="owl-carousel-verified-image img-fluid" alt="">
                                        </h4>

                                    </div>

                                    <!-- <div class="social-share">
                                        <ul class="social-icon">
                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-instagram"></a>
                                            </li>

                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-youtube"></a>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>

                                <div class="owl-carousel-info-wrap item">
                                    <img src="images/topics/toeicstarter.PNG" class="owl-carousel-image img-fluid" alt="">

                                    <div class="owl-carousel-info">
                                        <h4 class="mb-2">Pre-Toeic   
                                        </h4>
                                        
                                        <span class="badge">Dành cho người mới bắt đầu</span>
                                    </div>

                                    <!-- <div class="social-share">
                                        <ul class="social-icon">
                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-linkedin"></a>
                                            </li>

                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-whatsapp"></a>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <section class="latest-podcast-section section-padding pb-0" id="section_2">
                <div class="container">
                    <div class="row justify-content-center">

                        <div class="col-lg-12 col-12">
                            <div class="section-title-wrap mb-5">
                                <h4 class="section-title">Mới nhất</h4>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12 mb-4 mb-lg-0">
                            <div class="custom-block d-flex">
                                <div class="">
                                    <div class="custom-block-icon-wrap">
                                        <div class="section-overlay"></div>
                                        <a href="detail-page.php" class="custom-block-image-wrap">
                                            <img src="images/topics/toeic.PNG" class="custom-block-image img-fluid" alt="">
                                        </a>
                                    </div>

                                    <div class="mt-2">
                                        <a href="#" class="btn custom-btn">
                                            Đăng ký
                                        </a>
                                    </div>
                                </div>

                                <div class="custom-block-info">
                                    <div class="custom-block-top d-flex mb-1">
                                        <small class="me-4">
                                            Only listening
                                        </small>

                                    </div>

                                    <h5 class="mb-2">
                                        <a href="detail-page.php?id=15">
                                            Toeic - Listening
                                        </a>
                                    </h5>
                                    <p class="mb-0">Dành cho người chỉ có nhu cầu ôn luyện kỹ năng nghe</p>
                                    <!-- <div class="custom-block-bottom d-flex justify-content-between mt-3">
                                        
                                    </div> -->
                                </div>

                                <div class="d-flex flex-column ms-auto">
                                    <a href="#" class="badge ms-auto">
                                        <i class="bi-heart"></i>
                                    </a>

                                    <a href="#" class="badge ms-auto">
                                        <i class="bi-bookmark"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="custom-block d-flex">
                                <div class="">
                                    <div class="custom-block-icon-wrap">
                                        <div class="section-overlay"></div>
                                        <a href="detail-page.php" class="custom-block-image-wrap">
                                            <img src="images/topics/toeic2.PNG" class="custom-block-image img-fluid" alt="">
                                        </a>
                                    </div>

                                    <div class="mt-2">
                                        <a href="#" class="btn custom-btn">
                                            Đăng ký
                                        </a>
                                    </div>
                                </div>

                                <div class="custom-block-info">
                                    <div class="custom-block-top d-flex mb-1">
                                        <small class="me-4">
                                            Only reading
                                        </small>
                                    </div>

                                    <h5 class="mb-2">
                                        <a href="detail-page.php?id=16">
                                            Toeic - Reading
                                        </a>
                                    </h5>
                                
                                    <p class="mb-0">Dành cho người chỉ có nhu cầu ôn luyện kỹ năng đọc-hiểu </p>

                                    <!-- <div class="custom-block-bottom d-flex justify-content-between mt-3">
                                        
                                    </div> -->
                                </div>

                                <div class="d-flex flex-column ms-auto">
                                    <a href="#" class="badge ms-auto">
                                        <i class="bi-heart"></i>
                                    </a>

                                    <a href="#" class="badge ms-auto">
                                        <i class="bi-bookmark"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <section class="topics-section section-padding pb-0" id="section_3">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <div class="section-title-wrap mb-5">
                                <h4 class="section-title">Các chứng chỉ tiếng Anh</h4>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                            <div class="custom-block custom-block-overlay">
                                <a href="detail-page.php" class="custom-block-image-wrap">
                                    <img src="images/topics/ielts.png" class="custom-block-image img-fluid" alt="">
                                </a>

                                <div class="custom-block-info custom-block-overlay-info">
                                    <h5 class="mb-1">
                                        <a href="listing-page.php">
                                            Ielts
                                        </a>
                                    </h5>

                                    <p class="badge mb-0">Upcoming</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                            <div class="custom-block custom-block-overlay">
                                <a href="detail-page.php" class="custom-block-image-wrap">
                                    <img src="images/topics/toeic.jpg" class="custom-block-image img-fluid" alt="">
                                </a>

                                <div class="custom-block-info custom-block-overlay-info">
                                    <h5 class="mb-1">
                                        <a href="listing-page.php">
                                            Toeic
                                        </a>
                                    </h5>

                                    <p class="badge mb-0">12 Lessons</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                            <div class="custom-block custom-block-overlay">
                                <a href="detail-page.php" class="custom-block-image-wrap">
                                    <img src="images/topics/vstep.jpeg" class="custom-block-image img-fluid" alt="">
                                </a>

                                <div class="custom-block-info custom-block-overlay-info">
                                    <h5 class="mb-1">
                                        <a href="listing-page.php">
                                            VSTEP
                                        </a>
                                    </h5>

                                    <p class="badge mb-0">35 lessons</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                            <div class="custom-block custom-block-overlay">
                                <a href="detail-page.php" class="custom-block-image-wrap">
                                    <img src="images/topics/capbac.jpg" class="custom-block-image img-fluid" alt="">
                                </a>

                                <div class="custom-block-info custom-block-overlay-info">
                                    <h5 class="mb-1">
                                        <a href="listing-page.php">
                                            A1, B1, B2, C1,...
                                        </a>
                                    </h5>

                                    <p class="badge mb-0">View more</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <section class="trending-podcast-section section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <div class="section-title-wrap mb-5">
                                <h4 class="section-title">Các khóa học phổ biến</h4>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                            <div class="custom-block custom-block-full">
                                <div class="custom-block-image-wrap">
                                    <a href="#">
                                        <img src="images/topics/toeicstarter.PNG" class="custom-block-image img-fluid" alt="">
                                    </a>
                                </div>

                                <div class="custom-block-info">
                                    <h5 class="mb-2">
                                        <a href="#">
                                            Pre-Toeic
                                        </a>
                                    </h5>

                                    <p class="mb-0">Dành cho người mới bắt đầu, ôn luyện Toeic từ những bài học cơ bản nhất.</p>

                                    <!-- <div class="custom-block-bottom d-flex justify-content-between mt-3">
                                    </div> -->
                                </div>

                                <div class="social-share d-flex flex-column ms-auto">
                                    <a href="#" class="badge ms-auto">
                                        <i class="bi-heart"></i>
                                    </a>
                                    <a href="#" class="badge ms-auto">
                                        <i class="bi-bookmark"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                            <div class="custom-block custom-block-full">
                                <div class="custom-block-image-wrap">
                                    <a href="#">
                                        <img src="images/topics/luyende.PNG" class="custom-block-image img-fluid" alt="">
                                    </a>
                                </div>

                                <div class="custom-block-info">
                                    <h5 class="mb-2">
                                        <a href="#">
                                            Luyện đề thi Toeic
                                        </a>
                                    </h5>

                                    <p class="mb-0">Bám sát ma trận đề thi, bổ sung nhiều câu hỏi khó.</p>

                                    <!-- <div class="custom-block-bottom d-flex justify-content-between mt-3">

                                    </div> -->
                                </div>

                                <div class="social-share d-flex flex-column ms-auto">
                                    <a href="#" class="badge ms-auto">
                                        <i class="bi-heart"></i>
                                    </a>

                                    <a href="#" class="badge ms-auto">
                                        <i class="bi-bookmark"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="custom-block custom-block-full">
                                <div class="custom-block-image-wrap">
                                    <a href="#">
                                        <img src="images/topics/kiemtra.PNG" class="custom-block-image img-fluid" alt="">
                                    </a>
                                </div>

                                <div class="custom-block-info">
                                    <h5 class="mb-2">
                                        <a href="#">
                                            Kiểm tra năng lực ngoại ngữ
                                        </a>
                                    </h5>

                                    <p class="mb-0">Kiểm tra năng lực của bạn với đề thi Toeic 120 phút</p>

                                    <!-- <div class="custom-block-bottom d-flex justify-content-between mt-3">
                                        
                                    </div> -->
                                </div>

                                <div class="social-share d-flex flex-column ms-auto">
                                    <a href="#" class="badge ms-auto">
                                        <i class="bi-heart"></i>
                                    </a>

                                    <a href="#" class="badge ms-auto">
                                        <i class="bi-bookmark"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main>


        <footer class="site-footer">   
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 col-12 mb-4 mb-md-0 mb-lg-0">
                        <h6 class="site-footer-title mb-3">Contact</h6>

                        <p class="mb-2"><strong class="d-inline me-2">Phone:</strong> +89 706 317 21</p>

                        <p>
                            <strong class="d-inline me-2">Email:</strong>
                            <a href="#">phatb2203463@student.ctu.edu.vn</a> 
                        </p>
                    </div>

                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <h6 class="site-footer-title mb-3">Download Mobile</h6>

                        <div class="site-footer-thumb mb-4 pb-2">
                            <div class="d-flex flex-wrap">
                                <a href="#">
                                    <img src="images/app-store.png" class="me-3 mb-2 mb-lg-0 img-fluid" alt="">
                                </a>

                                <a href="#">
                                    <img src="images/play-store.png" class="img-fluid" alt="">
                                </a>
                            </div>
                        </div>

                        <h6 class="site-footer-title mb-3">Social</h6>

                        <ul class="social-icon">
                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-instagram"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-twitter"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-whatsapp"></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="container pt-5">
                <div class="row align-items-center">

                    <div class="col-lg-2 col-md-3 col-12">
                        <a class="navbar-brand" href="index.php">
                            <img src="images/logo.png" class="logo-image img-fluid" alt="templatemo pod talk">
                        </a>
                    </div>

                    <div class="col-lg-7 col-md-9 col-12">
                        <ul class="site-footer-links">
                            <li class="site-footer-link-item">
                                <a href="#" class="site-footer-link">Trang chủ</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="#" class="site-footer-link">Khóa học</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="#" class="site-footer-link">Thư viện</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="#" class="site-footer-link">Liên hệ</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>


        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
