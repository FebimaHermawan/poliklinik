 	<div class="col-lg-3 col-xs-6">
	    <div class="small-box bg-aqua">
	           	<div class="inner">
		           	<h3>
		           		<?php
		           			$getPas = $db->getResult("select count(id_pasien) as c_p from pendaftaran where date_format(tanggal, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d')");
		           			$givPas = $getPas->fetch();
		           			echo $givPas["c_p"];
		           		?>
		           	</h3>
		            <p>Pendaftaran hari ini</p>
		        </div>
		        <div class="icon">
		        	<i class="fa fa-user"></i>
		        </div>
	        <a class="small-box-footer">&nbsp;</a>
	    </div>
	</div>
	<div class="col-lg-3 col-xs-6">
	    <div class="small-box bg-green">
	           	<div class="inner">
		            <h3>
		            	<?php
		            		$getPem = $db->getResult("select sum(total) as total from pembayaran where date_format(tanggal, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d')");
		            		$givPem = $getPem->fetch();
		            		echo $db->duit($givPem["total"]);
		            	?>	
		            </h3>
		            <p>Pemasukan hari ini</p>
		        </div>
		        <div class="icon">
		        	<i class="fa fa-database"></i>
		        </div>
	        <a class="small-box-footer">&nbsp;</a>
	    </div>
	</div>
	<div class="col-lg-3 col-xs-6">
	    <div class="small-box bg-orange">
	            <div class="inner">
		            <h3>
		            	<?php
		            		$getOb = $db->getResult("select count(id_obat) as obat from activity_obat where status = 2 and date_format(tanggal, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d')");
		            		$givOb = $getOb->fetch();
		            		echo $givOb["obat"];
		            	?>
		            </h3>
		            <p>Obat Terjual hari ini</p>
		        </div>
		        <div class="icon">
		        	<i class="fa fa-cubes"></i>
		        </div>
	        <a class="small-box-footer">&nbsp;</a>
	    </div>
	</div>
	<div class="col-lg-3 col-xs-6">
	    <div class="small-box bg-red">
	            <div class="inner">
		            <h3>
		            	<?php
		            		$getPen = $db->getResult("select count(id) as pembayaran from pembayaran where date_format(tanggal, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d')");
		            		$givPen = $getPen->fetch();
		            		echo $givPen["pembayaran"];
		            	?>
		            </h3>
		            <p>Data Pembayaran Sukses hari ini</p>
		        </div>
		        <div class="icon">
		        	<i class="fa fa-check-square-o"></i>
		        </div>
	        <a class="small-box-footer">&nbsp;</a>
	    </div>
	</div>