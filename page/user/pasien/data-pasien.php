<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Pasien</h3>
			<a href="?hal=user/home&act=add&name=Pasien&type=pasien">
				<button class="btn btn-primary btn-flat">Tambah</button>
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
									<th>Nama</th>
									<th>Umur</th>
									<th>Gender</th>
									<th>Telepon</th>
									<th>Alamat</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 0;
									$getPas = $db->getResult("select * from pasien order by nama asc");
									while ($givPas = $getPas->fetch()) {
									$no++;
								?>
								<tr>
									<td><?=$no?></td>
									<td><?=$givPas["nama"]?></td>
									<td><?=$givPas["umur"]?></td>
									<td><?=$givPas["gender"]?></td>
									<td><?=$givPas["telepon"]?></td>
									<td><?=$givPas["alamat"]?></td>
									<td>
										<?php
											if ($user_stat == 0 || $user_stat == 3) {
										?>
											<a href="?hal=user/home&opt=ed&id=<?=$givPas['id']?>&type=pasien">
												<button class="btn btn-primary btn-flat">Edit</button>
											</a>
											<a href="?hal=user/home&act=pasien&opt=del&id=<?=$givPas['id']?>" onclick="return confirm('Yakin ingin hapus?')">
												<button class="btn btn-info btn-flat">Hapus</button>
											</a>
										<?php
											}
										?>
									</td>
								</tr>
								<?php
									}
									if ($getact && $getoption == "del" && $getid) {
										$db->execute("delete from pasien where id = :id", array(":id"=>$getid));
										$db->redirect("?hal=user/home&act=pasien");
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