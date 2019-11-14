 <div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Resep</h3>
			<?php
				if ($getVm == "vali" && $getmsg) {
			?>
				<div class="callout callout-danger">
                 	<button type="button" class="close" id="close-alert">&times;</button>
                    maaf <?php echo $getmsg;?> tidak dapat memproses karena masih ada obat yang belum diambil, silahkan ambil obat dahulu atau menghapusnya
                </div>
			<?php
				}
			?>
			<?php
				$g = $db->execute("select id_obat from resep where id = :id", array(":id"=>$getid));
				$r = $g->fetch(); 
					if ($g->rowCount() == 1 && $r["id_obat"] == "") {
			?>
							<button class="btn btn-success btn-flat disabled">Lanjutkan ke pembayaran</button>

			<?php						
					}
					if ($g->rowCount() > 1 || $g->rowCount() == 1 && $r["id_obat"] != "") {
			?>
						<a href="index.php?act=cek&id=<?=$getid?>&chg=<?=$getCh?>&opt=next">
							<button class="btn btn-success btn-flat">Lanjutkan ke pembayaran</button>
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
												<?=$givRes["jumlah"]?>&nbsp;
											</td>
											<td>
												<?=$givRes["dosis"]?>&nbsp;
												<?php
													$jenOb = $db->execute("select jenis from obat where id = :id", array(":id"=>$givRes["id_obat"]));
													while ($rowJen = $jenOb->fetch()) {
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
													}
												?>&nbsp;/ hari
											</td>
											<?php
												if ($givRes["status_obat"] == 0) {
											?>
											<td>
												<a href="index.php?act=cek&id=<?=$getid?>&opt=done&ido=<?=$givRes['id_obat']?>&chg=<?=$getCh?>">
													<button class="btn btn-success btn-flat">Selesai</button>
												</a>
												<a href="index.php?act=cek&id=<?=$getid?>&opt=ed&ido=<?=$givRes['id_obat']?>&chg=<?=$getCh?>">
													<button class="btn btn-primary btn-flat">Edit</button>
												</a>
												<a href="index.php?act=cek&id=<?=$getid?>&opt=del&chg=<?=$getCh?>&ido=<?=$givRes['id_obat']?>" onclick="return confirm('Yakin ingin hapus?')">
													<button class="btn btn-info btn-flat">Hapus</button>
												</a>
											</td>
											<?php
												}
												if ($givRes["status_obat"] == 1) {
											?>
											<td><i class="fa fa-check"></i> Success</td>
											<?php
												}
												if ($getoption == "del" && $getidob) {
													$p = array(":idr"=>$getid, ":idp"=>$getCh);
													$cekRes = $db->execute("select * from resep where id = :idr and id_pendaftaran = :idp", $p);
													if ($cekRes->rowCount() > 1) {
														$delOb = $db->execute("delete from resep where id = :id and id_obat = :ido", array(":id"=>$getid, ":ido"=>$getidob));
															if ($delOb) {
																$db->execute("insert into activity values('', :id, '4', :ket, now())", array(":id"=>$user_sess, ":ket"=>"id obat =  ".$getidob." dari resep"));
																$db->redirect("index.php?act=cek&id=$getid&chg=$getCh");
															}
													}
													if ($cekRes->rowCount() == 1) {
														$delOb = $db->execute("update resep set id_obat = '', jumlah = '', dosis = '', total = '' where id = :id and id_obat = :ido", array(":id"=>$getid, ":ido"=>$getidob));
															if ($delOb) {
																$db->execute("insert into activity values('', :id, '4', :ket, now())", array(":id"=>$user_sess, ":ket"=>"id obat =  ".$getidob." dari resep"));
																$db->redirect("index.php?act=cek&id=$getid&chg=$getCh");
															}
													}	
												}
												if ($getoption == "done" && $getidob && $getCh) {
													$param = array(":ido"=>$getidob, ":id"=>$getid);
													$db->execute("update resep set status_obat = 1 where id_obat = :ido and id = :id", $param);
													$db->redirect("index.php?act=cek&id=$getid&chg=$getCh");
												}
												if ($getoption == "next") {
													$cekOb = $db->execute("select status_obat from resep where id = :id", array(":id"=>$getid));
													while ($valOb = $cekOb->fetch()) {
													 	if ($valOb["status_obat"] != 0) {
													 			$db->execute("update pendaftaran set status_pendaftaran = '3' where no_daftar = :ndf", array(":ndf"=>$getCh));
													 			$db->redirect("index.php");
													 	}
													 	else{
													 			$db->validationInput("index.php?act=cek&id=$getid&chg=$getCh", "tombol");
													 	}
													 } 
												}
											?>
										</tr>
								<?php
										}
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