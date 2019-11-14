<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Apoteker</h3>
			<a href="?hal=user/home&act=add&name=Apoteker&type=apoteker">
				<button class="btn btn-primary btn-flat">Tambah</button>
			</a>
			<a href="?hal=user/home&act=karyawan&name=Karyawan&pr=printAp">
				<button class="btn btn-primary btn-flat pull-right"><i class="fa fa-print"></i>&nbsp;Print</button>
			</a>
		</div>
		<div class="box-body">
			<div id="example_wrapper1" class="dataTables_wrapper form-inline dt-bootstrap">
				<div class="row">
					<div class="col-sm-12">
						<table id="data-apoteker" class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Telepon</th>
									<th>Alamat</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 0;
									$getApo = $db->getResult("select * from user where status = '2' order by nama asc");
									while ($givApo = $getApo->fetch()) {
									$no++;
								?>
								<tr>
									<td><?=$no?></td>
									<td><?=$givApo["nama"]?></td>
									<td><?=$givApo["telepon"]?></td>
									<td><?=$givApo["alamat"]?></td>
									<td>
										<a href="?hal=user/home&opt=ed&id=<?=$givApo['id']?>&type=karyawan">
											<button class="btn btn-primary btn-flat">Edit</button>
										</a>
										<a href="?hal=user/home&act=karyawan&opt=del&id=<?=$givApo['id']?>" onclick="return confirm('Yakin ingin hapus?')">
											<button class="btn btn-info btn-flat">Hapus</button>
										</a>
									</td>
								</tr>
								<?php
									}
									if ($getact && $getoption == "del" && $getid) {
										$db->execute("delete from user where id = :id", array(":id"=>$getid));
										$db->redirect("?hal=user/home&act=karyawan");
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
			$("#data-apoteker").DataTable();
		});
	</script>