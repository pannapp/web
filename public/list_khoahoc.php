<?php
    if(isset($_SESSION['role']) && $_SESSION['role'] !=0) {
        header("Location:index.php");
        exit();
    }else{
        require "Model/con_db.php";
        session_start();

        $sql="
            SELECT * FROM khoa_hoc;
        ";

        $result=$conn->query($sql);
        $result_all=$result->fetch_all(MYSQLI_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách khóa học</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container">
    <h1>Danh sách khóa học  
       <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
        Thêm khóa học mới
        </button>
    </h1>
        <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>Tên khóa học</th>
            <th>Mô tả</th>
            <th>Học phí</th>
            <th>Hình ảnh mô tả</th>
            <th colspan=2>Hành động</th>

        </tr>
        </thead>
        <tbody>
            <?php
                foreach($result_all as $row){
                    echo "
                        <tr>
                            <td>".$row['ten_khoa_hoc']."</td>
                            <td>".$row['mo_ta']."</td>
                            <td>".$row['hoc_phi']."</td>
                            <td><img src='images/khoahoc/".$row['img']."' style='width:50px; height=auto;'></td>
                            <td>
                                <form action='khoa_hoc_edit.php' method='post'>
                                    <input type='submit' class='btn btn-primary' value='Sửa'>
                                    <input type='hidden' name='id' value='".$row['id']."'>
                                </form>
                            </td>
                                <td>
                                <form action='xoa_khoa_hoc.php' method='post'>
                                    <input type='submit' class='btn btn-danger' value='Xóa'>
                                    <input type='hidden' name='id' value='".$row['id']."'>
                                </form>
                            </td>

                        </tr>
                    ";

                }
           
            
            ?>
         

       
        </tbody>
    </table>





    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Thêm khóa học</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <form action="xulianh.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="tenkhoahoc">Tên khóa học:</label>
                    <input type="text" id="tenkhoahoc" class="form-control" name="ten_khoa_hoc">
                
                </div>
                <div class="form-group">
                    <label for="hocphi">Học phí:</label>
                    <input type="text" id="hocphi" class="form-control" name="hoc_phi">
        
                </div>
                <div class="form-group">
                    <label for="mota">Mô tả:</label>
                    <input type="text" id="mota" class="form-control" name="mota">
        
                </div>
                <?php 
                    if (isset($_SESSION['upload_error']) && $_SESSION['upload_error'] !="" ){
                        echo "<br><font color ='red'>".$_SESSION['upload_error']."</font>";
                        $_SESSION['upload_error']="";
                    }
                ?>
                <div class="form-group">
                    <label for="anh">Thêm Ảnh</label>
                    <input type="file" id="anh" name="imgupload">
        
                </div>

                <button class="btn btn-success">Thêm khóa học</button>

            </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
    </div>






   <!-- jQuery library -->
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>