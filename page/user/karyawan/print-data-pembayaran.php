<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
					<center>
					<div class="box-header">
						<h3 class="box-title">Data Karyawan Pembayaran</h3>
					</div>
					<div class="box-body">
						<table class="table-print">
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Telepon</th>
								<th>Alamat</th>
							</tr>
							<?php
								$no = 0;
									$getAd = $db->getResult("select * from user where status = 4");
									while ($givAd = $getAd->fetch()) {
									$no++;
							?>
							<tr>
								<td><?=$no?></td>
								<td><?=$givAd["nama"]?></td>
								<td><?=$givAd["telepon"]?></td>
								<td><?=$givAd["alamat"]?></td>
							</tr>
							<?php
								}
							?>
						</table>
					</div>
				</center>
			</div>
		</div>
	</div>
</div>
		<script type="text/javascript">
			window.print();
		</script>