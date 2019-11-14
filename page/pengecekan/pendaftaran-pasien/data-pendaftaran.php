<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Pasien Daftar</h3>
		</div>
		<div class="box-body">
			<div id="example_wrapper1" class="dataTables_wrapper form-inline dt-bootstrap">
				<div class="row">
					<div class="col-md-12" style="margin-bottom: 25px;">
						<?php
							if ($getErm == "error" && $getmsg) {
						?>
							<div class="callout callout-danger">
			                 	<button type="button" class="close" id="close-alert">&times;</button>
			                    maaf <?php echo $getmsg;?> harap tidak dikosongi
			                </div>
						<?php
							}
						?>
						<form method="post" class="pull-left">
								<label>Tanggal Mulai </label>
								<input type="date" class="form-control" name="sd">
								<label>Tanggal Selesai </label>
								<input type="date" class="form-control" name="fd">
								<button type="submit" name="print" class="btn btn-primary btn-flat"><i class="fa fa-print"></i>&nbsp;Print</button>
								<label style="font-weight: 100;">&nbsp;Atau&nbsp;</label>
						</form>
						<a href="index.php?hal=pengecekan/pendaftaran-pasien/home&act=print">
							<button type="submit" name="print" class="btn btn-info btn-flat pull-left"><i class="fa fa-print"></i>&nbsp;PrintAll</button>
						</a>
						<?php
							if (isset($POST["print"])) {
								extract($POST);
									if ($sd != "") {
										if ($fd != "") {
											$db->redirect("index.php?hal=pengecekan/pendaftaran-pasien/home&act=print&sd=$sd&fd=$fd");
										}
										else{
											$db->errorInput("?hal=pengecekan/pendaftaran-pasien/home", "tanggal selesai print");
										}
									}
									else{
										$db->errorInput("?hal=pengecekan/pendaftaran-pasien/home", "tanggal mulai print");
									}
							}
						?>
					</div>
					<div class="col-sm-12">
						<table id="data-table" class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Pasien</th>
									<th>Poli</th>
									<th>Tanggal</th>
									<th>Keluhan</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 0;
									$getpen = $db->getResult("select * from pendaftaran order by tanggal desc");
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