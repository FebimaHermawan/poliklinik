<script>
	$(function(){
		$("[data-mask]").inputmask();
	});
</script>
            <div class="col-md-6" id="form-tb-dokter">
                  <div class="box box-primary">
                        <div class="box-header with-border">
                              <h3 class="box-title">Tambah Data</h3>
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
                                          Ente Bahlul?? masa <?php echo $getmsg;?> dibawah nol ??
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
                                    <div class="form-group">
                                          <label>Nama</label>
                                          <input type="text" name="nama" placeholder="Nama" class="form-control">
                                    </div>
                                    <div class="form-group">
                                          <label>Umur</label>
                                          <input type="number" name="umur" placeholder="Umur" class="form-control" min="0">
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
                                            <input type="text" min="1" class="form-control" name="telepon" placeholder="(999) 999-999-999" data-inputmask='"mask" : "(999) 999-999-999"' data-mask>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label>Alamat</label>
                                          <textarea class="form-control" name="alamat"></textarea>
        
                                    </div>
                              </div>
                              <div class="box-footer">
                                    <input type="submit" name="btn-tambah-pasien" class="btn btn-primary btn-flat" value="Tambah">
                                    <input type="submit" name="btn-batal" class="btn btn-info btn-flat" value="Batal">
                              </div>
                        </form>
                       
                  </div>
            </div>
<?php
	if (isset($POST["btn-tambah-pasien"])) {
		extract($POST);
            if ($nama != "") {
                  if ($umur != "") {
                        if ($gender != "") {
                              if ($umur < 0) {
                                    $db->redirect("?hal=user/home&act=add&name=Pasien&type=pasien&vm=um&msg=umur");
                              }
                              else{
                                    $id = "Pa".time()."sI".date("Y")."eN";
                                    $param = array(":id"=>$id, ":nama"=>$nama, ":umur"=>$umur, ":gender"=>$gender, ":alamat"=>$alamat, ":telepon"=>$telepon);
                                    $db->execute("insert into pasien values(:id, :nama, :umur, :gender, :alamat, :telepon)", $param);
                                    $db->redirect("?hal=user/home&act=pasien");
                              }
                        }
                        else{
                              $db->errorInput("?hal=user/home&act=add&name=Pasien&type=pasien", "nama");
                        }
                  }
                  else{
                        $db->errorInput("?hal=user/home&act=add&name=Pasien&type=pasien", "umur");       
                  }
            }
            else{
                  $db->errorInput("?hal=user/home&act=add&name=Pasien&type=pasien", "nama");
            }
	}
      if (isset($POST["btn-batal"])) {
            $db->redirect("?hal=user/home&act=pasien");
      }
?>