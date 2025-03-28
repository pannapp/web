<?php
    session_start();
    if(isset($_SESSION['role']) && $_SESSION['role'] !=0) {
        header("Location:index.php");
        exit();
    }else{
        include "Model/con_db.php";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ten_khoa_hoc = trim($_POST['ten_khoa_hoc']);
            $hoc_phi = trim($_POST['hoc_phi']);
            $mo_ta = trim($_POST['mota']);
            $id=$_POST['id'];

            if (empty($ten_khoa_hoc)) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin!";
                header("Location: list_khoahoc.php");
                exit();
            }

            // T?o thu m?c n?u chua t?n t?i
    

            if(!isset($_FILES['imgupload']) || $_FILES['imgupload']['error'] != 0){
                $stmt1 = $conn->prepare("
                            
                    UPDATE khoa_hoc
                    SET ten_khoa_hoc= ?,
                        mo_ta=?,
                        hoc_phi=?
                    WHERE id = ?
                
                
                ");
                $stmt1->bind_param("ssii", $ten_khoa_hoc, $mo_ta, $hoc_phi,$id);
                if ($stmt1->execute()) {
                    $_SESSION['Create_success'] = "Khóa học đã được thêm thành công.";
                    header("Location:list_khoahoc.php");
                    exit();
                } else {
                    $_SESSION['upload_error'] = "Lỗi khi lưu vào database.";
                    exit();
                }

            }else{

                $target_dir = "images/khoahoc/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                    exit();
                }
                // X? lý file upload
                $file_name = time() . "_" . basename($_FILES["imgupload"]["name"]); // Ð?i tên file tránh trùng
                $target_file = $target_dir . $file_name;
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Ki?m tra có ph?i ?nh không
                $check = getimagesize($_FILES["imgupload"]["tmp_name"]);
                if ($check === false) {
                    $_SESSION['upload_error'] = "File không phải là ảnh.";
                    $uploadOk = 0;
                }

                // Gi?i h?n kích thu?c file (5MB)
                if ($_FILES["imgupload"]["size"] > 10 * 1024 * 1024) {
                    $_SESSION['upload_error'] = "File quá lớn (tối da 5MB).";
                    $uploadOk = 0;
                    exit();
                }

                // Ch? cho phép m?t s? d?nh d?ng file
                $allowed_types = ["jpg", "png", "jpeg", "gif"];
                if (!in_array($imageFileType, $allowed_types)) {
                    $_SESSION['upload_error'] = "Chỉ hỗ trợ JPG, JPEG, PNG, GIF.";
                    $uploadOk = 0;
                    exit();
                }

                // Ki?m tra n?u có l?i
                if ($uploadOk == 0) {
                    $_SESSION['upload_error'] = "Tải file thất bại";
                    exit();
                } else {
                    // Di chuy?n file vào thu m?c luu tr?
                    if (move_uploaded_file($_FILES["imgupload"]["tmp_name"], $target_file)) {
                        $_SESSION['upload_success'] = "File " . htmlspecialchars($file_name) . " đã tải lên.";

                        // Luu thông tin vào database
                        $stmt = $conn->prepare("
                        
                            UPDATE khoa_hoc
                            SET ten_khoa_hoc= ?,
                                mo_ta=?,
                                hoc_phi=?,
                                img=?
                            WHERE id = ?
                        
                        
                        ");
                        $stmt->bind_param("ssisi", $ten_khoa_hoc, $mo_ta, $hoc_phi, $file_name,$id);
                        if ($stmt->execute()) {
                            $_SESSION['Create_success'] = "Khóa học đã được thêm thành công.";
                            header("Location:list_khoahoc.php");
                            exit();
                        } else {
                            $_SESSION['upload_error'] = "Lỗi khi lưu vào database.";
                            exit();
                        }
                        $stmt->close();

                        exit();
                    } else {
                        $_SESSION['upload_error'] = "Lỗi trong quá trình tải file.";
                        exit();
                    }
                }
                header("Location:list_khoahoc.php");
                exit();


            }


        }
        header("Location:list_khoahoc.php");
        exit();
    }

?>
