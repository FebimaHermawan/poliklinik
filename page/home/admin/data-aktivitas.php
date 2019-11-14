<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Aktivitas</h3>
		</div>
		<div class="box-body">
			<div id="example_wrapper1" class="dataTables_wrapper form-inline dt-bootstrap">
				<div class="row">
					<div class="col-sm-12">
						<table id="data-table" class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama User</th>
									<th>Tanggal</th>
									<th>Type</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 0;
									$getAc = $db->getResult("select * from activity order by tanggal desc");
									while ($givAc = $getAc->fetch()) {
									$no++;
								?>
								<tr>
									<td><?=$no?></td>
									<td>
										<?php
											$getNmUser = $db->execute("select nama from user where id = :id", array(":id"=>$givAc["id_user"]));
											while ($givNmUser = $getNmUser->fetch()) {
												echo $givNmUser["nama"];
											}
										?>
									</td>
									<td><?=$givAc["tanggal"]?></td>
									<td>
										<?php
											if ($givAc["type"] == 1) {
												echo "Login";
											}
											if ($givAc["type"] == 2) {
												echo "Tambah";
											}
											if ($givAc["type"] == 3) {
												echo "Edit";
											}
											if ($givAc["type"] == 4) {
												echo "Hapus";
											}
										?>
									</td>
									<td>
										<?=$givAc["keterangan"]?>
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