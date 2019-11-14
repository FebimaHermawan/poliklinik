<section class="content-header">
	<h1>
		Data User
		<small>Data untuk <?php echo $getTit;?></small>
	</h1>
</section>
<section class="content">
	<div class="row">
		<?php
			if ($getact && $getact == "admin" && !$getpr ) {
				include_once 'page/user/admin/data-admin.php';
			}
			if ($getact && $getact == "dokter" && !$getpr) {
				include_once 'page/user/dokter/data-dokter.php';
			}
			if ($getact && $getact == "karyawan" && !$getpr) {
				include_once 'page/user/karyawan/data-apoteker.php';
				include_once 'page/user/karyawan/data-karyawan-pendaftaran.php';
				include_once 'page/user/karyawan/data-karyawan-pembayaran.php';
			}
			if ($getact && $getact == "pasien") {
				include_once 'page/user/pasien/data-pasien.php';
			}
			if ($getact && $getact == "add" && $gettype == "admin") {
				include_once 'page/user/admin/ex_admin.php';
			}
			if ($getact && $getact == "add" && $gettype == "dokter") {
				include_once 'page/user/dokter/ex_dokter.php';
			}
			if ($getact && $getact == "add" && $gettype == "apoteker") {
				include_once 'page/user/karyawan/ex_apoteker.php';
			}
			if ($getact && $getact == "add" && $gettype == "karyawan_pendaftaran") {
				include_once 'page/user/karyawan/ex_karyawan_pendaftaran.php';
			}
			if ($getact && $getact == "add" && $gettype == "karyawan_pembayaran") {
				include_once 'page/user/karyawan/ex_karyawan_pembayaran.php';
			}
			if ($getact && $getact == "add" && $gettype == "pasien") {
				include_once 'page/user/pasien/ex_pasien.php';
			}
			if ($getoption && $getoption == "ed" && $getid && $gettype == "admin") {
				include_once 'page/user/admin/ed_admin.php';
			}
			if ($getoption && $getoption == "ed" && $getid && $gettype == "dokter") {
				include_once 'page/user/dokter/ed_dokter.php';
			}
			if ($getoption && $getoption == "ed" && $getid && $gettype == "karyawan") {
				include_once 'page/user/karyawan/ed_karyawan.php';
			}
			if ($getoption && $getoption == "ed" && $getid && $gettype == "pasien") {
				include_once 'page/user/pasien/ed_pasien.php';
			}
			if ($getpr == "print" && $getact == "admin") {
				include_once 'page/user/admin/print-data.php';
			}
			if ($getpr == "print" && $getact == "dokter") {
				include_once 'page/user/dokter/print-data.php';
			}
			if ($getpr == "printAp" && $getact == "karyawan") {
				include_once 'page/user/karyawan/print-data-apoteker.php';
			}
			if ($getpr == "printPen" && $getact == "karyawan") {
				include_once 'page/user/karyawan/print-data-pendaftaran.php';
			}
			if ($getpr == "printPem" && $getact == "karyawan") {
				include_once 'page/user/karyawan/print-data-pembayaran.php';
			}
		?>
	</div>
</section>