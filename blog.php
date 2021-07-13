<!--blog sayfasi-->
<?php
session_start();
include "connect.php";


if(isset($_POST["title"], $_POST["metin"], $_POST["icerik_kategori"]))
{
    $baslik = $_POST["title"];
    $text = $_POST["metin"];
    $kategori_id = $_POST["icerik_kategori"];
    $id = $_SESSION["ID"];

    $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $uploads_dir = 'images';

    move_uploaded_file($tname, $uploads_dir.'/'.$pname);

    $ekle = "INSERT INTO icerik(icerik_baslik, image, icerik_text, icerik_kategori_id, yazar_id) VALUES ('".$baslik."','".$pname."','".$text."','".$kategori_id."','".$id."')";
    
    if (mysqli_query($conn, $ekle)) 
    {
            echo  "Kaydedildi";
    } 
    else 
    {
            echo "Error " ;
    }

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

        <link rel="stylesheet" href="blog1.css">

        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

        <title>Blog</title>
    </head>

    <body>
        <header>
            <div class="logo"> <strong>YolAçık</strong> <br> <small>"Planla, Gez, Paylaş"</small>
            </div>
            <i class="fa fa-bars menu-toggle"></i>
            <ul>
                <li><a href="index.php"><i class="fas fa-home ikon"></i>   Anasayfa</a></li>
                <li><a href="#"><i class="fas fa-bell"></i>   Bildirim</a></li>
                <li>
                    <a href="#">
                        <i class="fa fa-user"></i>

                        <?php
                        if ($_SESSION["TAM_AD"]) 
                        {
                            echo $_SESSION["TAM_AD"]; 
                        } 
                            else echo "<p style='color: #FF3300'> Lütfen önce giriş yapınız!</p>";
                           
                        ?>
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <ul>
                        <li><a href="profile.php">Profil</a></li>
                        <li><a href="settings.php">Ayarlar</a></li>
                        <li><strong><a href="logout.php" class="logout">Çıkış Yap</a></strong></li>
                    </ul>
                </li>
            </ul>
        </header>
        <br>
        <br>
        
        <a href="profile.php"> <input type="submit"  id="button" value="Bir Şeyler Paylaş" ></a> <br><br>
        <?php 
            $sql_query = "SELECT * from icerik order by id desc";
            $result = mysqli_query($conn,$sql_query);
             
            while($row = mysqli_fetch_array($result)) { 
                $_SESSION["icerik_baslik"] = $row['icerik_baslik'];
                $_SESSION["icerik_text"] = $row['icerik_text'];
               // $_SESSION["icerik_id"] = $row['id'];

                $sql_query2 = "SELECT * from uyeler where id='".$row['yazar_id']."'";
                $result2 = mysqli_query($conn,$sql_query2);
                $row2 = mysqli_fetch_array($result2);

                /*$sql_query3 = "SELECT * from begeni where icerik_id='".$_SESSION["icerik_id"]."'";
                $result3 = mysqli_query($conn,$sql_query3);
                $row3 = mysqli_fetch_array($result3);*/
        ?>
        
            <div class="container"> 
                
                <strong><label class="lbl" id="caption"><?php echo $_SESSION["icerik_text"] ?></label></strong><br> 
                <label><?php echo $_SESSION["icerik_baslik"] ?></label><br> <br>
                <?php echo "<img src='images/".$row['image']."' >"; ?><br>
                <label><?php echo $row2['kullanici_ad']; ?></label><br> <br>
                <?php echo "<div class='heart-btn'>
                                <div class='content'>
                                    <span class='heart'></span>
                                    <span class='text'>Beğen</span>
                                    <span class='numb'></span>
                                </div>
                            </div>"  ?>
                
            </div>
        <?php } ?>

            <script src="js/blog.js"></script>
    </body>
</html>