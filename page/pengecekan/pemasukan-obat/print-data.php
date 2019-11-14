<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
					<center>
					<div class="box-header">
						<h3 class="box-title">Data Pemasukan Obat</h3>
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
								<th style="width:18%;">Jumlah</th>
								<th style="width:18%;">Harga</th>
								<th style="width:18%;">Isi</th>
								<th style="width:18%;">tanggal</th>
							</tr>
							<?php
								$no = 0;
								if ($getsd && $getfd) {
									$param = array(":sd"=>$getsd, ":fd"=>$getfd);
									$getPob = $db->execute("select * from activity_obat where tanggal between :sd and :fd and status = 1", $param);
								}
								if (!$getsd && !$getfd) {
									$getPob = $db->getResult("select * from activity_obat where status = 1");
								}
								while ($givPob = $getPob->fetch()) {
								$no++;
							?>
							<tr>
								<td><?=$no?></td>
								<td>
									<?php
										$getNam = $db->execute("select nama from obat where id = :id", array(":id"=>$givPob["id_obat"]));
										while ($givNam = $getNam->fetch()) {
											echo $givNam["nama"];
										}
									?>
								</td>
								<td><?=$givPob["jumlah"]?></td>
								<td><?php echo $db->duit($givPob["harga"]);?></td>
								<td><?=$givPob["isi"]?></td>
								<td><?=$givPob["tanggal"]?></td>
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