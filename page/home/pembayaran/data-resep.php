<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Resep&nbsp;</h3>
			<h3 class="box-title">
				<u>
					<?php
						$getidPas = $db->execute("select id_pasien from pendaftaran where no_daftar = :id", array(":id"=>$getCh));
							if ($getidPas->rowCount() > 0) {
								$givIdPas = $getidPas->fetch();
									$getpas = $db->execute("select nama from pasien where id = :id", array(":id"=>$givIdPas["id_pasien"]));
									$givPas = $getpas->fetch();
									echo $givPas["nama"];
							}

					?>
				</u>		
			</h3>
				<?php
					if ($getErm == "error" && $getmsg) {
				?>
					<div class="callout callout-danger">
	                 	<button type="button" class="close" id="close-alert">&times;</button>
	                    maaf <?php echo $getmsg;?> harap tidak dikosongi
	                </div>
				<?php
					}
					if ($getVm == "vali" && $getmsg) {
				?>
					<div class="callout callout-danger">
	                 	<button type="button" class="close" id="close-alert">&times;</button>
	                    maaf <?php echo $getmsg;?> yang anda masukkan tidak seharusnya
	                </div>
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
									<th>Harga</th>
									<th>Dosis</th>
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
											<?php
												$getHa = $db->execute("select harga from obat where id = :id", array(":id"=>$givRes["id_obat"]));
												while ($givHa = $getHa->fetch()) {
													echo $db->duit($givHa["harga"])." / wadah";
												}
											?>
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
										</tr>
								<?php
										}
									}
									if ($gettype == "del" && $getidob) {
										$cekRes = $db->execute("select * from resep where id = :id", array(":id"=>$getid));
										if ($cekRes->rowCount() == 1) {
											$param = array(":id"=>$getid);
											$ins = $db->execute("update resep set id_obat = '', jumlah = '', dosis = '', total = '' where id =:id", $param);
												if ($ins) {
													$db->execute("insert into activity values('', :id, '4', :ket, now())", array(":id"=>$user_sess, ":ket"=>"id obat = ".$getidob." dari id_resep = ".$getid));
													$db->redirect("index.php?act=cek&id=$getid");
												}
										}
										if ($cekRes->rowCount() > 1) {
											$param = array(":id"=>$getid, ":ido"=>$getidob);
											$db->execute("delete from resep where id_obat = :ido and id = :id", $param);
											$db->redirect("index.php?act=cek&id=$getid");
										}
									}
								?>
							</tbody>
						</table>
						<div class="col-md-12">
							<?php
								if (!$getoption == "bayar") {
							?>
								<h1>Total</h1>
									<form method="post">
										<div class="col-md-6">
											<?php
												$getTot = $db->execute("select sum(total) as total from resep where id = :id", array(":id"=>$getid));
												while ($givTot = $getTot->fetch()) {
													$getBi = $db->getResult("select biaya from pendaftaran");
													$givBi = $getBi->fetch();
													$totRes = $givTot["total"] + $givBi['biaya'];
											?>
											<div class="col-md-5">
												<input type="number" name="total" placeholder="Total" class="form-control" value="<?=$totRes?>" readonly style="width: 100%;">
											</div>
											<div class="col-md-6">
												<textarea class="input-biaya" readonly="">+ <?=$givBi['biaya']?> (Biaya daftar+dokter)</textarea>
											</div>
											<?php
												}
											?>
										</div>
										<div class="col-md-3">
											<input type="number" name="bayar" min="0" placeholder="Jumlah Bayar" class="form-control" style="width: 100%;">
										</div>
										<div class="col-md-3">
											<input type="submit" name="btn-bayar" value="Pembayaran" class="btn btn-success btn-flat">
										</div>
									</form>
							<?php
								}
								if ($getoption == "bayar") {
							?>
								<h1>Transaksi Berhasil</h1>
								<div class="col-md-6">
									<?php
												$getTot = $db->execute("select sum(total) as total from resep where id = :id", array(":id"=>$getid));
												while ($givTot = $getTot->fetch()) {
													$getBi = $db->getResult("select biaya from pendaftaran");
													$givBi = $getBi->fetch();
													$totRes = $givTot["total"] + $givBi['biaya'];
									?>
											<div class="col-md-5">
												<label>Total</label>
												<input type="number" name="total" placeholder="Total" class="form-control" value="<?=$totRes?>" readonly style="width: 100%;">
											</div>
											<div class="col-md-6">
												<label>Uang Bayar</label>
												<input type="number" class="form-control" value="<?=$getba?>" readonly style="width: 100%;">
											</div>
								</div>
								<div class="col-md-3">
									<?php
										$kembalian = $getba - $totRes;
									?>
									<label>Kembalian</label>
									<input type="number" readonly class="form-control" value="<?=$kembalian?>" style="width: 100%;">
								</div>
									<?php
												}
									?>
								<div class="col-md-3">
									<a href="index.php?act=cek&id=<?=$getid?>&chg=<?=$getCh?>&opt=selesai&ub=<?=$getub?>">
										<input type="submit" value="Lanjutkan ke Data Pasien" style="margin-top:24px;" class="btn btn-success btn-flat">
									</a>
								</div>
							<?php
								}
							?>
							<?php
								if (isset($POST["btn-bayar"])) {
									extract($POST);
									if ($total != "") {
								        if ($bayar != "") {
								        	if ($bayar > 0 && $bayar > $total || $bayar == $total) {
								        		 $sr = $db->execute("update resep set status_resep = '1' where id = :id", array(":id"=>$getid));
								                    if ($sr) {
								                         $getidp = $db->execute("select id_pasien from pendaftaran where no_daftar = :id", array(":id"=>$getCh));
								                            if ($getidp->rowCount() > 0) {
								                                 $gividp = $getidp->fetch();
								                                 $db->execute("insert into pembayaran values('', :idp, now(), :tot)", array(":idp"=>$gividp["id_pasien"], ":tot"=>$total));
								                                 $getIdo = $db->execute("select id_obat, jumlah from resep where id = :id", array(":id"=>$getid));
								                                 while ($givIdo = $getIdo->fetch()) {
								                                 	$cekIdo = $db->execute("select harga, isi_pemberian, jumlah from obat where id = :id", array(":id"=>$givIdo["id_obat"]));
								                                 		while ($givOb = $cekIdo->fetch()) {
								                                 			$parob = array(":ido"=>$givIdo["id_obat"], ":jum"=>$givIdo["jumlah"], ":har"=>$givOb["harga"], ":isi"=>$givOb["isi_pemberian"]);
								                                 			$insOb = $db->execute("insert into activity_obat values('',:ido, :jum, :har, :isi, '2', now())", $parob);
								                                 			if ($insOb) {
								                                 				$jumlah = $givOb["jumlah"] - $givIdo["jumlah"];
								                                 				$parOb = array(":jum"=>$jumlah, ":id"=>$givIdo["id_obat"]);
								                                 				$db->execute("update obat set jumlah = :jum where id = :id", $parOb);
								                                 				$db->redirect("stroke.php?id=$getid&chg=$getCh&byr=$bayar");
								                                 			}
								                                 		}
								                                 }
								                            }
								                    }
								            }
								            else{
								                $db->validationInput("index.php?act=cek&id=$getid&chg=$getCh", "jumlah uang");
								            }
								        }
								        else{
								            $db->errorInput("index.php?act=cek&id=$getid&chg=$getCh", "uang bayar");
								        }
								    }
								    else{
      									  $db->errorInput("index.php?act=cek&id=$getid&chg=$getCh", "total");
    								}
								}
								if ($getoption == "selesai") {
									$db->execute("update pendaftaran set status_pendaftaran = '4' where no_daftar = :id", array(":id"=>$getCh));
									$db->redirect("index.php");
								}
							?>
						</div>
						<div class="col-md-12" style="margin-bottom:20px;"></div>
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