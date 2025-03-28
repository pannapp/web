<!doctype html>
<?php
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role'] !=3){
        include "Model/con_db.php";
        
    }
    
?>