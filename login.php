<?php
session_start();
$message="";

include "connect.php";

if(isset($_POST['submit'])){

    $uname = mysqli_real_escape_string($conn,$_POST['user_name']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    if ($uname != "" && $password != "")
    {

        $sql_query = "SELECT * from uyeler where kullanici_ad='".$uname."' and sifree='".$password."'";
        $result = mysqli_query($conn,$sql_query);
        $row = mysqli_fetch_array($result);

        if(is_array($row)) 
        {
            $_SESSION["ID"] = $row['id'];
            $_SESSION["TAM_AD"] = $row['tam_ad'];
            $_SESSION["KULLANICI_AD"] = $row['kullanici_ad'];
            $_SESSION["EPOSTA"] = $row['eposta'];
            } 
            else 
            {
             $message = "Kullanıcı adı ya da parola yanlış!";
            }
        }
    }
    if(isset($_SESSION["ID"])) 
    {
        header("Location:blog.php");
    }
?>

<!DOCTYPE html> <!--Giris sayfasi-->
<html>
    <head>
        <title>Giriş Yap</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
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
            </nav>
        </section>

        <section id="login">  
            <div class="container">
                <h2>Giriş Yap</h2>
                
                <form action="" method="POST">
                    <div class="group">                  
                        <input type="text" name="user_name" required>
                        <span class="higlight"></span>
                        <span class="bar"></span>
                        <label>Kullanıcı adı </label>
                    </div>

                    <div class="group">
                        <input type="password" name="password" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Parola</label>
                    </div>
                
                    <div class="giris">
                        <input name="submit" type="submit" value="Giriş Yap" style="background-color:#6495ED" onclick="window.location='/blog.php'"
                        style="background-color:#6495ED">                    
                    </div>
                    <div class="sifre">
                    
                        <table>          
                        <tr>
                        <td> <a href = "forgotpswd.php" >Şifremi Unuttum    </a>  </td>
                        <td width="10px"></td>

                        <strong><p style="color: #bf2233; font-size: 15px">
                        <?php echo $message; ?> </p></strong>
                        
                        <td> <a href = "signup.php" >Kayıt Ol </a>  </td>
                        </tr>
                        </table>
                    </div>    
                </form>
            </div>               
        </section>
    </body>
</html>



