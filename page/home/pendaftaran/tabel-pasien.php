<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Pasien Daftar</h3>
			<a href="">
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
									<th>Alamat</th>
									<th>Telepon</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 0;
									$getPas = $db->getResult("select * from pasien");
									while ($givPas = $getPas->fetch()) {
									$no++;
								?>
									<tr>
										<td><?=$no?></td>
										<td><?=$givPas["nama"]?></td>
										<td><?=$givPas["umur"]?></td>
										<td><?=$givPas["gender"]?></td>
										<td><?=$givPas["alamat"]?></td>
										<td><?=$givPas["telepon"]?></td>
										<td>
											<a href="index.php?act=add&id=<?=$givPas['id']?>">
												<button class="btn btn-success btn-flat">Daftarkan Pasien</button>
											</a>
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