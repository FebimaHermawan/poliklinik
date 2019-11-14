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
                    maaf <?php echo $getmsg;?> yang anda masukkan sudah terdaftar, silahkan edit yang sudah tersedia
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
				$getOb = $db->execute("select nama, jumlah, isi_pemberian from obat where id = :id", array(":id"=>$getidob));
				while ($givOb = $getOb->fetch()) {
					$jum = $givOb['jumlah'] - 1;
					$dosis = ($givOb["isi_pemberian"] * 2) - 1;
			?>
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama Kategori" value="<?=$givOb['nama']?>" readonly>
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="number" name="jumlah" class="form-control" placeholder="Jumlah" min= "0" max="<?=$jum?>">
				</div>
				<div class="form-group">
					<label>Dosis</label>
					<div class="input-group">
						<input type="number" name="dosis" class="form-control" placeholder="Dosis" min="0" max="<?=$dosis?>">
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
			?>
		</div>
		<div class="box-footer">
			<input type="submit" name="tambah-obat" class="btn btn-primary btn-flat" value="Tambah">
		</div>
	  </form>
	</div>
</div>
<?php
	if (isset($POST["tambah-obat"])) {
		extract($POST);
		if ($nama != "") {
			if ($jumlah != "") {
				if ($dosis != "") {
					$getRes = $db->execute("select id_obat, id_pendaftaran from resep where id = :id", array(":id"=>$getid));
					$givRes = $getRes->fetch();
						if ($givRes["id_obat"] != "" || $getRes->rowCount() > 1) {
							if ($givRes["id_obat"] != $getidob) {
								$cekJum = $db->execute("select jumlah, harga, isi_pemberian from obat where id = :id", array(":id"=>$getidob));
								$ValJum = $cekJum->fetch();
								$totDosis = $ValJum["isi_pemberian"]*2;
									if ($ValJum["jumlah"] > $jumlah && $jumlah > 0 && $totDosis > $dosis && $dosis > 0) {
										$total = $jumlah * $ValJum["harga"];
										$param = array(":id"=>$getid, ":idpen"=>$givRes["id_pendaftaran"], ":ido"=>$getidob, ":jumlah"=>$jumlah, ":dosis"=>$dosis, ":total"=>$total);
										$db->execute("insert into resep values(:id, :idpen, :ido, :jumlah, :dosis, now(), :total, '0', '0')", $param);
										$db->redirect("index.php?act=cek&id=$getid&chg=$getCh");
									}
									else{
										$db->redirect("index.php?act=cek&id=$getid&opt=add&ido=$getidob&es=jumlah");
									}
							}
							else{
								$db->validationInput("index.php?act=cek&id=$getid&opt=add&chg=$getCh&ido=$getidob", "obat");
							}
						}
						else{
							$cekJum = $db->execute("select jumlah, harga, isi_pemberian from obat where id = :id", array(":id"=>$getidob));
							$ValJum = $cekJum->fetch();
							$totDosis = $ValJum["isi_pemberian"]*2;
								if ($ValJum["jumlah"] > $jumlah && $jumlah > 0 && $totDosis > $dosis && $dosis > 0) {
									$total = $ValJum["harga"] * $jumlah;
									$param = array(":id"=>$getid, ":ido"=>$getidob, ":jumlah"=>$jumlah, ":dosis"=>$dosis, ":total"=>$total);
									$db->execute("update resep set id_obat = :ido, jumlah = :jumlah, dosis = :dosis, tanggal = now(), total = :total where id = :id", $param);
									$db->redirect("index.php?act=cek&id=$getid&chg=$getCh");
								}
						}
				}
				else{
					$db->errorInput("index.php?act=cek&id=$getid&opt=add&ido=$getidob", "dosis obat");
				}
			}
			else{
				$db->errorInput("index.php?act=cek&id=$getid&opt=add&ido=$getidob", "jumlah obat");
			}
		}
		else{
			$db->errorInput("index.php?act=cek&id=$getid&opt=add&ido=$getidob", "nama obat");
		}
	}
?>