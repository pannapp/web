<!doctype html>
<?php
    session_start();
    if (isset($_SESSION['role'])){
        if($_SESSION['role'] != 0 && $_SESSION['role'] !=1)
            $_SESSION['role']=3;
    }
    include "Model/con_db.php";
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $_SESSION['bkt_id'] = intval($_GET['id']);
    }
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="images/logo.png">
        <title>Practice</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="icon" href="images/logo.png">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap" rel="stylesheet">
                        
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <link rel="stylesheet" href="css/bootstrap-icons.css">

        <link rel="stylesheet" href="css/owl.carousel.min.css">
        
        <link rel="stylesheet" href="css/owl.theme.default.min.css">

        <link href="css/templatemo-pod-talk.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!--

TemplateMo 584 Pod Talk

https://templatemo.com/tm-584-pod-talk

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
                                    <li><a class="dropdown-item" href="listing-page.php">Khóa học</a></li>

                                    <li><a class="dropdown-item" href="Libary.php">Thư viện</a></li>
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


            <header class="site-header d-flex flex-column justify-content-center align-items-center">
                <div class="container">
                </div>
            </header>


            <section class="latest-podcast-section pb-0" id="section_2" style="margin-bottom: 30px;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                                <div class="section-title-wrap mb-5">
                                    <h4 class="section-title">Practice</h4>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 me-0">
                            <h5><strong>Danh sách bài học</strong></h5>
                            <div class='accordion' id='courseAccordion'>
                                <?php
                                $sql ="SELECT * FROM bai_hoc WHERE khoa_hoc_id=?;";                     
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $_SESSION['khoa_hoc']['id']);
                                $stmt->execute();
                                $result1 = $stmt->get_result();
                                if($result1->num_rows >0){
                                    while ($row = $result1->fetch_assoc()){
                                        
                                        echo    "<div class='accordion-item'>
                                                    <h2 class='accordion-header'>
                                                        <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#chapter".$row['id']."'>
                                                            ".$row['ten_bai_hoc']."
                                                        </button>
                                                    </h2>";
                                        echo            "<div id='chapter".$row['id']."' class='accordion-collapse collapse'>
                                                        <div class='accordion-body'>";

                                        $sql3 ="SELECT * FROM bai_kiem_tra WHERE bai_hoc_id=?;";                     
                                        $stmt = $conn->prepare($sql3);
                                        $stmt->bind_param("i", $row['id']);
                                        $stmt->execute();
                                        $result3 = $stmt->get_result();

                                        if($result3->num_rows >0){
                                            $i=1;

                                            while ($row1 = $result3->fetch_assoc()){
                                                echo    "<a href='practice.php?id=".$row1['id']."'>#".$i." ".$row1['ten_bkt']."</a><br>";     
                                                $i=$i+1;
                                            }
                                        }

                                        $sql2 ="SELECT * FROM tai_lieu WHERE bai_hoc_id=?;";                     
                                        $stmt = $conn->prepare($sql2);
                                        $stmt->bind_param("i", $row['id']);
                                        $stmt->execute();
                                        $result2 = $stmt->get_result();
                                        
                                        if($result2->num_rows >0){
                                            while ($row1 = $result2->fetch_assoc()){
                                                echo    "<a href='practice.php'>#".$i." ".$row1['ten_tai_lieu']."</a><i class='bi bi-file-earmark-pdf'></i><br>";     
                                                $i=$i+1;
                                            }
                                        }
                                            echo    "</div>
                                                </div>
                                                </div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        
                        <div class="col-lg-7 me-0" style="border: 2px solid rgb(197, 203, 214); ">
                            <form id="quizForm" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">  
                            <?php 
                                $sql5 ="SELECT * FROM audio WHERE bkt_id=?;";                     
                                $stmt = $conn->prepare($sql5);
                                $stmt->bind_param("i", $_SESSION['bkt_id']);
                                $stmt->execute();
                                $result5 = $stmt->get_result();
                                if($result5->num_rows >0){
                                    echo "<h6>Listening</h6>";
                                    $i=1;
                                    while ($row5 = $result5->fetch_assoc()){
                                        $sql6="SELECT id,noi_dung_chn,phuong_an_A,phuong_an_B,phuong_an_C,phuong_an_D,phuong_an_dung,left(phuong_an_dung,1) as dap_an FROM ngan_hang_chn WHERE audio_id=?;";
                                        $stmt = $conn->prepare($sql6);
                                        $stmt->bind_param("i", $row5['id']);
                                        $stmt->execute();
                                        $result6 = $stmt->get_result();

                                        if ($result6->num_rows >0){
                                            if($result6->num_rows ==1){
                                                $row6=$result6->fetch_assoc();
                                                $questions[] = $row6;
                                                echo "<p style='font-weight:bold';>Câu ".$i.":".$row6['noi_dung_chn']."</p>";
                                                $i=$i+1;
                                                echo "<div class='audio-player' id='audio-container'>
                                                    <button class='play-btn'><i class='fa fa-play'></i></button>
                                                    <span class='time current-time'>00:00</span>
                                                    <div class='progress'>
                                                        <div class='progress-bar'></div>
                                                    </div>
                                                    <span class='time duration'>00:00</span>
                                                    <button class='volume-btn'><i class='fa fa-volume-up'></i></button>
                                                    <audio src='".$row5['file_audio_url']."'></audio>
                                                    
                                                </div>";
                                                echo "<br><img src='".$row5['file_anh_url']."'><br>";
                                                echo "<input type='radio' name='question{$row6['id']}' value='A' " . (isset($_POST["question{$row6['id']}"]) && $_POST["question{$row6['id']}"] == 'A' ? 'checked' : '') . "> {$row6['phuong_an_A']}<br>";  
                                                echo "<input type='radio' name='question{$row6['id']}' value='B' " . (isset($_POST["question{$row6['id']}"]) && $_POST["question{$row6['id']}"] == 'B' ? 'checked' : '') . "> {$row6['phuong_an_B']}<br>";  
                                                echo "<input type='radio' name='question{$row6['id']}' value='C' " . (isset($_POST["question{$row6['id']}"]) && $_POST["question{$row6['id']}"] == 'C' ? 'checked' : '') . "> {$row6['phuong_an_C']}<br>";  
                                                echo "<input type='radio' name='question{$row6['id']}' value='D' " . (isset($_POST["question{$row6['id']}"]) && $_POST["question{$row6['id']}"] == 'D' ? 'checked' : '') . "> {$row6['phuong_an_D']}<br>";  
                                            }
                                            else{
                                                echo "<div class='audio-player' id='audio-container'>
                                                    <button class='play-btn'><i class='fa fa-play'></i></button>
                                                    <span class='time current-time'>00:00</span>
                                                    <div class='progress'>
                                                        <div class='progress-bar'></div>
                                                    </div>
                                                    <span class='time duration'>00:00</span>
                                                    <button class='volume-btn'><i class='fa fa-volume-up'></i></button>
                                                    <audio src='".$row5['file_audio_url']."' controls></audio>
                                                    
                                                </div>";
                                                echo "<br><img src='".$row5['file_anh_url']."'><br>";
                                                while ($row6=$result6->fetch_assoc()){
                                                    $questions[] = $row6;
                                                    echo "<p style='font-weight:bold';>Câu ".$i.":".$row6['noi_dung_chn']."</p><br>";
                                                    $i=$i+1;
                                                    echo "<input type='radio' name='question{$row6['id']}' value='A' " . (isset($_POST["question{$row6['id']}"]) && $_POST["question{$row6['id']}"] == 'A' ? 'checked' : '') . "> {$row6['phuong_an_A']}<br>";  
                                                    echo "<input type='radio' name='question{$row6['id']}' value='B' " . (isset($_POST["question{$row6['id']}"]) && $_POST["question{$row6['id']}"] == 'B' ? 'checked' : '') . "> {$row6['phuong_an_B']}<br>";  
                                                    echo "<input type='radio' name='question{$row6['id']}' value='C' " . (isset($_POST["question{$row6['id']}"]) && $_POST["question{$row6['id']}"] == 'C' ? 'checked' : '') . "> {$row6['phuong_an_C']}<br>";  
                                                    echo "<input type='radio' name='question{$row6['id']}' value='D' " . (isset($_POST["question{$row6['id']}"]) && $_POST["question{$row6['id']}"] == 'D' ? 'checked' : '') . "> {$row6['phuong_an_D']}<br>";
                                                }
                                            }
                                        }
                                    }
                                }
                                //trac nghiem-----------------------------------------------------------
                                $i=1;
                                $sql7="SELECT id,cau_hoi,dap_an_A,dap_an_B,dap_an_C,dap_an_D,dap_an_dung,left(dap_an_dung,1) as dap_an FROM phuong_an WHERE bkt_id=?;";
                                $stmt = $conn->prepare($sql7);
                                $stmt->bind_param("i", $_SESSION['bkt_id']);
                                $stmt->execute();
                                $result7 = $stmt->get_result();

                                if ($result7->num_rows >0){
                                        echo "<h6>Reading</h6>";
                                        while ($row7=$result7->fetch_assoc()){
                                            $questions2[] = $row7;
                                        //biến lưu câu trắc nghiệm và đáp án: $row7
                                        echo "<p style='font-weight:bold';>Câu ".$i.":".$row7['cau_hoi']."</p>";
                                        $i=$i+1;
                                        echo "<input type='radio' name='question{$row7['id']}' value='A' " . (isset($_POST["question{$row7['id']}"]) && $_POST["question{$row7['id']}"] == 'A' ? 'checked' : '') . "> {$row7['dap_an_A']}<br>";  
                                        echo "<input type='radio' name='question{$row7['id']}' value='B' " . (isset($_POST["question{$row7['id']}"]) && $_POST["question{$row7['id']}"] == 'B' ? 'checked' : '') . "> {$row7['dap_an_B']}<br>";  
                                        echo "<input type='radio' name='question{$row7['id']}' value='C' " . (isset($_POST["question{$row7['id']}"]) && $_POST["question{$row7['id']}"] == 'C' ? 'checked' : '') . "> {$row7['dap_an_C']}<br>";  
                                        echo "<input type='radio' name='question{$row7['id']}' value='D' " . (isset($_POST["question{$row7['id']}"]) && $_POST["question{$row7['id']}"] == 'D' ? 'checked' : '') . "> {$row7['dap_an_D']}<br>";  
                                    }
                                }
                                
                                //Reading-------------------------------------------------
                                $sql8 ="SELECT * FROM doan_van WHERE bkt_id=?;";                     
                                $stmt = $conn->prepare($sql8);
                                $stmt->bind_param("i", $_SESSION['bkt_id']);
                                $stmt->execute();
                                $result8 = $stmt->get_result();
                                
                                if($result8->num_rows >0){
                                    
                                    while ($row8 = $result8->fetch_assoc()){
                                        echo "<h6>Read the following paragraph and answers the questions</h6>";
                                        echo "<br>".$row8['noi_dung']."";
                                        $sql9="SELECT doan_van_id,	noi_dung_chd,	phuong_an_A,	phuong_an_B,	phuong_an_C,	phuong_an_D,	phuong_an_dung,left(phuong_an_dung,1) as dap_an FROM ngan_hang_chd WHERE doan_van_id=?;";
                                        $stmt = $conn->prepare($sql9);
                                        $stmt->bind_param("i", $row8['id']);
                                        $stmt->execute();
                                        $result9 = $stmt->get_result();
                                        $i=1;
                                        if ($result9->num_rows >0){
                                            while($row9 = $result9->fetch_assoc()){
                                                //Biến lưu câu trắc nghiệm và đáp án: $row9
                                                $questions3[] = $row9;
                                                echo "<br><pstyle='font-weight:bold';>Câu ".$i.":".$row7['cau_hoi']."</pstyle=>";
                                                $i=$i+1;
                                                echo "<input type='radio' name='question{$row9['id']}' value='A' " . (isset($_POST["question{$row9['id']}"]) && $_POST["question{$row9['id']}"] == 'A' ? 'checked' : '') . "> {$row9['dap_an_A']}<br>";  
                                                echo "<input type='radio' name='question{$row9['id']}' value='B' " . (isset($_POST["question{$row9['id']}"]) && $_POST["question{$row9['id']}"] == 'B' ? 'checked' : '') . "> {$row9['dap_an_B']}<br>";  
                                                echo "<input type='radio' name='question{$row9['id']}' value='C' " . (isset($_POST["question{$row9['id']}"]) && $_POST["question{$row9['id']}"] == 'C' ? 'checked' : '') . "> {$row9['dap_an_C']}<br>";  
                                                echo "<input type='radio' name='question{$row9['id']}' value='D' " . (isset($_POST["question{$row9['id']}"]) && $_POST["question{$row9['id']}"] == 'D' ? 'checked' : '') . "> {$row9['dap_an_D']}<br>";
                                            }
                                        }
                                    }
                                }
                                    
                            ?>
                            <button type="submit" name="submit" >Nộp Bài</button>

                             </form>
                        </div>
                        <div class="col-lg-3 me-0">
                        <?php
                        if (isset($_POST['submit'])) {  
                                $score = 0;  
                                $totalQuestions=0;
                                $totalQuestions = count($questions ?? []);
                                $totalQuestions=$totalQuestions+count($questions2 ??[]);
                                $totalQuestions=$totalQuestions+count($questions3 ??[]); 
                                $userAnswers = []; 
                                if(isset($questions)){
                                    echo "<h6>Listening</h6>";
                                    $j=1;
                                    foreach ($questions as $row6) { 
                                        $userAnswer = $_POST["question" . $row6['id']] ?? '';  
                                        $isCorrect = $userAnswer === $row6['dap_an'];  
                                        echo "<p style='font-weight:bold';>Câu ".$j.":</p> ".$row6['noi_dung_chn']."";
                                        if ($isCorrect) {  
                                            $score++; 
                                            echo "<p style='color: green;'>Lựa chọn:".$userAnswer."<br>Ðáp án:".$row6['phuong_an_dung']."</p>";
                                        }
                                        else{
                                            echo "<p style='color: Red;'>Lựa chọn:".$userAnswer."<br>Ðáp án:".$row6['phuong_an_dung']."</p>";    
                                        }
                                        $j++;
                                    }
                                }
                                if(isset($questions2)){
                                    echo "<h6>Reading</h6>";
                                    $j=1;
                                    foreach ($questions2 as $row7) { 
                                        $userAnswer = $_POST["question" . $row7['id']] ?? '';  
                                        $isCorrect = $userAnswer === $row7['dap_an'];  
                                        echo "<p style='font-weight:bold';>Câu ".$j.": </p>".$row7['cau_hoi']."";
                                        if ($isCorrect) {  
                                            $score++; 
                                            echo "<p style='color: green;'>Lựa chọn:".$userAnswer."<br>Ðáp án:".$row7['dap_an_dung']."</p>";
                                        }
                                        else{
                                            echo "<p style='color: Red;'>Lựa chọn:".$userAnswer."<br>Ðáp án:".$row7['dap_an_dung']."</p>";    
                                        }
                                        $j++; 
                                    }
                                }
                                if(isset($question3)){
                                    echo "<h6>Paragrph</h6>";
                                    $j=1;
                                    foreach ($questions3 as $row9) {  
                                        $userAnswer = $_POST["question" . $row9['id']] ?? '';  
                                        $isCorrect = $userAnswer === $row9['dap_an'];  
                                        echo "<p style='font-weight:bold';>Câu ".$j.":</p>".$row9['noi_dung_chd']."";
                                        if ($isCorrect) {  
                                            $score++; 
                                            echo "<p style='color: green;'>Lựa chọn:".$userAnswer."<br>Ðáp án:".$row9['phuong_an_dung']."</p>";
                                        }
                                        else{
                                            echo "<p style='color: Red;'>Lựa chọn:".$userAnswer."<br>Ðáp án:".$row9['phuong_an_dung']."</p>";    
                                        }
                                        $j++; 
                                    }
                                }
                                echo "<h3>Points:".$score."/".$totalQuestions."</h3>";                           
                        }
                            ?>
                        </div>
                        <script>
                            const audio = document.querySelector("audio");
                            const playBtn = document.querySelector(".play-btn");
                            const progressBar = document.querySelector(".progress-bar");
                            const progressContainer = document.querySelector(".progress");
                            const currentTimeEl = document.querySelector(".current-time");
                            const durationEl = document.querySelector(".duration");
                            const volumeBtn = document.querySelector(".volume-btn");

                            playBtn.addEventListener("click", () => {
                                event.preventDefault();
                                if (audio.paused) {
                                    audio.play();
                                    playBtn.innerHTML = '<i class="fa fa-pause"></i>';
                                } else {
                                    audio.pause();
                                    playBtn.innerHTML = '<i class="fa fa-play"></i>';
                                }
                            });
                            audio.addEventListener("timeupdate", () => {
                                const progressPercent = (audio.currentTime / audio.duration) * 100;
                                progressBar.style.width = `${progressPercent}%`;
                                currentTimeEl.textContent = formatTime(audio.currentTime);
                                durationEl.textContent = formatTime(audio.duration);
                            });

                            function formatTime(time) {
                                const minutes = Math.floor(time / 60);
                                const seconds = Math.floor(time % 60);
                                return `${minutes}:${seconds.toString().padStart(2, "0")}`;
                            }

                            progressContainer.addEventListener("click", (e) => {
                                const width = progressContainer.clientWidth;
                                const clickX = e.offsetX;
                                const duration = audio.duration;
                                audio.currentTime = (clickX / width) * duration;
                            });

                            volumeBtn.addEventListener("click", () => {
                                event.preventDefault();
                                audio.muted = !audio.muted;
                                volumeBtn.innerHTML = audio.muted 
                                    ? '<i class="fa fa-volume-mute"></i>' 
                                    : '<i class="fa fa-volume-up"></i>';
                            });
                        </script>
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
                            <a href="#" class="d-inline me-2"> phatb2203463@student.ctu.edu.vn</a>
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
                                <a href="index.php" class="site-footer-link">Trang chủ</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="listing-page.php" class="site-footer-link">Khóa học</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="MyCourse.php" class="site-footer-link">Thư viện</a>
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