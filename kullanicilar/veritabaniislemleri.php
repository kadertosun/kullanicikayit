<?php


/* veritabanına erişmek için veritabanı sayfamızı dahil ediyoruz  */
include 'baglanti.php';
 



$ad=isset($_REQUEST['kullanici_adi']) ? $_REQUEST['kullanici_adi']: '';
$soyad=isset($_REQUEST['kullanici_soyadi']) ? $_REQUEST['kullanici_soyadi'] :'';
$cinsiyet=isset($_REQUEST['kullanici_cinsiyeti']) ? $_REQUEST['kullanici_cinsiyeti'] : '';




$tablo_adi = $_REQUEST['tablo_adi'];


 




/*gelen id numarası ve tablo isimlerine göre veritabanı işlemleri yapıyoruz */



//****** Kayıt işlemi **********///




if ($_REQUEST['id']==0 ) {

/*gelen id numarası sıfıra eşit ve tablo adı kullanicibilgileri ise o zaman kayıt işlemi yap */

if($tablo_adi=='kullanicibilgileri')
{
  $sqlekle="INSERT INTO $tablo_adi ( kullanici_adi,kullanici_soyadi,kullanici_cinsiyeti) 
  VALUES ('$ad','$soyad','$cinsiyet')";
}
            

  
                $baglanti->exec($sqlekle);
                print $baglanti->lastInsertId();


}

//******* Güncelleme İşlemi ****//


if ($_REQUEST['id']>0) {

/* gelen id numarası sıfırdan büyük ve tablo adı kullanicibilgileri ise guncelleme işlemi yapıyoruz*/

if($tablo_adi=='kullanicibilgileri')
{
  $sqlguncelle= "UPDATE $tablo_adi SET kullanici_adi='$ad',kullanici_soyadi='$soyad', kullanici_cinsiyeti='$cinsiyet' where kullanici_id=".$_REQUEST['id'];
}





    
    $baglanti->exec($sqlguncelle);
    
     print $baglanti->lastInsertId();
    
    
    }

//**********Silme işlemi********//



    if ($_REQUEST['id']<0) 
    {

        
        //aldığımız id değeri negatif ancak veritabanında negatif bir değer olmadığı için değerimizi if bolğu
        //içerisine girdikten sonra 1 ile çapıyoruz.
        if($tablo_adi=='kullanicibilgileri')
        {
          $sqlsil="DELETE FROM  $tablo_adi  where kullanici_id =".$_REQUEST['id']*-1;
        }

      

        

        


$baglanti->exec($sqlsil);

print $baglanti->lastInsertId();


}



?>
 
