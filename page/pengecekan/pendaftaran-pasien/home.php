<div class="content">
	<div class="row">
		<?php
				if(!$getact == "print"){
					include_once 'page/pengecekan/pendaftaran-pasien/data-pendaftaran.php';
				}
				if ($getact == "print") {
					include_once 'page/pengecekan/pendaftaran-pasien/print-data.php';
				}
		?>		
	</div>
</div>