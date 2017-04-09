<div class="navbar navbar-inverse navJudul">
	<div class="container">
		<div class="navbar-header"> <span class="navbar-brand" href="#">Laporan Berdasarkan Sifat Surat</span> </div>
	</div>
	<!-- /.container -->
</div>
<!-- /.navbar -->
<div class="well">
	<form action="<?php echo base_URL(); ?>laporan/sifat_surat_cetak" target="blank" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<input type="hidden" name="tipe" value="<?php echo $this->uri->segment(2); ?>">
		<table class="table-form" width="100%">
			<tr>
				<td width="20%">Sifat Surat</td>
				<td>
					<select name="sifat_surat" class="col-md-6" required>
						<option value="">--Pilih--</option>
						<?php foreach ($ref_sifat_surat as $ref_sifat_surat) { ?>
							<option
								value="<?php echo $ref_sifat_surat->deskripsi ?>" <?php echo $ref_sifat_surat->deskripsi == $status_surat_masuk ? 'selected' : ''; ?>>
								<?php echo $ref_sifat_surat->deskripsi ?>
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
