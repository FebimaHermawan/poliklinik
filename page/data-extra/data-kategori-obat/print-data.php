<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
					<center>
					<div class="box-header">
						<h3 class="box-title">Data Poli</h3>
						<h5><b>Mulai dari : <?=$getsd?> &nbsp;-&nbsp; Hingga : <?=$getfd?></b></h5>
					</div>
					<div class="box-body">
						<table class="table-print">
							<tr>
									<th>No</th>
									<th>Nama</th>
							</tr>
							<?php
									$no = 0;
									$getKob = $db->getResult("select * from kategori_obat");
									while ($givKOb = $getKob->fetch()) {
									$no++;
							?>
							<tr>
									<td><?=$no?></td>
									<td><?=$givKOb["nama"]?></td>
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