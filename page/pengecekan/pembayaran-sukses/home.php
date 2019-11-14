<div class="content">
	<div class="row">
		<?php
			if (!$getact == "print") {
				include_once 'page/pengecekan/pembayaran-sukses/data-pembayaran.php';
			}
			if ($getact == "print") {
				include_once 'page/pengecekan/pembayaran-sukses/print-data.php';
			}
		?>
	</div>
</div>