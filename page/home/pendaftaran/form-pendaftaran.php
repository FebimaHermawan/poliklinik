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
                                    if($getVm == "vali"){
                              ?>
                                    <div class="callout callout-danger">
                                        <button type="button" class="close" id="close-alert">&times;</button>
                                        maaf <?php echo $getmsg;?> tidak dapat mendaftar lagi pada hari ini dengan poli yang sama
                                      </div>
                              <?php
                                    }
                              ?>
                        </div>
                        <form method="post">
                        <div class="form-group">
                              <div class="box-body">
                              <?php
                                    $getUs = $db->execute("select * from pasien where id = :id", array(":id"=>$getid));
                                    while ($givUs = $getUs->fetch()) {
                                         
                              ?> 
                                        <div class="form-group">
                                          <label>Nama</label>
                                          <input type="text" name="nama" placeholder="Nama" class="form-control" value="<?=$givUs['nama']?>" readonly>
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
                                                    <textarea class="form-control" name="keluhan"></textarea>
                                        </div>
                             <div class="box-footer">
                                  <input type="submit" name="btn-pendaftaran" class="btn btn-primary btn-flat" value="Tambah">
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
                  if (isset($POST["btn-pendaftaran"])) {
                    extract($POST);
                    if ($nama != "") {
                      if($poli != ""){
                        if ($keluhan != "") {
                            $cekPas = $db->execute("select id_poli from pendaftaran where id_pasien = :idp and date_format(tanggal, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d')", array(":idp"=>$getid));
                            if ($cekPas->rowCount() > 0) {
                              while ($valPol = $cekPas->fetch()) {
                                  if ($valPol["id_poli"] != $poli) {
                                    $id = "pEn".time()."dAf".date("Y")."taRaN";
                                    $param = array(":id"=>$id, ":idpas"=>$getid, ":idpol"=>$poli, ":keluhan"=>$keluhan);
                                    $ins = $db->execute("insert into pendaftaran values(:id, :idpas, :idpol, now(), '8000', :keluhan, '1')", $param);
                                      if ($ins) {
                                        $id_res = "Re".time()."sE".date("Y")."p";
                                        $params = array(":id"=>$id_res, ":idpen"=>$id);
                                        $insres = $db->execute("insert into resep values(:id, :idpen, '', '', '', now(), '', '', '')", $params);
                                        if ($insres) {
                                          $db->execute("insert into activity values('', :id, '2', :ket, now())", array(":id"=>$user_sess, ":ket"=>"mendaftarkan id_pasien = ".$getid));
                                          $db->redirect("index.php");
                                        }
                                      }
                                  }
                                  else{
                                   $db->validationInput("index.php?act=add&id=$getid", "pasien");
                                  }
                              }
                            }
                            else{
                                $id = "pEn".time()."dAf".date("Y")."taRaN";
                                $param = array(":id"=>$id, ":idpas"=>$getid, ":idpol"=>$poli, ":keluhan"=>$keluhan);
                                $ins = $db->execute("insert into pendaftaran values(:id, :idpas, :idpol, now(), '5000', :keluhan, '1')", $param);
                                  if ($ins) {
                                      $id_res = "Re".time()."sE".date("Y")."p";
                                      $params = array(":id"=>$id_res, ":idpen"=>$id);
                                      $insres = $db->execute("insert into resep values(:id, :idpen, '', '', '', now(), '', '', '')", $params);
                                      if ($insres) {
                                        $db->execute("insert into activity values('', :id, '2', :ket, now())", array(":id"=>$user_sess, ":ket"=>"mendaftarkan id_pasien = ".$getid));
                                        $db->redirect("index.php");
                                      }
                                  }
                            }
                        }
                        else{
                          $db->errorInput("index.php?act=add&id=$getid", "keluhan");
                        }
                      }
                      else{
                        $db->errorInput("index.php?act=add&id=$getid", "poli");
                      }
                    }
                    else{
                      $db->errorInput("index.php?act=add&id=$getid", "nama");
                    }
                }
                  if (isset($POST["btn-batal"])) {
                      $db->redirect("index.php?act=add");
                  }
            ?>