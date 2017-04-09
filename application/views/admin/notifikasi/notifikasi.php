<!-- This is what you need -->
<link rel="stylesheet" href="<?php echo base_url(); ?>aset/sweet-alert/example/button.css">
<script src="<?php echo base_url(); ?>aset/sweet-alert/dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>aset/sweet-alert/dist/sweetalert.css">
<!--.......................-->

<script>
	// A $( document ).ready() block.
	$( document ).ready(function() {
		var countSuratMasukNotReported = <?= $countSuratMasukNotReported?>;
		var countSuratBelumDisposisi = <?= $countSuratBelumDisposisi?>;
	var text=
	"Ada " +countSuratBelumDisposisi+ " surat yang belum disposisi \n"  +
	"Ada " +countSuratMasukNotReported+ " surat yang belum ada laporan ";
	
		swal({
			title: "Perhatian!",
			text: text,
			type: "warning",
			showConfirmButton: true
		});
	});
	
</script>
