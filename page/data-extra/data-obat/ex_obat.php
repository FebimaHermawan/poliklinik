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
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama">
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
					<input type="text" name="harga" min="0" class="form-control" placeholder="Harga">
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="number" name="jumlah" min="0" class="form-control" placeholder="Jumlah">
				</div>
				<div class="form-group">
					<label>Isi Tiap Wadah</label>
					<input type="number" min="0" name="pemberian" class="form-control" placeholder="Isi Tiap Pemberian">
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
			<input type="submit" name="tambah-obat" class="btn btn-primary btn-flat" value="Tambah">
		</div>
	  </form>
	</div>
</div>
<?php
	if (isset($POST["tambah-obat"])) {
		extract($POST);
		if ($nama != "") {
			if ($jenis != "") {
				if ($kategori != "") {
					if ($harga != "") {
						if ($jumlah != "") {
							if ($pemberian != "") {
								if ($harga < 0) {
									$db->redirect("?hal=data-extra/home&opt=add&type=obat&es=stock");
								}
								else{
									if ($jumlah < 0) {
										$db->redirect("?hal=data-extra/home&opt=add&type=obat&es=jumlah");
									}
									else{
										if ($pemberian < 0 ) {
											$db->redirect("?hal=data-extra/home&opt=add&type=obat&es=isi Tiap Pemberian");
										}
										else{
											$getOb = $db->getResult("select nama from obat");
											if ($getOb->rowCount() > 0) {
												$givOb = $getOb->fetch();
												if($givOb["nama"] != $nama) {
													$id = "Ob".time()."a".date("Y")."t";
													$param = array(":id"=>$id, ":nama"=>$nama, ":jenis"=>$jenis, ":kategori"=>$kategori, ":harga"=>$harga, ":jumlah"=>$jumlah, ":pemberian"=>$pemberian, ":pemakaian"=>$pemakaian);
													$inOb = $db->execute("insert into obat values(:id, :nama, :jenis, :kategori, :harga, :jumlah, :pemberian, :pemakaian)", $param);
														if ($inOb) {
															$parOb = array(":id"=>$id, ":jum"=>$jumlah, ":har"=>$harga, ":isi"=>$pemberian);
															$db->execute("insert into activity_obat values('', :id, :jum, :har, :isi, '1', now())", $parOb);
															$db->redirect("?hal=data-extra/home&act=obat");
														}
												}
											}
											else{
													$id = "Ob".time()."a".date("Y")."t";
													$param = array(":id"=>$id, ":nama"=>$nama, ":jenis"=>$jenis, ":kategori"=>$kategori, ":harga"=>$harga, ":jumlah"=>$jumlah, ":pemberian"=>$pemberian, ":pemakaian"=>$pemakaian);
													$inOb = $db->execute("insert into obat values(:id, :nama, :jenis, :kategori, :harga, :jumlah, :pemberian, :pemakaian)", $param);
													if ($inOb) {
															$parOb = array(":id"=>$id, ":jum"=>$jumlah, ":har"=>$harga, ":isi"=>$pemberian);
															$db->execute("insert into activity_obat values('', :id, :jum, :har, :isi, '1', now())", $parOb);
															$db->redirect("?hal=data-extra/home&act=obat");
													}
											}
										}
									}
								}
							}
							else{
								$db->errorInput("?hal=data-extra/home&act=obat", "isi pemberian");
							}
						}
						else{
							$db->errorInput("?hal=data-extra/home&act=obat", "jumlah");
						}
					}
					else{
						$db->errorInput("?hal=data-extra/home&act=obat", "Harga");
					}
				}
				else{
					$db->errorInput("?hal=data-extra/home&act=obat", "Kategori");
				}
			}
			else{
				$db->errorInput("?hal=data-extra/home&act=obat", "Jenis");
			}
		}
		else{
			$db->errorInput("?hal=data-extra/home&opt=obat", "Nama");
		}
	}
?>