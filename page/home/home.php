<section class="content-header">
	<h1>
		Dashboard
		<small>
			Dashboard Panel
			<?php
				if ($user_stat == 0) {
					echo "Admin";
				}
				if ($user_stat == 1) {
					echo "Dokter";
				}
				if ($user_stat == 2) {
					echo "Apoteker";
				}
				if ($user_stat == 3) {
					echo "Pendaftaran";
				}
				if ($user_stat == 4) {
					echo "Pembayaran";
				}
			?>
		</small>
	</h1>
</section>
<?php
	if ($user_stat == 0) {
		include_once 'page/home/admin/home.php';
	}
	if ($user_stat == 1) {
		include_once 'page/home/dokter/home.php';
	}
	if ($user_stat == 2) {
		include_once 'page/home/apoteker/home.php';
	}
	if ($user_stat == 3) {
		include_once 'page/home/pendaftaran/home.php';
	}
	if ($user_stat == 4) {
		include_once 'page/home/pembayaran/home.php';
	}
?>