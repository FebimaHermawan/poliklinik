<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Obat Masuk</h3>
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
						<a href="?hal=pengecekan/pemasukan-obat/home&act=print">
							<button type="submit" name="print" class="btn btn-info btn-flat pull-left"><i class="fa fa-print"></i>&nbsp;PrintAll</button>
						</a>
						<?php
							if (isset($POST["print"])) {
								extract($POST);
									if ($sd != "") {
										if ($fd != "") {
											$db->redirect("?hal=pengecekan/pemasukan-obat/home&act=print&sd=$sd&fd=$fd");
										}
										else{
											$db->errorInput("?hal=pengecekan/pemasukan-obat/home", "tanggal selesai print");
										}
									}
									else{
										$db->errorInput("?hal=pengecekan/pemasukan-obat/home", "tanggal mulai print");
									}
							}
						?>
					</div>
					<div class="col-sm-12">
						<table id="data-table" class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Obat</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Isi Tiap Wadah</th>
									<th>Tanggal</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 0;
									$getob = $db->getResult("select * from activity_obat where status = '1' order by tanggal desc");
									while ($givob = $getob->fetch()) {
									$no++;
								?>
								<tr>
									<td><?=$no?></td>
									<td>
										<?php
											$getNmOb = $db->execute("select nama from obat where id = :id", array(":id"=>$givob["id_obat"]));
											$givNmOb = $getNmOb->fetch();
											echo $givNmOb["nama"];
										?>
									</td>
									<td><?=$givob["jumlah"]?></td>
									<td><?php echo $db->duit($givob["harga"]);?></td>
									<td><?=$givob["isi"]?></td>
									<td><?=$givob["tanggal"]?></td>
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