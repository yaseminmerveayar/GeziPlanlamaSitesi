<?php 
    session_start();
    include "connect.php";

    $sql_query = "SELECT * from butce where id='1'";
    $result = mysqli_query($conn,$sql_query);
    $row = mysqli_fetch_array($result);

    if(is_array($row)) 
    {
        $_SESSION["butce_fiyat"] = $row['fiyat'];
    }
    
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">

    <script src="https://kit.fontawesome.com/5e0f0316e6.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/city.css">

    <title><?php echo $_SESSION["sehir_adi"]?></title> <!-- sehir adi çekilecek-->

</head>

    <body onload="renderDate()">
        <header>
            <div class="logo"> <strong>YolAçık</strong> <br> <small>"Planla, Gez, Paylaş"</small>
            </div>
            <nav>          
                <a href="index.php"><i class="fas fa-home ikon"></i> Anasayfa</a> 
                <a href="blog.php"><i class="fas fa-camera ikon"></i> Blog </a> 
                <a href="login.php"><i class="fas fa-sign-in-alt ikon"></i> Giriş Yap</a>
            </nav>
        </header>
        <br>
        <br>
        <div id="cityname">
            <strong> <?php echo mb_strtoupper($_SESSION["sehir_adi"],"UTF-8"); ?> </strong>
        </div>
            <div>
            <form action="" method="POST">
                <input type="submit"  class="buttons" value="Gezi" name="gezi" >
                <input type="submit"  class="buttons" value="Konaklama" name="konaklama">
                <input type="submit"  class="buttons" value="Yeme-İçme" name="yemek">
            </form>
            </div>

        <div class="wrapper">
            <div class="calendar">
                <div class="month">
                    <div class="prev" onclick="moveDate('prev')">
                        <span>&#10094;</span>
                    </div>
                    <div>
                        <h2 id="month"></h2>
                        <p id="date_str"></p>
                    </div>
                    <div class="next" onclick="moveDate('next')">
                        <span>&#10095;</span>
                    </div>
                </div>
                <div class="weekdays">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="days">
                
                </div><br><br><strong>Bütçe aralığı giriniz:</strong>
                
                <form action="city.php" method="POST">
                    <input type="text" id="date" name="fiyat">
                    <br>
                    <input type="submit"  class="findbtn" value="BUL" name="findbtn">
                </form>
                
            </div>
        </div>

        <?php 
        if(isset($_POST["findbtn"],$_POST['fiyat']))
        {
            $butce = mysqli_real_escape_string($conn,$_POST['fiyat']);
    
            
            $sql_query = "UPDATE butce SET fiyat='".$butce."' where id='1'";
            $result = mysqli_query($conn,$sql_query);
    
            if ($result) 
            {
                $sql_query2 = "SELECT * from gezi where gezi_sehir_id = '".$_SESSION["sehir_id"]."' and gezi_fiyat <= '".$_SESSION["butce_fiyat"]."' ";
                $result2 = mysqli_query($conn,$sql_query2);

                while($row2 = mysqli_fetch_array($result2)) { 
                    $_SESSION["gezi_ad"] = $row2['gezi_ad'];
                    $_SESSION["gezi_text"] = $row2['gezi_text'];
             
        
                
        ?>
    
        <div class="container"> 
                <?php echo "<img src='img/".$row2['gezi_resim']."' >"; ?><br>
                <div class="statement">
                    <strong><label class="lbl" id="caption"><?php echo $_SESSION["gezi_ad"]; ?></label></strong><br>
                    <label><?php echo $_SESSION["gezi_text"] ;?></label><br> <br>
                </div>
        </div>

        <?php } }}
        
        if(isset($_POST["gezi"])){

            $sql_query2 = "SELECT * from gezi where gezi_sehir_id = '".$_SESSION["sehir_id"]."' and gezi_fiyat <= '".$_SESSION["butce_fiyat"]."' ";
            $result2 = mysqli_query($conn,$sql_query2);

            while($row2 = mysqli_fetch_array($result2)) { 
                $_SESSION["gezi_ad"] = $row2['gezi_ad'];
                $_SESSION["gezi_text"] = $row2['gezi_text'];
                
        ?>
    
        <div class="container"> 
                <?php echo "<img src='img/".$row2['gezi_resim']."' >"; ?><br>
                <div class="statement">
                    <strong><label class="lbl" id="caption"><?php echo $_SESSION["gezi_ad"]; ?></label></strong><br>
                    <label><?php echo $_SESSION["gezi_text"] ;?></label><br> <br>

                    
                </div>  
                
        </div>

        <?php } }

        if(isset($_POST["konaklama"])){

            $sql_query = "SELECT * from otel where otel_sehir_id = '".$_SESSION["sehir_id"]."' and otel_fiyat <= '".$_SESSION["butce_fiyat"]."' ";
            $result = mysqli_query($conn,$sql_query);

            while($row = mysqli_fetch_array($result)) { 
                $_SESSION["otel_ad"] = $row['otel_ad'];
                $_SESSION["otel_text"] = $row['otel_text'];
                
            ?>

            <div class="container"> 
                <?php echo "<img src='img/".$row['otel_resim']."' >"; ?><br>
                <div class="statement">
                    <strong><label class="lbl" id="caption"><?php echo $_SESSION["otel_ad"]; ?></label></strong><br> 
                    <label><?php echo $_SESSION["otel_text"] ;?></label>
                </div>
            </div>
        <?php } }

        if(isset($_POST["yemek"])){

            $sql_query2 = "SELECT * from restoran where restoran_sehir_id = '".$_SESSION["sehir_id"]."' and restoran_fiyat <= '".$_SESSION["butce_fiyat"]."' ";
            $result2 = mysqli_query($conn,$sql_query2);

            while($row2 = mysqli_fetch_array($result2)) { 
                $_SESSION["restoran_ad"] = $row2['restoran_ad'];
                $_SESSION["restoran_text"] = $row2['restoran_text'];
                
        ?>

        <div class="container"> 
                <?php echo "<img src='img/".$row2['restoran_resim']."' >"; ?><br>
                <div class="statement">
                    <strong><label class="lbl" id="caption"><?php echo $_SESSION["restoran_ad"]; ?></label></strong><br>
                    <label><?php echo $_SESSION["restoran_text"] ;?></label><br> <br>
                </div>
        </div>




        <?php } }?>
        <script src="js/city.js"></script>
    </body>
</html>