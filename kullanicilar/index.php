<?php
 include 'baglanti.php';



?>
<!DOCTYPE html>
<html lang="tr">  
<?php include 'baglanti.php';?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Kayıt</title>
     <!--Google fonts-->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
   
  
   <link rel="stylesheet" href="bootstrap.min.css">
  
  

</head>
        <body>
            

   
<div class="container">


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Kullanıcı İşlemleri</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->


    


      <div class="modal-body" id="kullanici_detay">
      
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>


<!--kullaniciformu id olan formdaki bilgileri kullanıcı kaydet fonksiyonuna gönderir-->
        <button type="button" class="btn btn-success" data-toggle="modal"


        onclick="var k=$( '#kullaniciformu' ).serialize();
         kullanici_kaydet(k);">

        Kaydet</button>
      </div>
      
    </div>
  </div>
</div>

</div>





   


<?php
/* veritabanında bulunan kayıtları son eklenen kayda göre çekiyoruz */

$sorgu=$baglanti->prepare('SELECT * FROM kullanicibilgileri order by  kullanici_id  desc');
$sorgu->execute();
$kullanicilistele=$sorgu-> fetchAll(PDO::FETCH_OBJ);


?>




  

<!-- Kullanıcıları listeleyeceğimiz tabloyu hazırlıyoruz-->
<br>

 <table class="table table-bordered table-responsive-md table-striped text-center">

     <!-- Tablo Başlığımız-->

      <thead>
<!--kullanıcı getir fonksiyonuna parametre olarak kullanıcı_id gönderip buna göre işlem yapıyorduk burada ise
kullanıcı_id 0 olarak gönderiyoruz ki sistemde böyle bir kayıt olmadığını gösterip bize modalı boş olarak getiriyor.  -->

        <tr> <button class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal"
         
        
        onclick="kullanici_getir(0)" >
       
        <i class="fas fa-plus fa-2x" aria-hidden="true"></i></button></tr>
  
        <tr >
                 <th>Kullanıcı No</th>    
                 <th>Kullanici Adı</th>  
                 <th>Kullanici Soyadı</th>  
                 <th>Kullanıcı Cinsiyeti</th>
                 <th colspan="2">İşlemler</th>
        </tr>
      </thead>

      <tbody>
 <tr>
      <!-- Veritabanında bulunan kullanıcıları yukarıda yazmış olduğumuz kullanıcılistele querysi yardımıyla
       tabloya çekiyoruz -->

      
        <?php
             foreach($kullanicilistele as $kullanici)
             {
        ?>
     
       <tr> 
               <td class="pt-3-half"><?= $kullanici->kullanici_id; ?></td>
              <td class="pt-3-half"><?=$kullanici->kullanici_adi; ?> </td>  
              <td class="pt-3-half"><?= $kullanici->kullanici_soyadi;?></td>
               <td class="pt-3-half"><?= $kullanici->kullanici_cinsiyeti; ?></td>


            <!--Detay butonunu önce modalın idsi ile bağlıyoruz daha sonra ise onclick olayı ile 
            kullanıcı_idsini parametre olarak gönderiyoruz -->

              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"

              onclick="kullanici_getir(<?php echo $kullanici->kullanici_id;?>)">Detay </button> </td>
              
              
              <td><button type="reset" class="btn btn-danger" 
              
              onclick="kullanici_sil(<?php echo $kullanici->kullanici_id; ?>,'kullanicibilgileri')"
              
              
              >Sil</button></td>
   </tr>

      <?php

      }
      ?>
      </tr>
      </tbody>
    </table>
  



<!-------sayfa sonu------->


<script>

/* kullanıcı_getir fonksiyonu kullanıcı_id parametresi alan ve bu paramtreyi kullanici.php sayfasına gönderen
bir fonksiyondur.
burada detayları görüntülemek için modal id bağlanmıştır ancak parametre kontolünün yapıldığı ve buna göre 
dönecek sonucu hazırlayan sayfa kullanici.php sayfasıdır.*/






function kullanici_getir(kullanici_id) 
{
/*kullanıcı verilerini görüntülemek için kullanıcı id yeterli olacaktır */

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200)
       {
      
      document.getElementById('kullanici_detay').innerHTML=this.responseText;
      
  
      }
    };
    xmlhttp.open("GET", "kullanici.php?kullanici_no=" +kullanici_id, true);
    xmlhttp.send();
  
}


function kullanici_kaydet(str) {
 


 var xmlhttp = new XMLHttpRequest();
 
 xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
       
    this.responseText;

         
    
           location.reload();
          
     

      
    
       }
     };
     xmlhttp.open("GET", "veritabaniislemleri.php?" + str, true);
     xmlhttp.send();
    
   
 
   }





/* Kullanıcı sil fonksiyonu ile birlikte veritabanında bulunan kullanıcı kaydını sileriz bunun için yapmamız gereken
kullanıcıdan dönen bir kullanici_id ve tablo_adi parametrelerini almak olacaktır.   */





/*silme işlemi yapmak için bize negatif bir değer gerekiyor bunun için str parametresini - ile çarpıp 
veritabanı_islemleri sayfasına gönderiyoruz. karşı taraf bu veriyi veritabanıyla karşılaştırdığı zaman
bir sonuş bulamayacağı için orada yazdığımız queryde aldığımız değeri eksi ile çarpıyoruz. */



function kullanici_sil(str,tablo_adi) {
 var kayit=str*-1;


 var xmlhttp = new XMLHttpRequest();
 
 xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
       
      this.responseText; 
//işlem gerçekleştikten sonra sayfamızı yeniliyoruz
          location.reload();
         
    
    
       }
     };
     xmlhttp.open("GET", "veritabaniislemleri.php?id="+kayit+'&tablo_adi='+tablo_adi, true);
     xmlhttp.send();
    
   
 
   }

</script>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</html>


