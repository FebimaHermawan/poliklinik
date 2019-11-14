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
			<?php
				$getOb = $db->execute("select * from obat where id = :id", array(":id"=>$getid));
				while ($givOb = $getOb->fetch()) {
			?>
		<div class="box-body">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama Kategori" value="<?=$givOb['nama']?>">
				</div>
				<div class="form-group">
					<label>Jenis</label>
					<select class="form-control" name="jenis">
						<option value="1">Pil</option>
						<option value="2">Tablet</option>
						<option value="3">Puyer</option>
						<option value="4">Sirup</option>
					</select>
				</div>
				<div class="form-group">
					<label>Kategori</label>
					<select class="form-control" name="kategori">
						<?php
							$getKOb = $db->getResult("select * from kategori_obat");
							while ($givKOb = $getKOb->fetch()) {
						?>
							<option value="<?=$givKOb['id']?>"><?=$givKOb['nama']?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Harga</label>
					<input type="text" name="harga" min="0" class="form-control" placeholder="Harga" value="<?=$givOb['harga']?>">
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="number" name="jumlah" min="0" class="form-control" placeholder="Jumlah" value="<?=$givOb['jumlah']?>">
				</div>
				<div class="form-group">
					<label>Isi Tiap Wadah</label>
					<input type="number" min="0" name="pemberian" class="form-control" placeholder="Isi Tiap Pemberian" value="<?=$givOb['isi_pemberian']?>">
				</div>
				<div class="form-group">
					<label>Aturan Pemakaian</label>
					<select class="form-control" name="pemakaian">
						<option value="1">Sebelum makan</option>
						<option value="2">Setelah makan</option>
					</select>
				</div>
		</div>
		<div class="box-footer">
			<input type="submit" name="edit-obat" class="btn btn-primary btn-flat" value="Tambah">
		</div>
		<?php
			}
		?>
	  </form>
	</div>
</div>
<?php
	if (isset($POST["edit-obat"])) {
		extract($POST);
		if ($nama != "") {
			if ($jenis != "") {
				if ($kategori != "") {
					if ($harga != "") {
						if ($jumlah != "") {
							if ($pemberian != "") {
								if ($harga > 0) {
									if ($jumlah > 0) {
										if ($pemberian > 0) {
											$cekOb = $db->execute("select jumlah from obat where id = :id", array(":id"=>$getid));
											if ($cekOb->rowCount() > 0) {
												$valJum = $cekOb->fetch();
												$param = array(":id"=>$getid, ":nama"=>$nama, ":jenis"=>$jenis, ":kategori"=>$kategori, ":harga"=>$harga, ":jumlah"=>$jumlah, ":pemberian"=>$pemberian, ":pemakaian"=>$pemakaian);
												$db->execute("update obat set nama = :nama, jenis = :jenis, kategori = :kategori, harga = :harga, jumlah = :jumlah, isi_pemberian = :pemberian, pemakaian = :pemakaian where id = :id", $param);
													if ($jumlah > $valJum["jumlah"]) {
														$hasil = $jumlah - $valJum["jumlah"];
														$parOb = array(":id"=>$getid, ":jum"=>$hasil, ":harga"=>$harga, ":isi"=>$pemberian);
														$db->execute("insert into activity_obat values('', :id, :jum, :harga, :isi, '1', now())", $parOb);
													}
												$db->redirect("?hal=data-extra/home&act=obat");
											}
										}
										else{
											$db->redirect("?hal=data-extra/home&opt=add&type=obat&es=Isi Tiap Pemberian");
										}
									}
									else{
										$db->redirect("?hal=data-extra/home&opt=add&type=obat&es=jumlah");
									}
								}
								else{
									$db->redirect("?hal=data-extra/home&opt=add&type=obat&es=harga");
								}
							}
							else{
								$db->errorInput("?hal=data-extra/home&type=obat&opt=ed&id=$getid", "Pemberian");
							}
						}
						else{
							$db->errorInput("?hal=data-extra/home&type=obat&opt=ed&id=$getid", "Jumlah");
						}
					}
					else{
						$db->errorInput("?hal=data-extra/home&type=obat&opt=ed&id=$getid", "Harga");
					}
				}
				else{
					$db->errorInput("?hal=data-extra/home&type=obat&opt=ed&id=$getid", "Kategori");
				}
			}
			else{
				$db->errorInput("?hal=data-extra/home&type=obat&opt=ed&id=$getid", "Jenis");
			}
		}
		else{
			$db->errorInput("?hal=data-extra/home&type=obat&opt=ed&id=$getid", "Nama");
		}
	}
?>