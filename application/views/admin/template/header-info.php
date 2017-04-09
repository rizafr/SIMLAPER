<?php
	$q_instansi	= $this->db->query("SELECT * FROM tr_instansi LIMIT 1")->row();
	$q_aplikasi	= $this->db->query("SELECT * FROM t_aplikasi LIMIT 1")->row();
?>
<div class="page-header animated fadeIn" data-wow-duration="2s" id="banner">
	<div class="row">
		<div class="" style="padding: 15px 15px 0 15px; margin-top: 15px;">
			<div class="well well-sm">
				<img src="<?php echo base_url(); ?>upload/<?php echo $q_instansi->logo; ?>" class="thumbnail span3" style="display: inline; float: left; margin-right: 20px; width: 100px; height: 100px">
				<h2 style="margin: 15px 0 10px 0; color: #000;"><?php echo $q_instansi->nama; ?></h2>
				<div class="clearfix">Alamat : <?php echo $q_instansi->alamat; ?></div>
			</div>
		</div>
	</div>
</div>
