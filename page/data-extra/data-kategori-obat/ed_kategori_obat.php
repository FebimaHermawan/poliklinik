<div class="col-md-6">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Edit Kategori Obat</h3>
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
				<?php
					$getKob = $db->execute("select nama from kategori_obat where id = :id", array(":id"=>$getid));
					while ($givKob = $getKob->fetch()) {
				?>
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama Kategori" value="<?=$givKob['nama']?>">
				</div>
				<?php
					}
				?>
		</div>
		<div class="box-footer">
			<input type="submit" name="edit-kategori-obat" class="btn btn-primary btn-flat" value="Edit">
		</div>
	  </form>
	</div>
</div>
<?php
	if (isset($POST["edit-kategori-obat"])) {
		extract($POST);
		if ($nama != "") {
			$cekKob = $db->getResult("select nama from kategori_obat");
			while ($ValKob = $cekKob->fetch()) {
				if ($ValKob["nama"] != $nama) {
					$param = array(":id"=>$getid, ":nama"=>$nama);
					$db->execute("update kategori_obat set nama = :nama where id = :id", $param);
					$db->redirect("?hal=data-extra/home&act=kategoriobat");
				}
			}
		}
		else{
			$db->errorInput("?hal=data-extra/home&act=kategoriobat&name=Kategori Obat", "Nama");
		}
	}
?>