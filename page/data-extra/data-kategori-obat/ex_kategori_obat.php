<div class="col-md-6">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Tambah Kategori Obat</h3>
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
					<input type="text" name="nama" class="form-control" placeholder="Nama Kategori">
				</div>
		</div>
		<div class="box-footer">
			<input type="submit" name="tambah-kategori-obat" class="btn btn-primary btn-flat" value="Tambah">
		</div>
	  </form>
	</div>
</div>
<?php
	if (isset($POST["tambah-kategori-obat"])) {
		extract($POST);
		if ($nama != "") {
			$cekKOb = $db->getResult("select nama from kategori_obat");
			if ($cekKOb->rowCount() > 0) {
				$ValKOb = $cekKOb->fetch();
					if ($ValKOb["nama"] != $nama) {
						$db->execute("insert into kategori_obat values('', :nama)",array(":nama"=>$nama));
						$db->redirect("?hal=data-extra/home&act=kategoriobat&name=Kategori Obat");
					}
					else{
						$db->validationInput("?hal=data-extra/home&act=kategoriobat&name=Kategori Obat", "Nama");
					}
				
			}
			else{
						$db->execute("insert into kategori_obat values('', :nama)",array(":nama"=>$nama));
						$db->redirect("?hal=data-extra/home&act=kategoriobat&name=Kategori Obat");
			}
		}
		else{
			$db->errorInput("?hal=data-extra/home&act=kategoriobat&name=Kategori Obat", "Nama");
		}
	}
?>