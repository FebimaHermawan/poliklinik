 <div class="content">
	<div class="row">
		<?php
			if (!$getact) {
				include_once 'page/home/apoteker/data-pasien.php';
			}
			if ($getact == "cek" && !$getid && $getCh) {
				# code...
			}
			if ($getact == "cek" && $getid && $getCh && $getoption != "ed") {
				include_once 'page/home/apoteker/data-resep.php';
			}
			if ($getoption == "ed" && $getid && $getidob || $getedob) {
				include_once 'page/home/apoteker/data-obat.php';
				include_once 'page/home/apoteker/data-edit-resep.php';
			}
		?>		
	</div>
</div>