<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$hedefsor=$db->prepare("SELECT * FROM hedef order by hedef_id DESC");
$hedefsor->execute();


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hedef Listeleme <small>,

              <?php 

              if ($_GET['durum']=="ok") {?>

              <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

              <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>


            </small></h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Kullanıcı</th>
                  <th>Hedef Ad</th>
                  <th>İstenilen Coin</th>
                  <th>Öne Çıkar</th>
                  <th>Durum</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php 

                $say=0;

                while($hedefcek=$hedefsor->fetch(PDO::FETCH_ASSOC)) { $say++?>


                <tr>
                 <td width="20"><?php echo $say ?></td>
                <?php
                #kullanici adını çekmem lazım
                $kullaniciadcek=$db->prepare("SELECT kullanici_ad,kullanici_soyad from kullanici 
                INNER JOIN hedef on kullanici.kullanici_id=hedef.kullanici_id
                where kullanici.kullanici_id=:kullanici_id
                ");
                 $kullaniciadcek->execute(array(
                    'kullanici_id' => $_SESSION['userkullanici_id']
                ));
                
                 ?>
                 <td><?php echo $hedefcek['kullanici_id'] ?></td>
                 <td><?php echo $hedefcek['hedef_ad'] ?></td>
                 <td><?php echo $hedefcek['hedef_fiyat'] ?></td>
                 
                 <td><center><?php 

                 if ($hedefcek['hedef_onecikar']==0) {?>

                 <a href="../netting/islem.php?hedef_id=<?php echo $hedefcek['hedef_id'] ?>&hedef_one=1&hedef_onecikar=ok"><button class="btn btn-success btn-xs">Ön Çıkar</button></a>
                   

                 <?php } elseif ($hedefcek['hedef_onecikar']==1) {?>


                 <a href="../netting/islem.php?hedef_id=<?php echo $uruncek['hedef_id'] ?>&hedef_one=0&hedef_onecikar=ok"><button class="btn btn-warning btn-xs">Kaldır</button></a>

                   <?php } ?>
                     

                   </center></td>
               

                 <td><center><?php 

                  if ($hedefcek['hedef_durum']==1) {?>

                  <button class="btn btn-success btn-xs">Aktif</button>

                  <!--

                  success -> yeşil
                  warning -> turuncu
                  danger -> kırmızı
                  default -> beyaz
                  primary -> mavi buton

                  btn-xs -> ufak buton 

                -->

                <?php } else {?>

                <button class="btn btn-danger btn-xs">Pasif</button>


                <?php } ?>
              </center>


            </td>


            <td><center><a href="hedef-duzenle.php?hedef_id=<?php echo $hedef['hedef_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
            <td><center><a onclick="return confirm('Bu ürünü silmek istediğinize eminmisiniz?')" href="../netting/islem.php?hedef_id=<?php echo $hedefcek['hedef_id']; ?>&hedefsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
          </tr>



          <?php  }

          ?>


        </tbody>
      </table>

      <!-- Div İçerik Bitişi -->


    </div>
  </div>
</div>
</div>




</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
