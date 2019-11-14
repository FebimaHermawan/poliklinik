<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
					<center>
					<div class="box-header">
						<h3 class="box-title">Data Pendaftaran</h3>
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
								<th style="width:18%;">Poli</th>
								<th style="width:18%;">Tanggal</th>
								<th style="width:18%;">Keluhan</th>
								<th style="width:18%;">Status</th>
							</tr>
							<?php
								$no = 0;
								if ($getsd && $getfd) {
									$param = array(":sd"=>$getsd, ":fd"=>$getfd);
									$getPen = $db->execute("select * from pendaftaran where tanggal between :sd and :fd", $param);
								}
								if (!$getsd && !$getfd) {
									$getPen = $db->getResult("select * from pendaftaran");
								}
								while ($givPen = $getPen->fetch()) {
								$no++;
							?>
							<tr>
								<td><?=$no?></td>
								<td>
									<?php
										$getNam = $db->execute("select nama from pasien where id = :id", array(":id"=>$givPen["id_pasien"]));
										while ($givNam = $getNam->fetch()) {
											echo $givNam["nama"];
										}
									?>
								</td>
								<td>
									<?php
										$getPol = $db->execute("select nama from poli where id = :id", array(":id"=>$givPen["id_poli"]));
										while ($givPol = $getPol->fetch()) {
											echo $givPol["nama"];
										}
									?>
								</td>
								<td>
									<?=$givPen["tanggal"]?>
								</td>
								<td>
									<?=$givPen["keterangan"]?>
								</td>
								<td>
									<?php
										if ($givPen["status_pendaftaran"] == "4") {
											echo "berhasil";
										}
										else{
											echo "proses";
										}
									?>
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