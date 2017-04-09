<div class="navbar navbar-inverse navJudul">
	<div class="container">
		<div class="navbar-header"> <span class="navbar-brand" href="#">Laporan Berdasarkan Kategori Intruksi</span> </div>
	</div>
	<!-- /.container -->
</div>
<!-- /.navbar -->
<div class="well">
	<form action="<?php echo base_URL(); ?>laporan/kategori_intruksi_cetak" target="blank" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<input type="hidden" name="tipe" value="<?php echo $this->uri->segment(2); ?>">
		<table class="table-form" width="100%">
			<tr>
				<td width="20%">Kategori Intruksi</td>
				<td>
					<select name="kode_intruksi" class="col-md-6" required>
						<option value="">--Pilih--</option>
						<?php
						$kode_intruksi_all = array('1' => 'Tidak Ada Laporan', '2' => 'Ada Laporan');
						foreach ($kode_intruksi_all as $key => $value ) { ?>
							<option value="<?php echo $key ?>" <?php echo $key == $kode_intruksi ? 'selected' : ''; ?>>
								<?php echo $value ?>
							</option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="20%">Dari Tanggal</td>
				<td><b><input type="text" name="tgl_start" id="tgl_start" class="form-control" style="width: 150px" required></b></td>
			</tr>
			<tr>
				<td width="20%">Sampai Tanggal</td>
				<td><b><input type="text" name="tgl_end" id="tgl_end" class="form-control" style="width: 150px"  required></b></td>
			</tr>
		</table>
		</fieldset>
		<div class="row ">
			<div class="col-lg-12">
				<div class="right mt25"> <a href="<?php echo base_URL(); ?>admin" class="btn btn-success" tabindex="11"><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
					<button type="submit" class="btn btn-primary"> <i class="icon icon-print icon-white"></i> Cetak </button>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
$(function() {
	$( "#tgl_start" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd'
	});
	$( "#tgl_end" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd'
	});
});
</script>
