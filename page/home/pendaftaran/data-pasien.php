<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Pasien Daftar</h3>
			<a href="index.php?act=add">
				<button class="btn btn-primary btn-flat">Tambah</button>
			</a>
			<a href="?hal=user/home&act=pasien&name=Pasien">
				<button class="btn btn-info btn-flat">Register</button>
			</a>
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
									$getpen = $db->getResult("select * from pendaftaran where date_format(tanggal, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d')");
									while ($givPen = $getpen->fetch()) {
									$no++;
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
											if ($givPen["status_pendaftaran"] == 1) {
										?>
											<a href="index.php?act=ed&id=<?=$givPen['no_daftar']?>">
												<button class="btn btn-primary btn-flat">Edit</button>
											</a>
											<a href="index.php?act=del&id=<?=$givPen['no_daftar']?>" onclick="return confirm('Yakin ingin hapus?')">
												<button class="btn btn-info btn-flat">Hapus</button>
											</a>
										<?php
											}
											else{
										?>
											<button class="btn btn-primary btn-flat disabled">Edit</button>
											<button class="btn btn-info btn-flat disabled">Hapus</button>
										<?php
											}
										?>
									</td>
								</tr>
								<?php
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