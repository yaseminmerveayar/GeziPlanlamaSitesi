<?php
    $hata ="";
        
    include ("connect.php");

    if(isset($_POST["password"], $_POST["password2"]))
    {
        $sifre = $_POST["password"]; 
        $sifre2 = $_POST["password2"];

        if(isset($_POST["name_surname"], $_POST["user_name"], $_POST["mail"]) && $sifre == $sifre2)
        {
            $adsoyad = $_POST["name_surname"];
            $kullaniciadi = $_POST["user_name"];
            $mail = $_POST["mail"];

            $sql_query = "SELECT * from uyeler where kullanici_ad='".$kullaniciadi."'";
            $result = mysqli_query($conn,$sql_query);
            $row = mysqli_fetch_array($result);

            if (is_array($row))
            {
                $hata="Bu kullanıcı adı zaten mevcut";
                mysqli_close($conn);
            }
            else
            {
                $ekle = "INSERT INTO uyeler(tam_ad, kullanici_ad, eposta, sifree) VALUES ('".$adsoyad."','".$kullaniciadi."','".$mail."','".$sifre."')";

                if (mysqli_query($conn, $ekle)) 
                {
                    $hata = "Kaydınız yapıldı";
                } 
                else 
                {
                    $hata = "Error: " . $ekle . "<br>" . mysqli_error($conn);
                }
                    mysqli_close($conn);
            }
        }
            else if($sifre != $sifre2)
            $hata = "Şifreler eşleşmedi. Lütfen tekrar deneyiniz.";
    }
    
?>

<!DOCTYPE html> <!--Kayit olma sayfasi-->
<html>
    <head>
        <title>Kayıt Ol</title>
        <link rel="stylesheet" type="text/css" href="css/signup.css">
        <script src="https://kit.fontawesome.com/5e0f0316e6.js" 
        crossorigin="anonymous"></script>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,300&display=swap"
        rel="stylesheet">
        
    </head>
    <body>
        <section id="menu">       
            <div id="logo"></div>
            <nav>
                <a href="index.php"><i class="fas fa-home ikon"></i>Anasayfa</a>
                <a href="login.php"><i class="fas fa-sign-in-alt ikon"></i>Giriş Yap</a>
            </nav>
        </section>

        <section id="signup"> 
            <div class="container">
                <h2>Kayıt Ol</h2>
                
                <form action="signup.php" method="POST">
                
                    <div class="group">                  
                        <input type="text" name="name_surname" required>
                        <span class="higlight"></span>
                        <span class="bar"></span>
                        <label>Ad Soyad</label>
                    </div>

                    <div class="group">
                        <input type="text" name="user_name" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Kullanıcı Adı</label>
                    </div> 

                    <div class="group">
                        <input type="text" name="mail" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>E-posta</label>
                    </div> 

                    <div class="group">
                        <input type="password" name="password" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Şifre</label>
                    </div> 

                    <div class="group">
                        <input type="password" name="password2" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Şifrenizi tekrar giriniz</label>
                    </div> 

                    <strong><p style="text-align: center;                        
                        color: #bf2233;">
                    <?php echo $hata; ?> </p></strong>
                        
                    <div class="signup">
                        <input type="submit" name="buton" value="Kayıt Ol"
                        style="background-color:#6495ED">                    
                    </div>
                </form>
            </div> 
        </section>
    </body>
</html>

