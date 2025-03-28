<?php  
session_start(); // Bắt đầu session  

// Kết nối đến cơ sở dữ liệu  
include "Model/con_db.php";

// Kiểm tra kết nối  
if ($conn->connect_error) {  
    die("Kết nối thất bại: " . $conn->connect_error);  
}  

// Lấy từ khóa tìm kiếm  
$search = isset($_GET['search']) ? trim($_GET['search']) : '';  

// Tránh SQL injection  
$search = $conn->real_escape_string($search);  

// Truy vấn tìm kiếm  
$sql = "SELECT * FROM khoa_hoc WHERE ten_khoa_hoc LIKE '%$search%'";  
$result = $conn->query($sql);  
?>  

<!DOCTYPE html>  
<html lang="vi">  
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="icon" href="images/logo.png">

        <title>Tìm kiếm</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap" rel="stylesheet">
                        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/info.css">

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
                                <a class="nav-link" href="index.php">Trang chủ</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="about.php">Giới thiệu</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Trang</a>

                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                    <li><a class="dropdown-item active" href="listing-page.php">Khóa học</a></li>
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
                    
                </div>
            </section>

            <section class="user-info-section">  
    <style>  
        /* Đảm bảo CSS này chỉ ảnh hưởng đến phần user-info-section */  
        .user-info-section .container {  
            margin: 20px;  
        }  
        .user-info-section .title {  
            text-align: center;  
            font-family: 'Arial', sans-serif;  
            color:rgb(65, 199, 236);  
        }  
        .user-info-section .user-info {  
            text-align: center;   
        }  
        .user-info-section .row {  
            display: flex; /* Sử dụng flexbox để căn giữa các ô */  
            justify-content: center; /* Căn giữa các ô */  
            flex-direction: column; /* Sắp xếp theo chiều dọc */  
            align-items: center; /* Căn giữa theo chiều ngang */  
            gap: 15px; /* Khoảng cách giữa các ô */  
        }  
        .user-info-section .custom-block {  
            width: 220px; /* Độ rộng của mỗi ô */  
            border: 2px solid #00BFFF; /* Đường viền của ô */  
            border-radius: 10px; /* Bo góc cho ô */  
            padding: 10px; /* Khoảng cách bên trong của ô */  
            display: flex;  
            flex-direction: column; /* Sắp xếp nội dung theo chiều dọc */  
            align-items: center; /* Căn giữa nội dung theo chiều ngang */  
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Thêm bóng cho các ô */  
            transition: transform 0.2s; /* Thêm hiệu ứng khi hover */  
        }  
        .user-info-section .custom-block:hover {  
            transform: scale(1.05); /* Hiệu ứng phóng to khi hover */  
        }  
        .user-info-section .custom-block-image-wrap {  
            text-decoration: none; /* Xóa gạch chân cho link */  
        }  
        .user-info-section .custom-block-image {  
            max-width: 100%; /* Ảnh tự động chiếm rộng ô */  
            height: auto; /* Giữ tỷ lệ cho ảnh */  
            border-radius: 5px; /* Bo góc cho ảnh */  
        }  
        .user-info-section .custom-block-info {  
            text-align: center; /* Căn giữa thông tin trong ô */  
        }  
        .user-info-section .badge {  
            background-color:rgb(235, 166, 61);  
            padding: 5px;  
            border-radius: 3px;  
        }  
        .user-info-section .btn {  
            margin-top: 20px;  
            padding: 10px 20px;  
            background-color:rgb(17, 141, 183);  
            color: white;  
            border: none;  
            border-radius: 5px;  
            cursor: pointer;  
        }  
    </style>  

    <div class="container">  
        <h1 class="title">Tìm kiếm '<?php echo htmlspecialchars($search); ?>'</h1>  
        <div class="user-info form-box">  
            <?php if ($result && $result->num_rows > 0): ?>  
                <div class="row">  
                    <?php while ($row = $result->fetch_assoc()): ?>  
                        <div class="custom-block">  
                            <a href='detail-page.php?id=<?php echo $row['id']; ?>' class='custom-block-image-wrap'>  
                                <img src='images/khoahoc/<?php echo $row['img']; ?>' class='custom-block-image img-fluid' alt='<?php echo htmlspecialchars($row['ten_khoa_hoc']); ?>'>  
                            </a>  
                            <div class='custom-block-info'>  
                                <h5 class='mb-1'>  
                                    <a href='detail-page.php?id=<?php echo $row['id']; ?>'><?php echo htmlspecialchars($row['ten_khoa_hoc']); ?></a>  
                                </h5>  
                                <p class='badge mb-0'><?php echo number_format($row['hoc_phi']); ?>đ</p>  
                            </div>  
                        </div>  
                    <?php endwhile; ?>  
                </div>  
            <?php else: ?>  
                <p>Không tìm thấy khóa học nào.</p>  
            <?php endif; ?>
                        <a href="index.php" class="btn">Quay lại trang tìm kiếm</a>  
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
