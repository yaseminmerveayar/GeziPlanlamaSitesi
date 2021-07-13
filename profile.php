<?php
session_start();
include "connect.php";

$sql_query = "SELECT * from profil_resmi where uye_id='".$_SESSION["ID"]."'";
$result = mysqli_query($conn,$sql_query);
$row = mysqli_fetch_array($result);


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

    <link rel="stylesheet" href="profile.css">

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <title>Profil</title>
</head>

    <body>
        <header>
            <div class="logo"> <strong>YolAçık</strong> <br> <small>"Planla, Gez, Paylaş"</small>
            </div>
            <i class="fa fa-bars menu-toggle"></i>
            <ul>
                <li><a href="index.php"><i class="fas fa-home ikon"></i> Anasayfa</a></li>
                <li><a href="#"><i class="fas fa-bell"></i> Bildirim</a></li>
                <li>
                    <a href="#">
                        <i class="fa fa-user"></i>

                        <?php
                        if ($_SESSION["TAM_AD"]) 
                        {
                        ?>
                            <?php echo $_SESSION["TAM_AD"]; ?>
                        <?php
                        } 
                        else echo "<p style='color: #FF3300'> Lütfen önce giriş yapınız!</p>";
                        ?>
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <ul>
                        <li><a href="blog.php"> Blog</a></li>
                        <li><a href="settings.php">Ayarlar</a></li>
                        <li><strong><a href="logout.php" class="logout">Çıkış Yap</a></strong></li>
                    </ul>
                </li>
            </ul>
        </header>
        <?php
        $name = $_SESSION["TAM_AD"]; 
        echo "<br><br><br><strong><p id='name' >$name</p></strong>" ?>
        <?php if($row['image']){echo "<img id='picture' src='pimg/".$row['image']."' >"; }
        else echo "<img id='picture' src='img/profilresmi.jpg'>"?>
        
        
        <?php
        $username = $_SESSION["TAM_AD"];    /*BURAYA KULLANICI ADI GELECEK */
        echo "<p id='username'>@$username</p>" ?> 
        
        <button id="edit" ><a href="settings.php">Profili Düzenle</a></button>
        <br><br>
        <hr>
            <form id="share" method="POST" action="blog.php" enctype="multipart/form-data">
                <span id="text"><strong> Bir şeyler paylaşın</strong></span>
                    <br>
                    <div>
                    <input type="text" id="box" placeholder="Başlık" name="title">
                    </div>

                    <div >
                    <textarea name="metin" id="container" rows="3" cols="25"></textarea>
                    </div>
                        
                    <div >
                        <select  name="icerik_kategori" id="category">
                            <option value="">Seçiniz</option>    
                                <?php
                                $sql_query = "SELECT * from kategori ";
                                $result = mysqli_query($conn,$sql_query);
                                
                                while($row = mysqli_fetch_array($result)) 
                                {
                                    $_SESSION["kategori_baslik"] = $row['kategori_baslik'];
                                    $_SESSION["kategori_id"] = $row['kategori_id']; 

                                    echo '<option value="'.$_SESSION["kategori_id"].'">'.$_SESSION["kategori_baslik"].'</option>';
                                } 
                                ?>
                        </select>
                    </div>
                    
                    <input type="file" id="file" name="file">
                    <input type="submit" id="shareButton" value="PAYLAŞ">
            </form>

        <?php 
            $sql_query = "SELECT * from icerik where yazar_id='".$_SESSION["ID"]."' order by id desc";
            $result = mysqli_query($conn,$sql_query);
                            
            while($row = mysqli_fetch_array($result)) 
            { 
                $_SESSION["icerik_baslik"] = $row['icerik_baslik'];
                $_SESSION["icerik_text"] = $row['icerik_text'];?>
            
            <div class="container">
                <br> 
                <strong> <label class="lbl" id="caption"><?php echo $_SESSION["icerik_text"] ?></label></strong><br>
                <label class="lbl"><?php echo $_SESSION["icerik_baslik"] ?></label><br><br>
                <div class="heart-btn">
                    <div class="content">
                        <span class="heart"></span>
                        <span class="text">Beğen</span>
                        <span class="numb"></span>
                    </div>
                </div>
                <?php echo "<img src='images/".$row['image']."' >"; ?>
               
            </div>  
        </div>
           
        <?php } ?>

        <script src="js/profile.js"></script>
    </body>
</html>
