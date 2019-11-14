<div class="content">
	<div class="row">
		<?php
			if ($getact != "cek" && !$getid) {
				include_once 'page/home/dokter/data-pasien.php';
			}
			if ($getact == "cek" && $getid && !$getoption) {
				include_once 'page/home/dokter/data-resep.php';
			}
			if ($getact == "cek" && $getid && $getoption == "add") {
				include_once 'page/home/dokter/data-obat.php';
			}
			if ($getact == "cek" && $getid && $getoption == "add" && $getidob) {
				include_once 'page/home/dokter/data-obat.php';
				include_once 'page/home/dokter/form-resep.php';
			}
			if ($getact == "cek" && $getid && $getoption == "ed" && $getidob) {
				include_once 'page/home/dokter/data-obat.php';
				include_once 'page/home/dokter/form-edit-resep.php';
			}

		?>
	</div>
</div>