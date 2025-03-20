<?php
    if(isset($_SESSION['role']) && $_SESSION['role'] !=0) {
        header("Location:index.php");
        exit();
    }else{
        require "Model/con_db.php";

        $id = $_POST["id"];

        $sql="
            DELETE FROM khoa_hoc WHERE ID= " . $_POST['id'] . "
        ";

        if($conn->query($sql) == true){
            header("Location:list_khoahoc.php");
        }else{
            echo "Error:". $sql ."<br>". $conn->error;
        }


        $conn->close();
    }
?>