<div class="col-md-6">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Tambah Obat</h3>
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
                    if ($getEs) {
                ?>
                	<div class="callout callout-danger">
                    <button type="button" class="close" id="close-alert">&times;</button>
                    maaf <?php echo $getEs;?> yang anda masukkan kurang dari yang seharusnya
                    </div>
                <?php
                    }
                ?>
		</div>
	  <form method="post">
		<div class="box-body">
			<?php
				$getOb = $db->execute("select nama, jumlah, isi_pemberian, harga from obat where id = :id", array(":id"=>$getidob));
				while ($givOb = $getOb->fetch()) {
					$jum = $givOb['jumlah'] - 1;
					$dosis = ($givOb["isi_pemberian"] * 2) - 1;
			?>
				<div class="form-group">
					<label>Nama</label>
					<?php
						if ($getedob) {
							$edOb = $db->execute("select nama, jumlah, isi_pemberian, harga from obat where id = :id", array(":id"=>$getedob));
							while ($datOb = $edOb->fetch()) {
							$jumEd = $datOb['jumlah'] - 1;
							$dosisEd = ($datOb["isi_pemberian"] * 2) - 1;
					?>
						<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?=$datOb['nama']?>" readonly>
						<div class="form-group">
							<label>Jumlah</label>
							<input type="number" name="jumlah" class="form-control" placeholder="Jumlah" min= "0" max="<?=$jumEd?>" >
							<input type="hidden" name="harga" class="form-control" value="<?=$datOb['harga']?>">
						</div>
						<div class="form-group">
							<label>Dosis</label>
							<div class="input-group">
								<input type="number" name="dosis" class="form-control" placeholder="Dosis" min="0" max="<?=$dosisEd?>">
								<span class="input-group-addon">
									<?php
										$getJen = $db->execute("select jenis from obat where id = :id", array(":id"=>$getidob));
										while ($givJen = $getJen->fetch()) {
													if ($givJen["jenis"] == 1) {
														echo "Pil/hari";
													}
													if ($givJen["jenis"] == 2) {
														echo "Tablet/hari";
													}
													if ($givJen["jenis"] == 3) {
														echo "Puyer/hari";
													}
													if ($givJen["jenis"] == 4) {
														echo "Sirup/hari";
													}
										}
									?>
								</span>
							</div>
						</div>
					<?php
							}
						}
						else{
							$datJD = $db->execute("select jumlah, dosis from resep where id = :id and id_obat = :ido", array(":id"=>$getid, ":ido"=>$getidob));
							while ($rowJD = $datJD->fetch()) {
					?>
						<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?=$givOb['nama']?>" readonly>
						<div class="form-group">
							<label>Jumlah</label>
							<input type="number" name="jumlah" class="form-control" placeholder="Jumlah" min= "0" max="<?=$jum?>" value="<?=$rowJD['jumlah']?>">
							<input type="hidden" name="harga" class="form-control" value="<?=$givOb['harga']?>">
						</div>
						<div class="form-group">
							<label>Dosis</label>
							<div class="input-group">
								<input type="number" name="dosis" class="form-control" placeholder="Dosis" min="0" max="<?=$dosis?>" value="<?=$rowJD['dosis']?>">
								<span class="input-group-addon">
									<?php
										$getJen = $db->execute("select jenis from obat where id = :id", array(":id"=>$getidob));
										while ($givJen = $getJen->fetch()) {
													if ($givJen["jenis"] == 1) {
														echo "Pil/hari";
													}
													if ($givJen["jenis"] == 2) {
														echo "Tablet/hari";
													}
													if ($givJen["jenis"] == 3) {
														echo "Puyer/hari";
													}
													if ($givJen["jenis"] == 4) {
														echo "Sirup/hari";
													}
										}
									?>
								</span>
							</div>
						</div>
					<?php
							}
						}
				}
					?>
				</div>
		</div>
		<div class="box-footer">
			<input type="submit" name="edit-obat" class="btn btn-primary btn-flat" value="Edit">
		</div>
	  </form>
	</div>
</div>
<?php
	if (isset($POST["edit-obat"])) {
		extract($POST);
		if ($nama != "") {
			if ($jumlah != "") {
				if ($dosis != "") {
					if ($getedob) {
						$total = $harga * $jumlah; 
						$param = array(":edo"=>$getedob, ":ido"=>$getidob, ":id"=>$getid, ":jum"=>$jumlah, ":dos"=>$dosis, ":total"=>$total);
						$ins = $db->execute("update resep set id_obat = :edo, jumlah = :jum, dosis = :dos, total = :total where id_obat = :ido and id = :id", $param);
							if ($ins) {
								$db->execute("insert into activity values('', :id, '3', :ket, now())", array(":id"=>$user_sess, ":ket"=>$user_sess." mengubah id obat = ".$getidob." dengan id obat = ".$getedob."pada id_resep = ".$getid));
								$db->redirect("index.php?act=cek&id=$getid&chg=$getCh");
							}
					}
					if (!$getedob){
						$total = $harga * $jumlah; 
						$param = array(":ido"=>$getidob, ":id"=>$getid, ":jum"=>$jumlah, ":dos"=>$dosis, ":total"=>$total);
						$ins = $db->execute("update resep set jumlah = :jum, dosis = :dos, total = :total where id_obat = :ido and id = :id", $param);
						if ($ins) {
							$db->execute("insert into activity values('', :id, '3', :ket, now())", array(":id"=>$user_sess, ":ket"=>$user_sess." mengedit id_obat = ".$getidob));
							$db->redirect("index.php?act=cek&id=$getid&chg=$getCh");
						}
					}
				}
				else{
					$db->errorInput("index.php?act=cek&id=$getid&opt=ed&ido=$getidob", "dosis obat");
				}
			}
			else{
				$db->errorInput("index.php?act=cek&id=$getid&opt=ed&ido=$getidob", "jumlah obat");
			}
		}
		else{
			$db->errorInput("index.php?act=cek&id=$getid&opt=ed&ido=$getidob", "nama obat");
		}
	}
?>