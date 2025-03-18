<!DOCTYPE html>
<?php
    session_start();
    ob_start(); 
    include "Model/con_db.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['username']);
        $pass = trim($_POST['pwd']);
        // $pass = password_hash($pass1, PASSWORD_DEFAULT);
        if (empty($username) || empty($pass)) {
            $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin!";
            header("Location: login-register.php");
            exit();
        }
        else{
            //truy van tai khoan
            $stmt = $conn->prepare("SELECT tai_khoan, mat_khau, vai_tro FROM nguoi_dung WHERE tai_khoan = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($result->num_rows == 1) {
                    $_SESSION['role']= 3;
                    if (password_verify($pass, $row['mat_khau'])) { // Kiểm tra mật khẩu
                        $_SESSION['username'] = $row['tai_khoan'];
                        $_SESSION['role'] = $row['vai_tro'];
                        if ($_SESSION['role']==0){
                            $_SESSION['username']= $username;
                            header("Location: index.php");
                            exit();
                        }
                        else{
                            if($_SESSION['role']==1){
                                $_SESSION['username']= $username;
                                header("Location: index.php");
                                exit();
                            }
                        }
                        exit();
                    } else {
                        $_SESSION['error'] = "Sai mật khẩu" ;
                        header("Location: login-register.php");
                        exit();
                    }
            } else {
                    $_SESSION['error'] = "Tài khoản không tồn tại!";
                    header("Location: login-register.php");
                    exit();
                }
            exit();
        }
    } 
?>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Register</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container register-container">
            <form method="post" action="Model/register.php">
                <h1>Đăng ký</h1>
                <?php 
                                if (isset($_SESSION['error'])&& $_SESSION['error'] =="Vui lòng điền đầy đủ thông tin!" ){
                                    echo "<br><font color ='red'>".$_SESSION['error']."</font>";
                                    $_SESSION['error']="";
                                }
                                ?>
                <input name="ho_ten_reg" type="text" placeholder="Tên người dùng">
                <?php 
                                if (isset($_SESSION['error1'])&& $_SESSION['error1'] != ""){
                                    echo "<br><font color ='red'>".$_SESSION['error1']."</font>";
                                    $_SESSION['error1']="";
                                }
                                ?>
                <input name="username_reg" type="text" placeholder="Tên đăng nhập">
                <?php 
                                if (isset($_SESSION['error2'])&& $_SESSION['error2'] != ""){
                                    echo "<br><font color ='red'>".$_SESSION['error2']."</font>";
                                    $_SESSION['error2']="";
                                }
                                ?>
                <input name="email_reg" type="email" placeholder="Email">
                <?php 
                                if (isset($_SESSION['error3'])&& $_SESSION['error3'] != ""){
                                    echo "<br><font color ='red'>".$_SESSION['error3']."</font>";
                                    $_SESSION['error3']="";
                                }
                                ?>
                <input name="password_reg" type="password" placeholder="Mật khẩu">
                <button type="submit">Đăng ký</button>
                <span>Hoặc đăng ký với</span>
                <div class="social-container">
                    <a href="#" class="social"><i class="lni lni-facebook-fill"></i></a>
                    <a href="#" class="social"><i class="lni lni-google"></i></a>
                </div>
            </form>
        </div>

        <div class="form-container login-container">
            <form method="post" id="form-dang-nhap">
                <h1>Đăng nhập</h1>
                <?php 
                                if (isset($_SESSION['error'])&& $_SESSION['error'] != ""){
                                    echo "<br><font color ='red'>".$_SESSION['error']."</font>";
                                    $_SESSION['error']="";
                                }
                                ?>
                <input name="username" type="text" placeholder="Tên đăng nhập">
                <input name="pwd" type="password" placeholder="Mật khẩu">
                <div class="content">
                    <div class="checkbox">
                        <input type="checkbox" name="checkbox" id="checkbox">
                        <label>Ghi nhớ mật khẩu</label>
                    </div>
                    <div class="pass-link">
                        <a href="#">Quên mật khẩu?</a>
                    </div>
                </div>
                <button type="submit">Đăng nhập</button>
                <span>Hoặc đăng nhập với</span>
                <div class="social-container">
                    <a href="#" class="social"><i class="lni lni-facebook-fill"></i></a>
                    <a href="#" class="social"><i class="lni lni-google"></i></a>
                </div>
            </form>
        </div>
    
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Chào mừng <br>thành viên mới</h1>
                    <p>Nếu bạn đã có tài khoản, hãy nhấn vào đăng nhập.</p>
                    <button class="ghost" id="login">Đăng nhập
                        <i class="lni lni-arrow-left login"></i>
                    </button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="title">Chào mừng <br> bạn đã trở lại</h1>
                    <p>Nếu bạn chưa có tài khoản trước đây, hãy nhấn vào nút đăng ký.</p>
                    <button class="ghost" id="register">Đăng ký
                        <i class="lni lni-arrow-right register"></i>
                    </button>
                </div>

            </div>

        </div>

    </div>

    <script src="./js/script.js"></script>
</body>
</html>