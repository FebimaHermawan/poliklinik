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
                                    if($getVm == "vali"){
                              ?>
                                    <div class="callout callout-danger">
                                        <button type="button" class="close" id="close-alert">&times;</button>
                                        maaf <?php echo $getmsg;?> tidak dapat dirubah
                                      </div>
                              <?php
                                    }
                              ?>
                        </div>
                        <form method="post">
                        <div class="form-group">
                              <div class="box-body">
                              <?php
                                    $getPen = $db->execute("select * from pendaftaran where no_daftar = :id", array(":id"=>$getid));
                                    while ($givPen = $getPen->fetch()) {
                                         
                              ?> 
                                        <div class="form-group">
                                          <label>Nama</label>
                                          <?php
                                            $getPas = $db->execute("select nama from pasien where id = :id", array(":id"=>$givPen['id_pasien']));
                                            while ($givPas = $getPas->fetch()) {
                                          ?>
                                          <input type="text" name="nama" placeholder="Nama" class="form-control" value="<?=$givPas["nama"]?>" readonly>
                                          <input type="hidden" name="nama_hd" placeholder="Nama" class="form-control" value="<?=$givPen["id_pasien"]?>" readonly>
                                          <?php
                                            }
                                          ?>
                                        </div>
                                        <div class="form-group">
                                                    <label>Poli</label>
                                                    <select class="form-control" name="poli">
                                                          <?php
                                                                $getPol = $db->execute("select * from poli");
                                                                while ($givPol = $getPol->fetch()) {
                                                          ?>
                                                                <option value="<?=$givPol['id']?>"><?=$givPol['nama']?></option>
                                                          <?php
                                                                }
                                                          ?>
                                                    </select>
                                        </div>
                                        <div class="form-group">
                                                    <label>Keluhan</label>
                                                    <textarea class="form-control" name="keluhan"><?=$givPen["keterangan"]?></textarea>
                                        </div>
                             <div class="box-footer">
                                  <input type="submit" name="btn-edit-pendaftaran" class="btn btn-primary btn-flat" value="Tambah">
                                  <input type="submit" name="btn-batal" class="btn btn-info btn-flat" value="Batal">
                              </div>
                               </div>
                              <?php
                                    }
                              ?>
                        </div>
                        </form>
                       
                  </div>
            </div>
            <?php
                  if (isset($POST["btn-edit-pendaftaran"])) {
                    extract($POST);
                      if ($nama_hd != "") {
                          if ($poli != "") {
                            if ($keluhan != "") {
                                $cekPen = $db->execute("select * from pendaftaran where no_daftar = :id", array(":id"=>$getid));
                                $valPen = $cekPen->fetch();
                                  if ($valPen["id_pasien"] == $nama_hd) {
                                    $param = array(":id"=>$getid, ":idpo"=>$poli, ":kel"=>$keluhan);
                                    $db->execute("update pendaftaran set id_poli = :idpo, keterangan = :kel where no_daftar = :id", $param);
                                    $db->redirect("index.php");
                                  }
                                  else{
                                      $db->validationInput("index.php?act=ed&id=$getid", "nama");
                                  } 
                            }
                            else{
                              $db->errorInput("index.php?act=ed&id=$getid", "keluhan");
                            }
                          }
                          else{
                            $db->errorInput("index.php?act=ed&id=$getid", "poli");
                          }
                      }
                      else{
                        $db->errorInput("index.php?act=ed&id=$getid", "nama");
                      }
                  }
                  if (isset($POST["btn-batal"])) {
                      $db->redirect("index.php");
                  }
            ?>