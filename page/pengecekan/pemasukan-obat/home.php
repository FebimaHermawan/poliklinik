<div class="content">
	<div class="row">
		<?php
		 if (!$getact == "print") {
			include_once 'page/pengecekan/pemasukan-obat/data-obat-masuk.php';
		 }
		 if ($getact == "print") {
		 	include_once 'page/pengecekan/pemasukan-obat/print-data.php';
		 }
		?>
	</div>
</div>