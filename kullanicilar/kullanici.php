<?php
 /*veritabanı baglantısı dahil ediliyor */

include 'baglanti.php';


/*aldığımız kullanıcı numarası ile veritabanında bulunan kullanici_id değeri karşılaştırılıyor eğer bir kullanıcı_no
geliyorsa bu işlemleri yap*/


if (isset($_REQUEST['kullanici_no'])) 
 {

/*Gelen kullanici_no sıfırdan büyükse veritabanında böyle bir değer olup olmadığını kontrol et*/

if ($_REQUEST['kullanici_no']>0) 

        {
//kullanıcı no sfırdan büyük ve kullanıcı id ile eşleşiyorsa veritabanındaki değerleri listele

          $sorgu=$baglanti->prepare( 'SELECT * FROM kullanicibilgileri where  kullanici_id='.$_REQUEST['kullanici_no'] );
          $sorgu->execute();
          $kullanicilistele=$sorgu-> fetchAll(PDO::FETCH_OBJ);

          foreach($kullanicilistele as $kullanici)  {    }
        
          $kullanici_adi=$kullanici->kullanici_adi;
          $kullanici_soyadi=$kullanici->kullanici_soyadi;
          $kullanici_cinsiyeti= $kullanici->kullanici_cinsiyeti; 
          
        }



else
     {
//değer sıfırdan büyük değilse alanları boş getir

          $kullanici_adi='';
          $kullanici_soyadi='';
          $kullanici_cinsiyeti= ''; 

      }

}


?>

 <!-- Üzerinde işlemleri yapacağımız kullanıcı formunu oluşturuyoruz-->

<div class="card">

  <div class="card-body">

     <form action=""  id="kullaniciformu" method="POST">

    <div class="form-row" >
      
                 <div class="form-group col-md-12">
                  <label for="inputkullaniciadi" >Kullanıcı Adı:</label>
                  <input type="text" class="form-control" id="kullanici_adi" 

                 name="kullanici_adi" placeholder="Kullanıcı Adı" value="<?php echo $kullanici_adi; ?>">
                </div>
    </div>



      <div class="form-row" >

              <div class="form-group col-md-12"  >
              <label for="inputKullanicisifre" >Kullanıcı Soyadı:</label>
              <input type="text" class="form-control" id="kullanici_soyadi" 
              name="kullanici_soyadi" placeholder="Kullanici Soyadi" value="<?php echo $kullanici_soyadi; ?>" >
            </div>

      </div>

  
      <div class="form-row" >
  
                      <div class="form-group col-md-12" >
                      <label for="inputKullanicicinsiyeti">Kullanıcı Cinsiyeti:</label>
                      <select id="kullanici_cinsiyeti" class="form-control" name="kullanici_cinsiyeti">
                        
                      
                           <option selected placeholder="Kullanici Cinsiyet"></option>
                           <option value="Kadın"  <?php echo $kullanici_cinsiyeti=='Kadın' ? 'selected' : ''?>  >Kadın</option>
                           <option value="Erkek" <?php echo $kullanici_cinsiyeti=='Erkek' ? 'selected' : ''?>   >Erkek</option>
    
                      </select>
                      
                  
                      </div>
      </div>

      



<input type="text" class="form-control" id="id" name="id"  value="<?php echo $_REQUEST['kullanici_no'];?>" hidden >
<input type="text" class="form-control" id="tablo_adi" name="tablo_adi"  value="kullanicibilgileri" hidden>


              </form>


          </div>

  </div>






