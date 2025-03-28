<?php  
session_start();  

// Kiểm tra vai trò người dùng  
if (!isset($_SESSION['role'])) {  
    header("Location: login-register.php");  
    exit();  
}  

include "Model/con_db.php";  

// Lấy thông tin người dùng từ DB  
$stmt = $conn->prepare("SELECT ho_ten, email, vai_tro FROM nguoi_dung WHERE tai_khoan = ?");  
$stmt->bind_param("s", $_SESSION['username']);  
$stmt->execute();  
$result = $stmt->get_result();  
$user = $result->fetch_assoc();  

// Kiểm tra nếu form đã được gửi  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    if (isset($_POST['messageContent'])) { // Xử lý gửi phản hồi  
        $messageContent = htmlspecialchars(trim($_POST['messageContent']));  

        // Chèn phản hồi vào cơ sở dữ liệu  
        $stmt = $conn->prepare("INSERT INTO feedback (ho_ten, email, content, status) VALUES (?, ?, ?, 0)");  
        $stmt->bind_param("sss", $user['ho_ten'], $user['email'], $messageContent);  

        if ($stmt->execute()) {  
            $successMessage = 'Phản hồi đã được gửi thành công!';  
        } else {  
            $errorMessage = 'Đã xảy ra lỗi, vui lòng thử lại sau.';  
        }  
    }  
    
    if (isset($_POST['feedbackId']) && isset($_POST['status'])) { // Xử lý cập nhật trạng thái  
        $feedbackId = $_POST['feedbackId'];  
        $newStatus = $_POST['status'] == 'true' ? 1 : 0;  

        $stmt = $conn->prepare("UPDATE feedback SET status = ? WHERE id = ?");  
        $stmt->bind_param("ii", $newStatus, $feedbackId);  
        $stmt->execute();  
    }  
}  

// Lấy phản hồi  
if ($user['vai_tro'] == 1) { // Admin  
    $feedbacks = $conn->query("SELECT * FROM feedback ORDER BY created_at DESC");  
} else { // Người dùng bình thường  
    $stmt = $conn->prepare("SELECT * FROM feedback WHERE email = ? ORDER BY created_at DESC");  
    $stmt->bind_param("s", $user['email']);  
    $stmt->execute();  
    $feedbacks = $stmt->get_result();  
}  
?>  


<!doctype html>  
<html lang="en">  
    <head>  
        <meta charset="utf-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <meta name="description" content="">  
        <meta name="author" content="">  
        <link rel="icon" href="images/logo.png">  
        <title>Liên Hệ</title>  

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">  
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>  
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap" rel="stylesheet">  
        <link rel="stylesheet" href="css/bootstrap.min.css">  
        <link rel="stylesheet" href="css/bootstrap-icons.css">  
        <link rel="stylesheet" href="css/owl.carousel.min.css">  
        <link rel="stylesheet" href="css/owl.theme.default.min.css">  
        <link href="css/templatemo-pod-talk.css" rel="stylesheet">  
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
                                <a class="nav-link active" href="about.php">Giới thiệu</a>
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
                                    echo "<a href='login-register.php' class='btn custom-btn custom-border-btn smoothscroll'>Ðăng nhập</a>";
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

                            <h2 class="mb-0">Liên hệ</h2>
                        </div>

                    </div>
                </div>
            </header>
    

            <section class="user-info-section">  
        <div class="container">  
            <h1 class="title" style="color: #439fcd; text-align: center;">Liên Hệ Chúng Tôi</h1>  
            <div class="form-box">  
                <form id="contactForm" method="post">  
                    <div class="form-group">  
                        <label for="userName">Họ và tên</label>  
                        <input type="text" id="userName" class="form-control" value="<?php echo htmlspecialchars($user['ho_ten']); ?>" readonly>  
</div>  
<div class="form-group">  
    <label for="userEmail">Email</label>  
    <input type="email" id="userEmail" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>  
</div>  
<div class="form-group">  
    <label for="messageContent">Nội dung</label>  
    <textarea id="messageContent" name="messageContent" class="form-control" rows="5" placeholder="Nhập nội dung bạn muốn gửi..." required></textarea>  
</div>  
<button type="submit" class="btn btn-primary">Gửi</button>  
</form>  
<?php if (isset($successMessage)): ?>  
<div class="alert alert-success" role="alert">  
    <?php echo $successMessage; ?>  
</div>  
<?php elseif (isset($errorMessage)): ?>  
<div class="alert alert-danger" role="alert">  
    <?php echo $errorMessage; ?>  
</div>  
<?php endif; ?>  
</div>  
</div>  
</section>  

<section class="feedback-section">  
    <div class="container">  
        <h2 class="text-center" style="color: #439fcd;">Danh Sách Phản Hồi</h2>  
        <table class="table table-bordered">  
            <thead>  
                <tr>  
                    <th>STT</th>  
                    <th>Tên</th>  
                    <th>Email</th>  
                    <th>Nội Dung</th>  
                    <?php if ($user['vai_tro'] == 1): // Admin ?>  
                    <th>Trạng Thái</th>  
                    <th>Thời gian</th>  
                    <th>Hành động</th>  
                    <?php else: // Người dùng bình thường ?>  
                    <th>Trạng Thái</th>  
                    <th>Thời gian</th>  
                    <?php endif; ?>  
                </tr>  
            </thead>  
            <tbody>  
                <?php  
                if ($user['vai_tro'] == 1) { // Admin  
                    if ($feedbacks->num_rows > 0) {  
                        $stt = 1;  
                        while ($row = $feedbacks->fetch_assoc()) {  
                            echo "<tr>  
                                    <td>{$stt}</td>  
                                    <td>" . htmlspecialchars($row['ho_ten']) . "</td>  
                                    <td>" . htmlspecialchars($row['email']) . "</td>  
                                    <td>" . htmlspecialchars($row['content']) . "</td>  
                                    <td>" . ($row['status'] ? "Đã trả lời" : "Chưa trả lời") . "</td>  
                                    <td>" . $row['created_at'] . "</td>  
                                    <td>  
                                        <form method='post' style='display:inline;'>  
                                            <input type='hidden' name='feedbackId' value='" . $row['id'] . "'>  
                                            <button type='submit' name='status' value='" . ($row['status'] == 1 ? 'false' : 'true') . "' class='btn btn-sm " . ($row['status'] == 1 ? 'btn-warning' : 'btn-success') . "'>  
                                                " . ($row['status'] == 1 ? 'Đánh dấu chưa trả lời' : 'Đánh dấu đã trả lời') . "  
                                            </button>  
                                        </form>  
                                    </td>  
                                  </tr>";  
                            $stt++;  
                        }  
                    } else {  
                        echo "<tr><td colspan='6'>Chưa có phản hồi nào</td></tr>";  
                    }  
                } else { // Người dùng bình thường  
                    if ($feedbacks->num_rows > 0) {  
                        $stt = 1;  
                        while ($row = $feedbacks->fetch_assoc()) {  
                            echo "<tr>  
                                    <td>{$stt}</td>  
                                    <td>" . htmlspecialchars($row['ho_ten']) . "</td>  
                                    <td>" . htmlspecialchars($row['email']) . "</td>  
                                    <td>" . htmlspecialchars($row['content']) . "</td>  
                                    <td>  
                                        <input type='checkbox' disabled " . ($row['status'] ? 'checked' : '') . ">  
                                        " . ($row['status'] ? 'Đã trả lời' : 'Chưa trả lời') . "  
                                    </td>  
                                    <td>" . $row['created_at'] . "</td>  
                                  </tr>";  
                            $stt++;  
                        }  
                    } else {  
                        echo "<tr><td colspan='5'>Chưa có phản hồi nào</td></tr>";  
                    }  
                }  
                ?>  
            </tbody>  
        </table>  
    </div>  
</section>  

<section class="map-section" style="margin: 30px 0;">  
    <div class="container">  
        <h2 class="text-center" style="color: #439fcd;">Bản Đồ Địa Chỉ</h2>  
        <div class="map-container">  
            <iframe  
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.8415184420396!2d105.76804037480721!3d10.029933690077016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBD4bqnbiBUaMah!5e0!3m2!1svi!2s!4v1712329619983!5m2!1svi!2s"
  
                width="100%" height="400"  
                style="border:0;" allowfullscreen="" loading="lazy"></iframe>  
        </div>  
    </div>  
</section>
    
                <footer class="site-footer">   
                    <div class="container">  
                        <div class="row">  
                            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-md-0">  
                                <h6 class="site-footer-title mb-3">Liên Hệ</h6>  
                                <p class="mb-2"><strong class="d-inline me-2">Điện thoại:</strong> +89 706 317 21</p>  
                                <p>  
                                    <strong class="d-inline me-2">Email:</strong>  
                                    <a href="mailto:phatb2203463@student.ctu.edu.vn">phatb2203463@student.ctu.edu.vn</a>   
                                </p>  
                            </div>  
    
                            <div class="col-lg-6 col-12 mb-5 mb-lg-0">  
                                <!-- Additional content can go here -->  
                            </div>  
    
                            <div class="col-lg-3 col-md-6 col-12">  
                                <h6 class="site-footer-title mb-3">Tải Ứng Dụng</h6>  
                                <div class="site-footer-thumb mb-4 pb-2">  
                                    <div class="d-flex flex-wrap">  
                                        <a href="#">  
                                            <img src="images/app-store.png" class="me-3 mb-2 mb-lg-0 img-fluid" alt="App Store">  
                                        </a>  
                                        <a href="#">  
                                            <img src="images/play-store.png" class="img-fluid" alt="Play Store">  
                                        </a>  
                                    </div>  
                                </div>  
                                <h6 class="site-footer-title mb-3">Mạng Xã Hội</h6>  
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
                            <div class="col-lg-2 col-md-3
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
                                    <a href="Libary.php" class="site-footer-link">Thư viện</a>  
                                </li>  
                                <li class="site-footer-link-item">  
                                    <a href="contact.php" class="site-footer-link">Liên hệ</a>  
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

        </main>  
    </body>  
</html>  