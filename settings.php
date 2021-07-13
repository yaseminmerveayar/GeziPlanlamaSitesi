<?php
    session_start();
    include ("connect.php");
    $hata="";

    if(isset($_POST["name_surname"], $_POST["user_name"], $_POST["mail"], $_POST["buton1"]))
    {
        $adsoyad = mysqli_real_escape_string($conn,$_POST['name_surname']);
        $kullanici_ad = mysqli_real_escape_string($conn,$_POST['user_name']);
        $mail = mysqli_real_escape_string($conn,$_POST['mail']);
       
        $id = $_SESSION["ID"];

        $sql_query = "SELECT * from uyeler where kullanici_ad='".$kullanici_ad."'";
        $result = mysqli_query($conn,$sql_query);
        $row = mysqli_fetch_array($result);

        $sql_query2 = "SELECT * from uyeler where eposta='".$mail."'";
        $result2 = mysqli_query($conn,$sql_query2);
        $row2 = mysqli_fetch_array($result2);

        if (is_array($row) && $_SESSION["KULLANICI_AD"] != $row['kullanici_ad'])
        {
            $hata="Bu kullanıcı adı zaten mevcut";
            mysqli_close($conn);
        }
        else if(is_array($row2) && $_SESSION["EPOSTA"] != $row2['eposta']){
            $hata="Bu eposta zaten mevcut";
            mysqli_close($conn);
        }
        else{ 
            $sql_query3 = "UPDATE uyeler SET tam_ad='".$adsoyad."' , kullanici_ad='".$kullanici_ad."' , eposta='".$mail."' 
            where id='".$id."'";
                    
            $result3 = mysqli_query($conn,$sql_query3);

            $sql_query = "SELECT * from uyeler where id='".$id."'";
            $result = mysqli_query($conn,$sql_query);
            $row = mysqli_fetch_array($result);
            if(is_array($row)) 
            {
                $_SESSION["TAM_AD"] = $row['tam_ad'];
                $_SESSION["KULLANICI_AD"] = $row['kullanici_ad'];
                $_SESSION["EPOSTA"] = $row['eposta'];
            } 
    
            if ($result3) {
                $hata = "Bilgiler Güncellendi";
            } else {
                $hata = "Error" ;
            }
            mysqli_close($conn);

        }
    }
    if(isset($_POST["password"], $_POST["password2"], $_POST["buton2"]))
    {

        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $password2 = mysqli_real_escape_string($conn,$_POST['password2']);

        $sql_query = "SELECT * from uyeler where sifree='".$password."'";
        $result = mysqli_query($conn,$sql_query);
        $row = mysqli_fetch_array($result);

        if (is_array($row))
        {

            $sql_query2 = "UPDATE uyeler SET sifree='".$password2."' where sifree='".$password."'";
            $result2 = mysqli_query($conn,$sql_query2);

            if ($result2) 
            {
            $hata = "Bilgiler Güncellendi";
            } 
            else 
            {
            $hata = "Error" ;
            }
            mysqli_close($conn);
        }
        else
        {
            $hata="Şifreniz yanlış";
        }
    }
    if(isset($_POST["buton3"])){
        $sql_query = "SELECT * from profil_resmi where uye_id='".$_SESSION["ID"]."'";
        $result = mysqli_query($conn,$sql_query);
        $row = mysqli_fetch_array($result);

        $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
    
        $tname = $_FILES["file"]["tmp_name"];
    
        $uploads_dir = 'pimg';
    
        move_uploaded_file($tname, $uploads_dir.'/'.$pname);
    
        if (is_array($row))
        {
    
            $change = "UPDATE profil_resmi SET image='".$pname."' where uye_id='".$_SESSION["ID"]."'";
            $result2 = mysqli_query($conn,$change);
    
            if ($result2) 
            {
            $hata = "Profil Resmi Güncellendi";
            } 
            else 
            {
            $hata = "Error" ;
            }
            mysqli_close($conn);
        }else
        {
            $ekle = "INSERT INTO profil_resmi(image, uye_id) VALUES ('".$pname."','".$_SESSION["ID"]."')";
            
            if (mysqli_query($conn, $ekle)) 
            {
                $hata = "Profil Resmi Güncellendi";
            } 
            else 
            {
                $hata = "ERROR";
            }
        }
    
    }
    
    

    ?>

<!DOCTYPE html> <!--Ayarlar sayfasi-->
<html>
    <head>
        <title>Ayarlar</title>
        <link rel="stylesheet" type="text/css" href="css/edit.css">
        <script src="https://kit.fontawesome.com/5e0f0316e6.js" 
        crossorigin="anonymous"></script>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,300&display=swap"
        rel="stylesheet">
        
    </head>
    <body>
        <section id="menu">       
            <div id="logo"><strong>YolAçık</strong> <br> <small>"Planla, Gez, Paylaş"</small></div>
            <nav>
                <a href="index.php"><i class="fas fa-home ikon"></i>Anasayfa</a>
                <a href="blog.php"><i class="fas fa-camera ikon"></i> Blog </a> 
                <a href="profile.php"><i class="fa fa-user"></i> Profil</a>
            </nav>
        </section>

        <section id="update"> 
        
            <strong><p style="text-align: center;                        
                            color: #bf2233;">
                            <?php echo $hata; ?> </p></strong>

            <div class="container">
                <h2>Ayarlar</h2>
                <h4 class="group"> Kullanıcı Bilgilerini Düzenle </h4>
                
                <form action="settings.php" method="POST"> 
                    <div class="group">
                                        
                        <input type="text" name="name_surname" value="<?php echo $_SESSION["TAM_AD"]; ?>">
                        <label>Ad Soyad</label>
                    </div>

                    <div class="group">
                        <input type="text" name="user_name" value="<?php echo $_SESSION["KULLANICI_AD"]; ?>">
                        <label>Kullanıcı Adı</label>
                    </div> 

                    <div class="group">
                        <input type="text" name="mail" value="<?php echo $_SESSION["EPOSTA"]; ?>">                    
                        <label>E-posta</label>
                    </div>
                    
                    <div class="update">
                        <input type="submit" name="buton1" value="Güncelle"
                        style="background-color:#6495ED">                    
                    </div>
                </form> 

                <form action="settings.php" method="POST"> 

                    <h4 class="group"> Şifreyi değiştir </h4>
                    <div class="group">
                        <input type="password" name="password">
                        <label>Eski Şifre</label>
                    </div> 

                    <div class="group">
                        <input type="password" name="password2">
                        <label>Yeni Şifre</label>
                    </div> 

                    <div class="update">
                        <input type="submit" name="buton2" value="Güncelle"
                        style="background-color:#6495ED">                    
                    </div>
                </form>

                <form action="settings.php" method="POST" enctype="multipart/form-data"> 

                    <h4 class="group"> Kullanıcı resmini değiştir </h4>
                    
                    <div class="group">
                    <input type="file" id="file" name="file">
                    </div> 

                    <div class="update">
                        <input type="submit" name="buton3" value="Güncelle"
                        style="background-color:#6495ED">                    
                    </div>
                </form>
            </div> 
        </section>
    </body>
</html>

