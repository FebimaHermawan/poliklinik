 <section class="sidebar">
	<div class="user-panel">
		<div class="pull-left image">
			<img src="lib/user8-128x128.jpg" class="img-circle" alt="User Image">
		</div>
		<div class="pull-left info">
			<p>
				<?php echo $user_name;?>
			</p>
			<a href="index.php?act=out"><i class="glyphicon glyphicon-log-out"></i>Logout</a>
			<?php
				if ($getact == "out") {
					$db->redirect("logout.php");
				}
			?>
		</div>
	</div>
	<div class="sidebar-menu">
		<li class="header">Main Administration</li>
		<li>
			<a href="./">
				<i class="fa fa-cube"></i>
				<span>Dashboard</span>
			</a>
		</li>
		<?php
			if ($user_stat == 0) {
		?>
			<li class="treeview">
				<a href="#">
						<i class="fa fa-male"></i>
						<span>Data Users</span>
						<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="?hal=user/home&act=admin&name=Admin">
							<i class="fa fa-eye"></i>
							<span>Admin</span>
						</a>
					</li>
					<li>
						<a href="?hal=user/home&act=dokter&name=Dokter">
							<i class="fa fa-stethoscope"></i>
							<span>Dokter</span>
						</a>
					</li>
					<li>
						<a href="?hal=user/home&act=karyawan&name=Karyawan">
							<i class="fa fa-venus-double"></i>
							<span>Karyawan</span>
						</a>
					</li>
					<li>
						<a href="?hal=user/home&act=pasien&name=Pasien">
							<i class="fa fa-smile-o"></i>
							<span>Pasien</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="treeview">
				<a href="">
					<i class="fa fa-th-large"></i>
					<span>Data Extra</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
					<ul class="treeview-menu">
						<li>
							<a href="?hal=data-extra/home&act=poli&name=Poli&opt=ad">
								<i class="fa fa-hospital-o"></i>
								<span>Data Poli</span>
							</a>
						</li>
						<li>
							<a href="?hal=data-extra/home&act=obat&name=Obat">
								<i class="fa fa-heartbeat"></i>
								<span>Data Obat</span>
							</a>
						</li>
						<li>
							<a href="?hal=data-extra/home&act=kategoriobat&name=Kategori Obat">
								<i class="fa fa-medkit"></i>
								<span>Data Kategori Obat</span>
							</a>
						</li>
					</ul>
			</li>
			<li class="treeview">
				<a href="">
					<i class="fa fa-paperclip"></i>
					<span>Data Pengecekan</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
					<ul class="treeview-menu">
						<li>
							<a href="?hal=pengecekan/pendaftaran-pasien/home">
							<i class="fa fa-slack"></i>
								<span>Data Pendaftaran Pasien</span>
							</a>
						</li>
						<li>
							<a href="?hal=pengecekan/pemasukan-obat/home">
							<i class="fa fa-download"></i>
								<span>Data Pemasukan Stock Obat</span>
							</a>
						</li>
						<li>
							<a href="?hal=pengecekan/penjualan-obat/home">
							<i class="fa fa-list-alt"></i>
								<span>Data Penjualan Obat</span>
							</a>
						</li>
						<li>
							<a href="?hal=pengecekan/pembayaran-sukses/home">
							<i class="fa fa-check"></i>
								<span>Data Pembayaran Sukses</span>
							</a>
						</li>
					</ul>
			</li>
			
		<?php
			}
		?>
	</div>
</section>