<script>
	$(function(){
		$("[data-mask]").inputmask();
	});
</script>
            <div class="col-md-6" id="form-tb-dokter">
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
                              ?>
                        </div>
                        <form method="post">
                              <div class="box-body">
                                  <?php
                                    $getAd = $db->execute("select * from user where id = :id", array(":id"=>$getid));
                                    while ($givAd = $getAd->fetch()) {
                                  ?>
                                    <div class="form-group">
                                          <label>Nama</label>
                                          <input type="text" name="nama" placeholder="Nama" class="form-control" value="<?=$givAd['nama']?>">
                                    </div>
                                    <div class="form-group">
                                          <label>Username</label>
                                          <input type="text" name="username" placeholder="Username" class="form-control val-dis"readonly value="<?=$givAd['username']?>">
                                    </div>
                                    <div class="form-group">
                                          <label>Password</label>
                                          <input type="password" name="password" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                          <label>Telepon</label>
                                          <div class="input-group">
                                              <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                              </div>
                                            <input type="text" min="1" class="form-control" name="telepon" placeholder="(999) 999-999-999" data-inputmask='"mask" : "(999) 999-999-999"' data-mask value="<?=$givAd['telepon']?>">
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label>Alamat</label>
                                          <textarea class="form-control" name="alamat"><?=$givAd['alamat']?></textarea>
        
                                    </div>
                                  <?php
                                    }
                                  ?>
                              </div>
                              <div class="box-footer">
                                    <input type="submit" name="btn-edit-dokter" class="btn btn-primary btn-flat" value="Edit">
                                    <input type="submit" name="btn-batal" class="btn btn-info btn-flat" value="Batal">
                              </div>
                        </form>
                       
                  </div>
            </div>
<?php
	if (isset($POST["btn-edit-dokter"])) {
		extract($POST);
            if ($nama != "") {
                if ($username != "") {
                      if ($password != "") {
                              $cekAd = $db->execute("select username from user where id = :id", array(":id"=>$getid));
                              while ($valAd = $cekAd->fetch()) {
                                  if ($valAd["username"] == $username) {
                                     $password = md5($password);
                                     $param = array(":id"=>$getid, ":nama"=>$nama, ":username"=>$username, ":password"=>$password, ":alamat"=>$alamat, ":telepon"=>$telepon);
                                     $db->execute("update user set nama = :nama, username = :username, password = :password, telepon = :telepon, alamat = :alamat where id = :id",$param);
                                     $db->redirect("?hal=user/home&act=dokter&name=Dokter");
                                  }
                                  else{
                                    $db->validationInput("?hal=user/home&opt=ed&id=$getid&type=dokter&name=Dokter", "Username");
                                  }
                              }
                      }
                      else{
                              $db->errorInput("?hal=user/home&opt=ed&id=$getid&type=dokter&name=Dokter", "Password");
                      }
                  }else{
                         $db->errorInput("?hal=user/home&opt=ed&id=$getid&type=dokter&name=Dokter", "Username");
                  }
            }
            else{
                  $db->errorInput("?hal=user/home&opt=ed&id=$getid&type=dokter&name=Dokter", "nama");
            }
	}
  if (isset($POST["btn-batal"])) {
    $db->redirect("?hal=user/home&act=dokter");
  }
?>