<div class="col-md-6">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Poli</h3>
			<a href="?hal=data-extra/home&act=poli&name=Poli&opt=ad&pr=print">
				<button class="btn btn-primary btn-flat pull-right"><i class="fa fa-print"></i>&nbsp;Print</button>
			</a>
		</div>	
		<div class="box-body">
			<div id="example_wrapper1" class="dataTables_wrapper form-inline dt-bootstrap">
				<div class="row">
					<div class="col-sm-12">
						<table id="data-poli" class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Dokter</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
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
									<td>
										<a href="?hal=data-extra/home&act=poli&opt=ed&id=<?=$givPol['id']?>">
											<button class="btn btn-primary btn-flat">Edit</button>
										</a>
										<a href="?hal=data-extra/home&act=poli&opt=ad&type=del&id=<?=$givPol['id']?>" onclick="return confirm('Yakin ingin hapus?')">
											<button class="btn btn-info btn-flat">Hapus</button>
										</a>
									</td>
								</tr>
								<?php
									}
									if ($getact && $gettype == "del" && $getid) {
										$db->execute("delete from poli where id = :id", array(":id"=>$getid));
										$db->redirect("?hal=data-extra/home&act=poli&opt=ad");
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
			$("#data-poli").DataTable();
		});
</script>