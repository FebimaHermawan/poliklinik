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
                                        maaf <?php echo $getmsg;?> yang anda masukkan sudah terdaftar
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
                                          <label>Username</label>
                                          <input type="text" name="username" placeholder="Username" class="form-control">
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
                                            <input type="text" min="1" class="form-control" name="telepon" placeholder="(999) 999-999-999" data-inputmask='"mask" : "(999) 999-999-999"' data-mask>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label>Alamat</label>
                                          <textarea class="form-control" name="alamat"></textarea>
        
                                    </div>
                              </div>
                              <div class="box-footer">
                                    <input type="submit" name="btn-tambah-dokter" class="btn btn-primary btn-flat" value="Tambah">
                                    <input type="submit" name="btn-batal" class="btn btn-info btn-flat" value="Batal">
                              </div>
                        </form>
                       
                  </div>
            </div>
<?php
      if (isset($POST["btn-tambah-dokter"])) {
            extract($POST);
            if ($nama != "") {
                  if ($username != ""){
                        if ($password != "") {
                              $getUser = $db->getResult("select username from user");
                              if ($getUser->rowCount() > 0) {
                                  $ValUser = $getUser->fetch();
                                    if ($ValUser["username"] != $username) {
                                          $id = "Us".time()."eR".date("Y");
                                          $password = md5($password);
                                          $param = array(":id"=>$id, ":name"=>$nama, ":username"=>$username, ":password"=>$password, ":telepon"=>$telepon, ":alamat"=>$alamat);
                                          $db->execute("insert into user values(:id, :name, :username, :password, :telepon, :alamat, '1')", $param);
                                          $db->redirect("?hal=user/home&act=dokter&name=Dokter");

                                    }
                                    else{
                                          $db->validationInput("?hal=user/home&act=add&name=Dokter&type=dokter", "Username");
                                    }
                              }
                              else{
                                          $id = "Us".time()."eR".date("Y");
                                          $password = md5($password);
                                          $param = array(":id"=>$id, ":name"=>$nama, ":username"=>$username, ":password"=>$password, ":telepon"=>$telepon, ":alamat"=>$alamat);
                                          $db->execute("insert into user values(:id, :name, :username, :password, :telepon, :alamat, '1')", $param);
                                          $db->redirect("?hal=user/home&act=dokter&name=Dokter");
                              }
                        }
                        else{
                              $db->errorInput("?hal=user/home&act=add&name=Dokter&type=dokter", "Password");
                        }
                  }
                  else{
                        $db->errorInput("?hal=user/home&act=add&name=Dokter&type=dokter", "Username");
                  }
            }
            else{
                  $db->errorInput("?hal=user/home&act=add&name=Dokter&type=dokter", "nama");
            }
      }
      if (isset($POST["btn-batal"])) {
          $db->redirect("?hal=user/home&act=dokter");
      }
?>