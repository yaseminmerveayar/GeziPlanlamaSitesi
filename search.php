<?php
    session_start();
    include "connect.php";

    if(isset($_POST['buton']))
    {
        $aramasorgusu = mysqli_real_escape_string($conn,$_POST['aramasorgusu']);

        $sql_query = "SELECT * from sehirler where sehir_adi='".$aramasorgusu."'";
        $result = mysqli_query($conn,$sql_query);
        $query_result = mysqli_num_rows($result);

        
        if($query_result > 0) 
        {
            while($row = mysqli_fetch_array($result))
            {
                $_SESSION["sehir_id"] = $row['id'];
                $_SESSION["sehir_adi"] = $row['sehir_adi'];
                header("Location:city.php");
                exit();
            }
        } 
        else 
        {
            echo "kayıt bulunamadı";    
        }
    }
?>