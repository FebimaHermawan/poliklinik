<div class="content">
	<div class="row">
		<?php
			if (!$getact) {
				include_once 'page/home/pendaftaran/data-pasien.php';
			}
			if ($getact == "add" && !$getid) {
				include_once 'page/home/pendaftaran/tabel-pasien.php';
			}
			if ($getact == "add" && $getid) {
				include_once 'page/home/pendaftaran/tabel-pasien.php';
				include_once 'page/home/pendaftaran/form-pendaftaran.php';
			}
			if ($getact == "ed" && $getid) {
				include_once 'page/home/pendaftaran/form-edit-pendaftaran.php';
			}
			if ($getact == "del" && $getid) {
				$del = $db->execute("delete from pendaftaran where no_daftar = :id", array(":id"=>$getid));
					if ($del) {
						$act = $db->execute("insert into activity values('', :id, '4', :ket, now())", array(":id"=>$user_sess, ":ket"=>"menghapus id_pasien = ".$getid." dari pendaftaran"));
						if ($act) {
							$db->execute("delete from resep where id_pendaftaran = :id", array(":id"=>$getid));	
							$db->redirect("index.php");
						}
					}
			}
		?>
	</div>
</div>
<div class="content">
	<div class="row">
	</div>
</div>