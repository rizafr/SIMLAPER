<?php
	$q_instansi	= $this->db->query("SELECT * FROM tr_instansi LIMIT 1")->row();
	$q_aplikasi	= $this->db->query("SELECT * FROM t_aplikasi LIMIT 1")->row();
	$notif = array(
		'countSuratMasukNotReported' => $countSuratMasukNotReported,
		'countSuratBelumDisposisi' => $countSuratBelumDisposisi,
	);
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <head>
		<title><?= $q_aplikasi->name; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<style type="text/css">
			@font-face {
			font-family: 'Cabin';
			font-style: normal;
			font-weight: 400;
			src: local('Cabin Regular'), local('Cabin-Regular'), url(<?php echo base_url(); ?>aset/font/satu.woff) format('woff');
			}
			@font-face {
			font-family: 'Cabin';
			font-style: normal;
			font-weight: 700;
			src: local('Cabin Bold'), local('Cabin-Bold'), url(<?php echo base_url(); ?>aset/font/dua.woff) format('woff');
			}
			@font-face {
			font-family: 'Lobster';
			font-style: normal;
			font-weight: 400;
			src: local('Lobster'), url(<?php echo base_url(); ?>aset/font/tiga.woff) format('woff');
			}	
			
		</style>
		<link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/bootstrap.css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/bootstrap-reset.css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/owl.carousel.css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/animate.css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/style.css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>aset/js/jquery/jquery-ui-1.10.1.custom.css" />	
		<link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/step.css" media="screen">
		<link href="<?php echo base_url(); ?>aset/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>aset/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>aset/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="../bower_components/bootstrap/assets/js/html5shiv.js"></script>
			<script src="../bower_components/bootstrap/assets/js/respond.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url(); ?>aset/js/jquery.js"></script>		
		<script src="<?php echo base_url(); ?>aset/js/jquery-1.11.1.min.js"></script>		
		<script src="<?php echo base_url(); ?>aset/js/jquery.nicescroll.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>aset/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>aset/js/jquery/jquery-ui-1.9.2.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>aset/js/loading.js"></script>
		<script src="<?php echo base_url(); ?>aset/js/bootswatch.js"></script>
		<script src="<?php echo base_url(); ?>aset/js/step.js"></script>
		<script src="<?php echo base_url(); ?>aset/js/bootstrap-tooltip.js"></script>
		<script src="<?php echo base_url() ?>aset/js/wow.min.js"></script>
		<script src="<?php echo base_url(); ?>aset/css/vertical-timeline/js/main.js"></script> <!-- Resource jQuery -->
		<script src="<?php echo base_url(); ?>aset/css/vertical-timeline/js/modernizr.js"></script> <!-- Modernizr -->
		
		
		
		<script type="text/javascript">
			// <![CDATA[
			$(document).ready(function () {
				new WOW().init();
				$(function () {
					$( "#kode_surat_masuk" ).autocomplete({
						source: function(request, response) {
							$.ajax({ 
								url: "<?php echo site_url('klasifikasi_surat/get_klasifikasi'); ?>",
								data: { kode: $("#kode_surat_masuk").val()},
								dataType: "json",
								type: "POST",
								success: function(data){
									response(data);
								}    
							});
						}
					});
				});
				
				$(function () {
					$( "#kode_surat" ).autocomplete({
						source: function(request, response) {
							$.ajax({ 
								url: "<?php echo site_url('klasifikasi_surat/get_klasifikasi'); ?>",
								data: { kode: $("#kode_surat").val()},
								dataType: "json",
								type: "POST",
								success: function(data){
									response(data);
								}    
							});
						},
						autofocus: true
					});
				});
				
				$(function () {
					$( "#getAgenda" ).autocomplete({
						source: function(request, response) {
							$.ajax({ 
								url: "<?php echo site_url('klasifikasi_surat/get_agenda'); ?>",
								data: { getAgenda: $("#getAgenda").val(),tanggal_perkara: $("#tanggal_perkara").val()},
								dataType: "json",
								type: "POST",
								success: function(data){
									response(data);
								}    
							});
						},
						autofocus: true
					});
				});
				
				$(function () {
					$( "#pengirim" ).autocomplete({
						source: function(request, response) {
							$.ajax({ 
								url: "<?php echo site_url('klasifikasi_surat/get_instansi_pengirim'); ?>",
								data: { kode: $("#pengirim").val()},
								dataType:"json",
								cache: false,
								type: "POST",
								success: function(data){
									response(data);
								}    
							});
						},
						autofocus: true
					});
				});

				$(function() {
					$( ".tgl" ).datepicker({
						changeMonth: true,
						changeYear: true,
						dateFormat: 'yy-mm-dd'
					});
				});
				$(function() {
					$( "#tgl_surat" ).datepicker({
						changeMonth: true,
						changeYear: true,
						dateFormat: 'yy-mm-dd'
					});
				});
			});
			// ]]>
		</script>
		
	</head>
	
	<body>
		<?php $this->load->view('admin/template/menu', $notif); ?>
		<?php $this->load->view('admin/help/help'); ?>
		<div class="container">
			<div class="wrap">
				<?php $this->load->view('admin/template/header-info'); ?>
				
				<!-- DINAMIC CONTENT PAGE-->				
				<?php $this->load->view('admin/'.$page); ?>	
				<!-- END DINAMIC CONTENT PAGE-->				
				
			</div>
		</div>
		<!-- FOOTER-->
		<?php $this->load->view('admin/template/footer'); ?>	
		<!-- END FOOTER-->
		
	</body>
	<script src="<?php echo base_url(); ?>aset/js/common-scripts.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>aset/js/jquery.dcjqaccordion.2.7.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>aset/js/owl.carousel.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>aset/js/count.js" type="text/javascript"></script>
	
	<script src="<?php echo base_url(); ?>aset/js/highcharts.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>aset/js/exporting.js" type="text/javascript"></script>
	
	<!--common script for all pages-->
	
	<!--script for this page only-->
	
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#example').dataTable( {
				"columnDefs": [{
				    "defaultContent": "-",
				    "targets": "_all"
				 }]
			} );
		} );
	</script>
	
	<!--main content end-->
	
	
	<script type="text/javascript" src="<?php echo base_url(); ?>aset/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>aset/data-tables/DT_bootstrap.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$(" #alert" ).fadeOut(5000);
		});
	</script>
	
	
	
</html>
