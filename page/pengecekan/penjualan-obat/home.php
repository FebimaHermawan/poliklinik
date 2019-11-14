<div class="content">
	<div class="row">
		<?php
			if (!$getact == "print") {
				include_once 'page/pengecekan/penjualan-obat/data-obat-terjual.php';
			}
			if ($getact == "print") {
				include_once 'page/pengecekan/penjualan-obat/print-data.php';
			}
		?>
	</div>
</div>