<!DOCTYPE html>
<?php
    session_start();
    if(isset($_SESSION['role']) && $_SESSION['role'] !=0) header("Location:index.php");
    require "Model/con_db.php";

    
    $id=$_POST["id"];
    $sql="SELECT * FROM khoa_hoc WHERE ID=". $id ."";
    $result=$conn->query($sql);
    $row = $result->fetch_assoc();



?>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Page</title>
        <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">


    </head>
    <body>
        <div class="container">
        <h1>Sửa khóa học</h1>

            <form action="khoahoc_edit_save.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="tenkhoahoc">Tên khóa học:</label>
                    <input type="text" id="tenkhoahoc" class="form-control" name="ten_khoa_hoc" value="<?php echo $row['ten_khoa_hoc']    ?>">

                </div>
                <div class="form-group">
                    <label for="hocphi">Học phí:</label>
                    <input type="text" id="hocphi" class="form-control" name="hoc_phi" value="<?php echo $row['hoc_phi']    ?>">
        
                </div>
                <div class="form-group">
                    <label for="mota">Mô tả:</label>
                    <input type="text" id="mota" class="form-control" name="mota" value="<?php echo $row['mo_ta']    ?>">
        
                </div>
             

                <div class="form-group">
                    <label for="anh">Ảnh trước đó: </label>
                    <img src="images/khoahoc/<?php echo $row['img']; ?>" style="width:50px; height=auto;">
        
                </div>
                <?php 
                    if (isset($_SESSION['upload_error']) && $_SESSION['upload_error'] !="" ){
                        echo "<br><font color ='red'>".$_SESSION['upload_error']."</font>";
                        $_SESSION['upload_error']="";
                    }
                ?>
                <div class="form-group">
                    <label for="anh">Sửa ảnh: </label>
                    <input type="file" id="anh" name="imgupload" >
        
                </div>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <button class="btn btn-success">Hoàn thành</button>

            </form>


        </div>

        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>