<div class="col-md-6">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Edit Poli</h3>
			<?php
                if ($getErm == "error" && $getmsg) {
                ?>
                    <div class="callout callout-danger">
                    <button type="button" class="close" id="close-alert">&times;</button>
                       maaf harap tidak kosongi <?php echo $getmsg;?>
                    </div>
                <?php
                  	}
                    if ($getVm == "cek") {
                ?>
                	<div class="callout callout-danger">
                    <button type="button" class="close" id="close-alert">&times;</button>
                    maaf permintaan anda tidak dapat diproses
                    </div>
                <?php
                    }
                ?>
                	
		</div>
	  <form method="post">
		<div class="box-body">
			<?php
					$getPol = $db->execute("select * from poli where id =:id", array(":id"=>$getid));
					while ($givPol = $getPol->fetch()) {
			?>
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama Kategori" value="<?=$givPol['nama']?>">
					<input type="hidden" name="nama_hd" class="form-control" value="<?=$givPol['nama']?>">
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
					<!-- <input type="	" name="dokter_hd" value="<?=$givPol["id_dokter"]?>"> -->
				</div>
			<?php
					}
			?>
		</div>
		<div class="box-footer">
			<input type="submit" name="btn-edit" class="btn btn-primary btn-flat" value="Edit">
		</div>
	  </form>
	</div>
</div>
<?php
		if (isset($POST["btn-edit"])) {
			extract($POST);
			if ($nama != "") {
				if ($dokter != "") {
						$cekPol = $db->getResult("select nama, id_dokter from poli");
						if ($cekPol->rowCount() > 0) {
							$valPol = $cekPol->fetch();
							if ($valPol["nama"] == $nama_hd || $nama != $valPol["nama"] && $valPol["id_dokter"] != $dokter) {
									$param = array(":id"=>$getid, ":nama"=>$nama, ":dokter"=>$dokter);
									$db->execute("update poli set nama = :nama, id_dokter = :dokter where id = :id", $param);
									$db->redirect("?hal=data-extra/home&act=poli&opt=ad");
							}
							else{
								$db->redirect("?hal=data-extra/home&act=poli&opt=ed&id=$getid&vm=cek");
							}
						}
						else{
									$param = array(":id"=>$getid, ":nama"=>$nama, ":dokter"=>$dokter);
									$db->execute("update poli set nama = :nama, id_dokter = :dokter where id = :id", $param);
									$db->redirect("?hal=data-extra/home&act=poli&opt=ad");
						}
				}
				else{
					$db->errorInput("?hal=data-extra/home&act=poli&opt=ed&id=$getid", "dokter");
				}
			}
			else{
				$db->errorInput("?hal=data-extra/home&act=poli&opt=ed&id=$getid", "nama poli");
			}
		}
?>



<script type="text/javascript">
	$(function(){
		(".select2").select2();
	});
</script>