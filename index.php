<!DOCTYPE html> <!--Anasayfa-->
<html lang="tr">
    <head>
        <meta charset="UTF-8">
        <title>YolAçık</title>
        <link rel="stylesheet" href="css/style.css">
       
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        crossorigin="anonymous">

        <link rel="preconnect" href="https://fonts.gstatic.com">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,300&display=swap"
        rel="stylesheet">
        
        <script src="js/index.js"></script>
    </head>
    <body>
        <section id="menu">
        <div id="logo"> <strong>YolAçık</strong> <br> <small>"Planla, Gez, Paylaş"</small> 
            </div>            
            <nav>          
                <a href="#"><i class="fas fa-home ikon"></i> Anasayfa</a> 
                <a href="#hakkimizda"><i class="fas fa-info ikon"></i> Hakkımızda</a> 
                <a href="blog.php"><i class="fas fa-camera ikon"></i> Blog </a> 
                <a href="login.php"><i class="fas fa-sign-in-alt ikon"></i> Giriş Yap</a>
            </nav>
        </section>

        <section id="anasayfa">
            <div id="black"> 
            </div>
            
            <div id="icerik">
                <h2>Seyahatinizi  Planlayalım</h2>
                <hr width=400 align="left" > 
                <p>Türkiye içerisindeki bir şehri seçtiğinizde ulaşım, konaklama, 
                    restoran ve gezilebilecek yerleri sizlere sunuyoruz.</p>
                    
                    <form action="search.php" method="POST">
                    <div class="box-container">

                    <input type="text" name="aramasorgusu" placeholder="Aramak istediğiniz şehri giriniz" class="search"> <a class="btn" href="#"> </a>
                    <input type="submit" id="btnsearch" value="ARA" name="buton" style="height: 45px; width: 65px"/>
                    </div>
                    </form>    
            </div>           
        </section>
        <br>
        <br>
        <br>
        <section id="slayt">
            <div class="slider"> 
                <img src="img/slide2.png" id="img1" class="photo">
                <img src="img/slide1.png" id="img2" class="photo">
                <img src="img/slide0.png" id="img3" class="photo">
                <img src="img/slide3.png" id="img4" class="photo">
                <span class="fas fa-chevron-left" onclick="left()"></span>
                <span class="fas fa-chevron-right" onclick="right()"></span>
                <span class="circle" id="circle1" onclick=" "></span>
                <span class="circle" id="circle2"></span>
                <span class="circle" id="circle3"></span>
                <span class="circle" id="circle4"></span>
            </div> 
        </section>

        <br>
        <br>
        <br>
        <section id="hakkimizda"> 
            
            <h2>Hakkımızda</h2>

            <div id="container">
            
            <h5 id="h5sol">Bu sitenin amacı bütçeniz ne olursa olsun sizler için en uygun seyahat
                deneyimini sunmaktır. Sitemiz zamanınızı ve bütçenizi en iyi şekilde değerlendirmenizi sağlar. 
                Gezilecek yerler, ulaşım, konaklama, gibi seyahatiniz için gerekli bilgilere 
                sitemizden ulaşabilirsiniz. Ayrıca sitemizde bulunan blog sekmesinde 
                diğer kullanıcıların seyahat deneyimlerini takip edebilir; kendi deneyimlerinizi paylaşabilirsiniz. 
                Otel, restoran ve firmalar hakkında görüşlerinizi bildirebilirsiniz. İletişim: yolacik00@gmail.com</h5>  
            </div>
        </section>
    </body>
</html>