<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Resep</h3>
			<a href="index.php?act=cek&id=<?=$getid?>&opt=add&chg=<?=$getCh?>">
				<button class="btn btn-primary btn-flat">Tambah</button>
			</a>
			<?php
				$g = $db->execute("select id_obat from resep where id = :id", array(":id"=>$getid));
				$r = $g->fetch(); 
					if ($g->rowCount() == 1 && $r["id_obat"] == "") {
			?>
							<button class="btn btn-success btn-flat disabled">Lanjutkan ke Apotek</button>

			<?php						
					}
					if ($g->rowCount() > 1 || $g->rowCount() == 1 && $r["id_obat"] != "") {
			?>
						<a href="index.php?act=cek&id=<?=$getid?>&chg=<?=$getCh?>&type=acc">
							<button class="btn btn-success btn-flat">Lanjutkan ke Apotek</button>
						</a>
			<?php		
					}
			?>
			
		</div>
		<div class="box-body">
			<div id="example_wrapper1" class="dataTables_wrapper form-inline dt-bootstrap">
				<div class="row">
					<div class="col-sm-12">
						<table id="data-table" class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Obat</th>
									<th>Jumlah</th>
									<th>Dosis</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 0;
									$getRes = $db->execute("select * from resep where id = :id", array(":id"=>$getid));
									while ($givRes = $getRes->fetch()) {
									$no++;
										if ($givRes["id_obat"] != "") {
								?>
										<tr>
											<td><?=$no?></td>
											<td>
												<?php
													$getNmOb = $db->execute("select nama from obat where id = :id", array(":id"=>$givRes["id_obat"]));
													while ($givNmOb = $getNmOb->fetch()) {
														echo $givNmOb["nama"];
													}
												?>
											</td>
											<td>
												<?=$givRes["jumlah"]?>&nbsp;/&nbsp;wadah
											</td>
											<td>
												<?=$givRes["dosis"]?>&nbsp;
												<?php
													$jenOb = $db->execute("select jenis from obat where id = :id", array(":id"=>$givRes["id_obat"]));
													$rowJen = $jenOb->fetch();
														if ($rowJen["jenis"] == 1) {
															echo "Pil";
														}
														if ($rowJen["jenis"] == 2) {
															echo "Tablet";
														}
														if ($rowJen["jenis"] == 3) {
															echo "Puyer";
														}
														if ($rowJen["jenis"] == 4) {
															echo "Sirup";
														}
												?>&nbsp;/ hari
											</td>
											<td>
												<a href="index.php?act=cek&id=<?=$getid?>&opt=ed&chg=<?=$getCh?>&ido=<?=$givRes['id_obat']?>">
													<button class="btn btn-primary btn-flat">Edit</button>
												</a>
												<a href="index.php?act=cek&id=<?=$getid?>&type=del&ido=<?=$givRes['id_obat']?>&chg=<?=$getCh?>" onclick="return confirm('Yakin ingin hapus?')">
													<button class="btn btn-info btn-flat">Hapus</button>
												</a>
											</td>
										</tr>
								<?php
										}
									}
									if ($gettype == "del" && $getidob) {
										$cekRes = $db->execute("select * from resep where id = :id", array(":id"=>$getid));
										if ($cekRes->rowCount() == 1) {
											$param = array(":id"=>$getid);
											$db->execute("update resep set id_obat = '', jumlah = '', dosis = '', total = '' where id =:id", $param);
											$db->redirect("index.php?act=cek&id=$getid&chg=$getCh");
										}
										if ($cekRes->rowCount() > 1) {
											$param = array(":id"=>$getid, ":ido"=>$getidob);
											$db->execute("delete from resep where id_obat = :ido and id = :id", $param);
											$db->redirect("index.php?act=cek&id=$getid&chg=$getCh");
										}
									}
									if ($getact == "cek" && $getid && $gettype == "acc" && $getCh) {
										$db->execute("update pendaftaran set status_pendaftaran = '2' where no_daftar = :id", array(":id"=>$getCh));
										$db->redirect("index.php");
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