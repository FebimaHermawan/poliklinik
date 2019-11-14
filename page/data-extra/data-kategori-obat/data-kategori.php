<div class="col-md-6">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Kategori Obat</h3>
			<a href="?hal=data-extra/home&act=kategoriobat&name=Kategori Obat&pr=print">
				<button class="btn btn-primary btn-flat pull-right"><i class="fa fa-print"></i>&nbsp;Print</button>
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
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 0;
									$getKob = $db->getResult("select * from kategori_obat");
									while ($givKOb = $getKob->fetch()) {
									$no++;
								?>
								<tr>
									<td><?=$no?></td>
									<td><?=$givKOb["nama"]?></td>
									<td>
										<a href="?hal=data-extra/home&act=kategoriobat&name=Kategori Obat&opt=ed&id=<?=$givKOb['id']?>">
											<button class="btn btn-primary btn-flat">Edit</button>
										</a>
										<a href="?hal=data-extra/home&act=kategoriobat&name=Kategori Obat&type=del&id=<?=$givKOb['id']?>" onclick="return confirm('Yakin ingin hapus?')">
											<button class="btn btn-info btn-flat">Hapus</button>
										</a>
									</td>
								</tr>
								<?php
									}
									if ($getact && $gettype == "del" && $getid) {
										
										$db->execute("delete from kategori_obat where id= :id",array(":id" => $getid));
										$db->redirect("?hal=data-extra/home&act=kategoriobat&name=Kategori Obat");
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