<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Kategori Obat</h3>
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
									<th>Jenis Obat</th>
									<th>Kategori Obat</th>
									<th>Harga</th>
									<th>Jumlah</th>
									<th>Isi Tiap Wadah</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 0;
									$getOb = $db->getResult("select * from obat");
									while ($givOb = $getOb->fetch()) {
									$no++;
								?>
								<tr>
									<td><?=$no?></td>
									<td><?=$givOb["nama"]?></td>
									<td>
										<?php
											if ($givOb["jenis"] == 1) {
												echo "Pil";
											}
											if ($givOb["jenis"] == 2) {
												echo "Tablet";
											}
											if ($givOb["jenis"] == 3) {
												echo "Puyer";
											}
											if ($givOb["jenis"] == 4) {
												echo "Sirup";
											}
										?>
									</td>
									<td>
									<?php
											$getKOb = $db->execute("select nama from kategori_obat where id = :id", array(":id"=>$givOb["kategori"]));
											while ($givKOb = $getKOb->fetch()) {
												echo $givKOb["nama"];
											}
									?>	
									</td>
									<td><?=$givOb["harga"]?></td>
									<td><?=$givOb["jumlah"]?></td>
									<td><?=$givOb["isi_pemberian"]?></td>
									<td>
										<a href="index.php?act=cek&id=<?=$getid?>&opt=ed&ido=<?=$getidob?>&chg=<?=$getCh?>&edo=<?=$givOb['id']?>">
											<button class="btn btn-primary btn-flat">Ganti dengan ini</button>
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