<div class="col-md-6">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Tambah Poli</h3>
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
                    maaf <?php echo $getmsg;?> yang anda masukkan tidak dapat diproses
                    </div>
                <?php
                    }
                ?>
                	
		</div>
	  <form method="post">
		<div class="box-body">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama Kategori">
				</div>
				<div class="form-group">
					<label>Nama Dokter</label>
					<select class="form-control select2" name="dokter">
						<?php
							$getDok = $db->getResult("select id, nama from user where status = 1");
							while ($givDok = $getDok->fetch()) {
							?>
								<option value="<?=$givDok['id']?>"><?=$givDok["nama"]?></option>
							<?php
							}
						?>
					</select>
				</div>
		</div>
		<div class="box-footer">
			<input type="submit" name="btn-tambah" class="btn btn-primary btn-flat" value="Tambah">
		</div>
	  </form>
	</div>
</div>
<?php
		if (isset($POST["btn-tambah"])) {
			extract($POST);
				if ($nama != "") {
					if ($dokter) {
						$getPol = $db->getResult("select nama, id_dokter from poli");
						if ($getPol->rowCount() > 0) {
							$givPol = $getPol->fetch();
								if ($givPol["nama"] != $nama && $givPol["id_dokter"] != $dokter) {
									$param = array(":nama"=>$nama, ":dokter"=>$dokter);
									$db->execute("insert into poli values('', :dokter, :nama)", $param);
									$db->redirect("?hal=data-extra/home&act=poli&opt=ad");
								}
								else{
									$db->validationInput("?hal=data-extra/home&act=poli&opt=ad", "inputan");
								}
						}
						else{
								$param = array(":nama"=>$nama, ":dokter"=>$dokter);
								$db->execute("insert into poli values('', :dokter, :nama)", $param);
								$db->redirect("?hal=data-extra/home&act=poli&opt=ad");
						}
					}
					else{
						$db->errorInput("?hal=data-extra/home&act=obat&opt=ad", "dokter");
					}
				}
				else{
					$db->errorInput("?hal=data-extra/home&act=poli&opt=ad", "nama poli");
				}
		}
?>



<script type="text/javascript">
	$(function(){
		(".select2").select2();
	});
</script>