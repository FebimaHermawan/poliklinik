<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
					<center>
					<div class="box-header">
						<h3 class="box-title">Data Obat</h3>
						<h5><b>Mulai dari : <?=$getsd?> &nbsp;-&nbsp; Hingga : <?=$getfd?></b></h5>
					</div>
					<div class="box-body">
						<table class="table-print">
							<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Jenis Obat</th>
									<th>Kategori Obat</th>
									<th>Harga</th>
									<th>Jumlah</th>
									<th>Isi Tiap Wadah</th>
							</tr>
							<?php
									$no = 0;
									$getOb = $db->getResult("select * from obat");
									while ($givOb = $getOb->fetch()) {
									$no++;
							?>
							<tr>
									<td><?=$no?></td>
									<td><?=$givOb["nama"]?></td>
									<td>
										<?php
											if ($givOb["jenis"] == 1) {
												echo "Pil";
											}
											if ($givOb["jenis"] == 2) {
												echo "Tablet";
											}
											if ($givOb["jenis"] == 3) {
												echo "Puyer";
											}
											if ($givOb["jenis"] == 4) {
												echo "Sirup";
											}
										?>
									</td>
									<td>
									<?php
											$getKOb = $db->execute("select nama from kategori_obat where id = :id", array(":id"=>$givOb["kategori"]));
											while ($givKOb = $getKOb->fetch()) {
												echo $givKOb["nama"];
											}
									?>	
									</td>
									<td><?=$givOb["harga"]?></td>
									<td><?=$givOb["jumlah"]?></td>
									<td><?=$givOb["isi_pemberian"]?></td>
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