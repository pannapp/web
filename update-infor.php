<?php  
session_start();  
if ($_SESSION['role'] != 0 && $_SESSION['role'] != 1) {  
    $_SESSION['role'] = 3;  
}  
if (!isset($_SESSION['role']) || $_SESSION['role'] == 3) {   
    header("Location: login-register.php");  
    exit();  
}  

include "Model/con_db.php";  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    // Lấy dữ liệu từ người dùng  
    $ho_ten = $_POST['ho_ten'];  
    $ngay_sinh = $_POST['ngay_sinh'];  
    $email = $_POST['email'];  
    $sdt = $_POST['sdt'];  

    // Cập nhật thông tin trong cơ sở dữ liệu  
    $stmt = $conn->prepare("UPDATE nguoi_dung SET ho_ten = ?, ngay_sinh = ?, email = ?, sdt = ? WHERE tai_khoan = ?");  
    $stmt->bind_param("sssss", $ho_ten, $ngay_sinh, $email, $sdt, $_SESSION['username']);  
    
    if ($stmt->execute()) {  
        // Cập nhật thông tin người dùng trong phiên  
        $_SESSION['user']['ho_ten'] = $ho_ten;  
        $_SESSION['user']['ngay_sinh'] = $ngay_sinh;  
        $_SESSION['user']['email'] = $email;  
        $_SESSION['user']['sdt'] = $sdt;  

        // Chuyển hướng đến trang thông báo thành công  
        header("Location: user-infor.php?success=1");  
        exit();   
    } else {  
        $error_message = "Cập nhật thông tin thất bại!";  
    }  
}  

// Lấy thông tin người dùng hiện tại  
$stmt = $conn->prepare("SELECT ho_ten, ngay_sinh, email, sdt FROM nguoi_dung WHERE tai_khoan = ? ");  
$stmt->bind_param("s", $_SESSION['username']);  
$stmt->execute();  
$result = $stmt->get_result();  
$user = $result->fetch_assoc();  
?>  


<!doctype html>
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
                    <a class="navbar-brand me-lg-5 me-0" href="user-infor.php"> 
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
                                    <li><a class="dropdown-item" href="listing-page.php">Khóa học</a></li>
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
                                    echo "<a href='login-register.php' class='btn custom-btn custom-border-btn smoothscroll'>Ðang nh?p</a>";
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
                <div class="container">  
                    <h1 class="title">Cập Nhật Thông Tin</h1>  
                    <?php   
                    if (isset($success_message)) {  
                        echo "<div class='alert alert-success'>$success_message</div>";   
                    }  
                    if (isset($error_message)) {  
                        echo "<div class='alert alert-danger'>$error_message</div>";   
                    }  
                    ?>  
                    <div class="user-info text-center form-box">  
                        <form method="post">  
                            <div class="form-group">  
                                <label><strong>Tên:</strong></label>  
                                <input type="text" name="ho_ten" class="form-control" value="<?php echo $user['ho_ten']; ?>" required>  
                            </div>  
                            <div class="form-group">  
                                <label><strong>Ngày sinh:</strong></label>  
                                <input type="date" name="ngay_sinh" class="form-control" value="<?php echo $user['ngay_sinh']; ?>" required>  
                            </div>  
                            <div class="form-group">  
                                <label><strong>Email:</strong></label>  
                                <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>  
                            </div>  
                            <div class="form-group">  
                                <label><strong>Số điện thoại:</strong></label>  
                                <input type="text" name="sdt" class="form-control" value="<?php echo $user['sdt']; ?>" required>  
                            </div>  
                            
                            <div class="button-group">  
                                <button type="submit" class="btn btn-primary">Cập nhật</button>  
                                <a type="submit" href="update-password.php" class="btn btn-secondary">Đổi mật khẩu</a>  
                                <a href="user-infor.php" class="btn btn-secondary">Quay lại</a> 
                            </div>  
                        </form>  
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
