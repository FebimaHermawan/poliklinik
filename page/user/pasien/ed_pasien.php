<script>
	$(function(){
		$("[data-mask]").inputmask();
	});
</script>
            <div class="col-md-6" id="form-tb-karyawan">
                  <div class="box box-primary">
                        <div class="box-header with-border">
                              <h3 class="box-title">Edit Data</h3>
                              <?php
                                    if ($getErm == "error" && $getmsg) {
                              ?>
                                    <div class="callout callout-danger">
                                        <button type="button" class="close" id="close-alert">&times;</button>
                                        maaf harap tidak kosongi <?php echo $getmsg;?>
                                      </div>
                              <?php
                                    }
                                    if ($getVm == "vali" && $getmsg) {
                              ?>
                                    <div class="callout callout-danger">
                                        <button type="button" class="close" id="close-alert">&times;</button>
                                        maaf <?php echo $getmsg;?> yang anda masukkan harus sama dengan username pertama
                                      </div>
                              <?php
                                    }
                                    if ($getVm == "um" && $getmsg) {
                              ?>
                                    <div class="callout callout-danger">
                                        <button type="button" class="close" id="close-alert">&times;</button>
                                        maaf <?php echo $getmsg;?> yang anda masukkan tidak dapat kurang dari 0
                                    </div>
                              <?php
                                    }
                              ?>
                        </div>
                        <form method="post">
                              <div class="box-body">
                                  <?php
                                    $getPas = $db->execute("select * from pasien where id = :id", array(":id"=>$getid));
                                    while ($givPas = $getPas->fetch()) {
                                  ?>
                                     <div class="form-group">
                                          <label>Nama</label>
                                          <input type="text" name="nama" placeholder="Nama" class="form-control" value="<?=$givPas['nama']?>">
                                    </div>
                                    <div class="form-group">
                                          <label>Umur</label>
                                          <input type="number" name="umur" placeholder="Umur" class="form-control" min="0" value="<?=$givPas['umur']?>">
                                    </div>
                                    <div class="form-group">
                                          <label>Gender</label>
                                          <select class="form-control" name="gender">
                                                <option value="1">Laki-laki</option>
                                                <option value="2">Perempuan</option>
                                          </select>
                                    </div>
                                    <div class="form-group">
                                          <label>Telepon</label>
                                          <div class="input-group">
                                              <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                              </div>
                                            <input type="text" min="1" class="form-control" name="telepon" placeholder="(999) 999-999-999" data-inputmask='"mask" : "(999) 999-999-999"' data-mask value="<?=$givPas['telepon']?>">
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label>Alamat</label>
                                          <textarea class="form-control" name="alamat"><?=$givPas['alamat']?></textarea>
        
                                    </div>
                                  <?php
                                    }
                                  ?>
                              </div>
                              <div class="box-footer">
                                    <input type="submit" name="btn-edit-pasien" class="btn btn-primary btn-flat" value="Edit">
                                    <input type="submit" name="btn-batal" class="btn btn-info btn-flat" value="Batal">
                              </div>
                        </form>
                       
                  </div>
            </div>
<?php
	if (isset($POST["btn-edit-pasien"])) {
		extract($POST);
      if ($nama != "") {
        if ($umur != "") {
            if ($umur < 0) {
              $db->redirect("?hal=user/home&opt=ed&id=$getid&type=pasien&vm=um&msg=umur");
            }
            else{
              $param = array(":id"=>$getid, ":nama"=>$nama, ":umur"=>$umur, ":gender"=>$gender, ":telepon"=>$telepon, ":alamat"=>$alamat);
              $db->execute("update pasien set nama = :nama, umur = :umur, gender = :gender, telepon = :telepon, alamat = :alamat where id = :id", $param);
              $db->redirect("?hal=user/home&act=pasien");
            }
        }
        else{
          $db->errorInput("?hal=user/home&opt=ed&id=$getid&type=pasien", "Umur");
        }
      }
      else{
        $db->errorInput("?hal=user/home&opt=ed&id=$getid&type=pasien", "Nama");
      }
	}
  if (isset($POST["btn-batal"])) {
    $db->redirect("?hal=user/home&act=pasien");
  }
?>