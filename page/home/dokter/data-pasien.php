<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Pasien Daftar</h3>
		</div>
		<div class="box-body">
			<div id="example_wrapper1" class="dataTables_wrapper form-inline dt-bootstrap">
				<div class="row">
					<div class="col-sm-12">
						<table id="data-table" class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Pasien</th>
									<th>Poli</th>
									<th>Keluhan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 0;
									$getpen = $db->getResult("select * from pendaftaran where no_daftar in (select id_pendaftaran from resep where date_format(tanggal, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d'))");
									while ($givPen = $getpen->fetch()) {
									$no++;
										if ($givPen["status_pendaftaran"] == 1 && $givPen["id_poli"] == $user_poli) {
								?>
								<tr>
									<td><?=$no?></td>
									<td>
										<?php
											$getNmPas = $db->execute("select nama from pasien where id = :id", array(":id"=>$givPen["id_pasien"]));
											while ($givNmPas = $getNmPas->fetch()) {
												echo $givNmPas["nama"];
											}
										?>
									</td>
									<td>
										<?php
											$getNmPl = $db->execute("select nama from poli where id = :id", array(":id"=>$givPen["id_poli"]));
											while ($givNmPl = $getNmPl->fetch()) {
												echo $givNmPl["nama"];
											}
										?>
									</td>
									<td>
										<?=$givPen["keterangan"]?>
									</td>
									<td>
										<?php
											$cekRes = $db->execute("select id from resep where id_pendaftaran = :idp", array("idp"=>$givPen["no_daftar"]));
											$valRes = $cekRes->fetch();
										?>
										<a href="index.php?act=cek&id=<?=$valRes['id']?>&chg=<?=$givPen['no_daftar']?>">
											<button class="btn btn-primary btn-flat">Cek</button>
										</a>
									</td>
								</tr>
								<?php
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
		$(function(){
			$("#data-table").DataTable();
		});
	</script>