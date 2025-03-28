<?php
    session_start();
    ob_start();
    include "con_db.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ho_ten_reg = trim($_POST['ho_ten_reg']);
        $username_reg = trim($_POST['username_reg']);
        $email_reg = trim($_POST['email_reg']);
        $sdt_reg = trim($_POST['sdt_reg']);
        $pass_reg = trim($_POST['password_reg']);
        //$pass = password_hash($pass, PASSWORD_DEFAULT);
        if (empty($ho_ten_reg) || empty($username_reg) || empty($pass_reg) || empty($email_reg) ) {
            $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin !";
            header("Location: login-register.php#register");
            exit();
        }
        else{
            //truy van tai khoan
            $stmt = $conn->prepare("SELECT 
                                    COUNT(CASE WHEN tai_khoan = ? THEN 1 END) AS so_luong_username,
                                    COUNT(CASE WHEN email = ? THEN 1 END) AS so_luong_email,
                                    COUNT(CASE WHEN sdt = ? THEN 1 END) AS so_luong_sdt
                                    FROM nguoi_dung");
            $stmt->bind_param("sss", $username_reg, $email_reg, $sdt_reg);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($row['so_luong_username']==0 && $row['so_luong_email']==0 && $row['so_luong_sdt']==0){
                $pass_reg_hash=password_hash($pass_reg, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO nguoi_dung(ho_ten,email,sdt,tai_khoan,mat_khau) values(?,?,?,?,?)");
                $stmt->bind_param("sssss",$ho_ten_reg,$email_reg, $sdt_reg, $username_reg, $pass_reg_hash );
                $stmt->execute();
                $_SESSION['username']=$username_reg;
                $_SESSION['role']=1;
                header("Location: ../index.php");
                exit();
            } else {
                    if ($row['so_luong_username']>0){
                        $_SESSION['error1']="Tài khoản đã tồn tại";
                    }
                    if ($row['so_luong_email']>0){
                        $_SESSION['error2']="Email đã được đăng ký rồi";
                    }
                    if ($row['so_luong_sdt']>0){
                        $_SESSION['error3']="Số điện thoại đã được đăng ký rồi";
                    }
                    header("Location: login-register.php#register");
                    exit();
                }
            exit();

        }
    }
    
?>