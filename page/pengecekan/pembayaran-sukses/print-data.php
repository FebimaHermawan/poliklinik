<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<center>
					<div class="box-header">
						<h3 class="box-title">Data Pembayaran</h3>
						<h5>
							<?php
								if ($getsd && $getfd) {
							?>
								<b>Mulai dari : <?=$getsd?> &nbsp;-&nbsp; Hingga : <?=$getfd?></b>
							<?php
								}
								if (!$getsd && !$getfd) {
							?>
								<b>Semua Data</b>
							<?php
								}
							?>
						</h5>
					</div>
					<div class="box-body">
						<table class="table-print">
							<tr>
								<th style="width:10%;">No</th>
								<th style="width:18%;">Nama</th>
								<th style="width:18%;">Tanggal</th>
								<th style="width:18%;">Total</th>
							</tr>
							<?php
								$no = 0;
								if ($getsd && $getfd) {
									$param = array(":sd"=>$getsd, ":fd"=>$getfd);
									$getPem = $db->execute("select * from pembayaran where tanggal between :sd and :fd", $param);
								}
								if (!$getsd && !$getfd) {
									$getPem = $db->getResult("select * from pembayaran");
								}
								while ($givPem = $getPem->fetch()) {
								$no++;
							?>
							<tr>
								<td><?=$no?></td>
								<td>
									<?php
										$getNam = $db->execute("select nama from pasien where id = :id", array(":id"=>$givPem["id_pasien"]));
										while ($givNam = $getNam->fetch()) {
											echo $givNam["nama"];
										}
									?>
								</td>
								<td><?=$givPem["tanggal"]?></td>
								<td>
									<?php echo $db->duit($givPem["total"])?>
								</td>
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