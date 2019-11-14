<div class="content">
	<div class="row">
		<?php
			if (!$getact) {
				include_once 'page/home/pembayaran/data-pasien.php';
			}
			if ($getact == "cek" && $getid) {
				include_once 'page/home/pembayaran/data-resep.php';
			}
		?>
	</div>
</div>