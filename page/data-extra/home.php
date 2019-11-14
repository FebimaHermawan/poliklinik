<section class="content-header">
	<h1>
		Data Extra
		<small>Semua data tentang <?php echo $getTit; ?></small>
	</h1>
</section>
<section class="content">
	<div class="row">
		<?php
			if ($getact && $getact == "obat") {
				// include_once 'page/data-extra/data-obat/';
			}
			if ($getact && $getact == "poli") {
				# code...
			}
			if ($getact && $getact == "kategoriobat" && !$getoption && !$getpr) {
				include_once 'page/data-extra/data-kategori-obat/ex_kategori_obat.php';
				include_once 'page/data-extra/data-kategori-obat/data-kategori.php';
			}
			if ($getact && $getact == "kategoriobat" && $getoption == "ed" && $getid) {
				include_once 'page/data-extra/data-kategori-obat/ed_kategori_obat.php';
				include_once 'page/data-extra/data-kategori-obat/data-kategori.php';	
			}
			if ($getact && $getact == "obat" && !$getpr) {
				include_once 'page/data-extra/data-obat/data-obat.php';
			}
			if ($getoption && $getoption == "add" && $gettype == "obat") {
				include_once 'page/data-extra/data-obat/ex_obat.php';
			}
			if ($getoption && $getoption == "ed" && $gettype && $getid) {
				include_once 'page/data-extra/data-obat/ed_obat.php';
			}
			if ($getact && $getact == "poli" && $getoption == "ad" && !$getpr) {
				include_once 'page/data-extra/data-poli/ex_poli.php';
				include_once 'page/data-extra/data-poli/data-poli.php';
			}
			if ($getact && $getact == "poli" && $getoption == "ed" && $getid) {
				include_once 'page/data-extra/data-poli/ed_poli.php';
				include_once 'page/data-extra/data-poli/data-poli.php';
			}
			if ($getact && $getact == "poli" && $getoption == "ad" && $getpr == "print") {
				include_once 'page/data-extra/data-poli/print-data.php';
			}
			if ($getact && $getact == "obat" && $getpr == "print") {
				include_once 'page/data-extra/data-obat/print-data.php';
			}
			if ($getact && $getact == "kategoriobat" && !$getoption && $getpr == "print") {
				include_once 'page/data-extra/data-kategori-obat/print-data.php';
			}
		?>
	</div>
</section>