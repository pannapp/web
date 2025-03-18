<!doctype html>
<?php
    session_start();
    if (isset($_SESSION['role'])){
        if($_SESSION['role'] != 0 && $_SESSION['role'] !=1)
            $_SESSION['role']=3;
    }
    include "Model/con_db.php";
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("SELECT id,ten_khoa_hoc, mo_ta,FORMAT(FLOOR(hoc_phi), 0, 'de_DE') AS hoc_phi,img FROM khoa_hoc WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $khoa_hoc = $result->fetch_assoc();
        } 
    } else {
        $_SESSION['error']= "Không có khóa học được chọn";
        exit();
    }
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Danh mục</title>

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

TemplateMo 584 Pod Talk

https://templatemo.com/tm-584-pod-talk

-->
    </head>
    
    <body>
        <main>
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand me-lg-5 me-0" href="index.php">
                        <img src="images/logo.png" class="logo-image img-fluid" alt="templatemo pod talk">
                    </a>

                    <form action="#" method="get" class="custom-form search-form flex-fill me-3" role="search">
                        <div class="input-group input-group-lg">    
                            <input name="search" type="search" class="form-control" id="search" placeholder="Tìm khóa học" aria-label="Search">

                            <button type="submit" class="form-control" id="submit">
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
                                <a class="nav-link" href="index.php">Trang chủ</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="about.php">Giới thiệu</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Trang</a>

                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                    <li><a class="dropdown-item" href="listing-page.php">Khóa học</a></li>

                                    <li><a class="dropdown-item" href="Libary.php">Thư viện</a></li>
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


            <header class="site-header d-flex flex-column justify-content-center align-items-center">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12 text-center">

                            <h2 class="mb-0">Chi tiết khóa học</h2>
                        </div>

                    </div>
                </div>
            </header>


            <section class="latest-podcast-section pb-0" id="section_2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="row">
                                <div class="col-lg-3 col-12">
                                    <div class="custom-block-icon-wrap">
                                        <div class="custom-block-image-wrap custom-block-image-detail-page">
                                            <?php
                                                echo "<img src='images/khoahoc/".$khoa_hoc['img']."' class='custom-block-image img-fluid' alt=''>";
                                            ?>
                                            <div class='profile-block profile-detail-block d-flex flex-wrap align-items-center mt-5'>
                                                <?php 
                                                if ($khoa_hoc['hoc_phi'] == 0){
                                                    echo "<a href='#'><h3 style='color:rgb(119, 186, 4);'><i class='bi bi-cart-plus'></i>Miễn phí</h3></a>";
                                                }
                                                else{
                                                    echo "<a href='#'><h3 style='color:rgb(119, 186, 4);'><i class='bi bi-cart-plus'></i>Đăng ký ".$khoa_hoc['hoc_phi']."đ</h3></a>";
                                                }
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <?php 
                                        echo    "<div class='custom-block-info'>
                                                <h2 class='mb-2'>".$khoa_hoc['ten_khoa_hoc']."</h2>

                                                <p>".$khoa_hoc['mo_ta']."</p>

                                                </div>";
                                    ?>
                                    
                            
                                </div>
                                <div class="col-lg-3 col-12" style="background-color: #f0f0f0ff;">
                                    
                                        <a class="navbar-brand me-lg-5 me-0" href="index.php">
                                        <img src="images/logo.png" class="logo-image" alt="templatemo pod talk">
                                        </a>
                                        <h5>Đánh giá <i class="bi bi-star-fill"></i></h5>
                                    
                                    
                                    <div class="row">
                                        <?php 
                                            if ($_SESSION['role'] ==3){
                                                echo "<div class='col-11' style='background-color: #e3ecfcff; margin-left: 5px; margin-right: 5px;'>
                                               <p>Bạn cần <a href='login-register.php'>đăng nhập</a> để sử dụng chức năng này</p>
                                            </div>  ";
                                            }
                                            else {
                                                echo "<div class='col-2'>
                                            <a href=#><i class='bi bi-heart-fill'></i></a>
                                        </div> 
                                        <div class='col-2'>
                                            <a href=#><i class='bi bi-hand-thumbs-up'></i></a>
                                        </div>
                                        <div class='col-2'>
                                            <a href=#><i class='bi bi-emoji-neutral'></i></a>
                                        </div>
                                        <div class='col-2'>
                                            <a href=#><i class='bi bi-emoji-frown'></i></a>
                                        </div> 
                                        <div class='col-2'>
                                            <a href=#><i class='bi bi-hand-thumbs-down'></i></a>
                                        </div> ";
                                            }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <section class="related-podcast-section section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <div class="section-title-wrap mb-5">
                                <h4 class="section-title">Khóa học tương tự</h4>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="custom-block custom-block-full">
                                <div class="custom-block-image-wrap">
                                    <a href="detail-page.html">
                                        <img src="images/khoahoc/khoahoc1.jpg" class="custom-block-image img-fluid" alt="">
                                    </a>
                                </div>

                                <div class="custom-block-info">
                                    <h5 class="mb-2">
                                        <a href="detail-page.html">
                                            Tên khóa học
                                        </a>
                                    </h5>

                                    <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="custom-block custom-block-full">
                                <div class="custom-block-image-wrap">
                                    <a href="detail-page.html">
                                        <img src="images/khoahoc/khoahoc1.jpg" class="custom-block-image img-fluid" alt="">
                                    </a>
                                </div>

                                <div class="custom-block-info">
                                    <h5 class="mb-2">
                                        <a href="detail-page.html">
                                            Tên khóa học
                                        </a>
                                    </h5>

                                    <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="custom-block custom-block-full">
                                <div class="custom-block-image-wrap">
                                    <a href="detail-page.html">
                                        <img src="images/khoahoc/khoahoc1.jpg" class="custom-block-image img-fluid" alt="">
                                    </a>
                                </div>

                                <div class="custom-block-info">
                                    <h5 class="mb-2">
                                        <a href="detail-page.html">
                                            Tên khóa học
                                        </a>
                                    </h5>

                                    <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>

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
                            <a href="#" class="d-inline me-2"> phatb2203463@student.ctu.edu.vn</a>
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
                                <a href="index.php" class="site-footer-link">Trang chủ</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="listing-page.php" class="site-footer-link">Khóa học</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="MyCourse.php" class="site-footer-link">Thư viện</a>
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