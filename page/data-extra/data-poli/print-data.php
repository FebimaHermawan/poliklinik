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
									<th>Dokter</th>
							</tr>
							<?php
									$no = 0;
									$getPol = $db->getResult("select * from poli");
									while ($givPol = $getPol->fetch()) {
									$no++;
							?>
							<tr>
									<td><?=$no?></td>
									<td><?=$givPol["nama"]?></td>
									<td>
										<?php
											$dok = $db->execute("select nama from user where id = :id", array(":id"=>$givPol["id_dokter"]));
											while ($rowDok = $dok->fetch()) {
												echo $rowDok["nama"];
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