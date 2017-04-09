<?php
	$q_instansi	= $this->db->query("SELECT * FROM tr_instansi LIMIT 1")->row();
	$q_aplikasi	= $this->db->query("SELECT * FROM t_aplikasi LIMIT 1")->row();
?>
<!-- Modal -->
<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Tentang Aplikasi</h4>
			</div>
			<div class="modal-body">				
				<h2 align="center"><?php echo $q_aplikas->name; ?></h2>
				<h4 align="center"><?php echo $q_aplikas->desc; ?></h4>
			
				
				
			</div>
			<div class="modal-footer">
			<h4 style="font-weight: bold"><?php echo $q_aplikas->projectName; ?> </h4>
				<span> <?php echo $q_aplikas->developedBy; ?></span>
				<h6>&copy;  <?php echo date('Y'); ?> </h6>
				<button data-dismiss="modal" class="btn btn-default" type="button">Tutup</button>
			</div>
		</div>
</div>
</div>
<!-- modal -->	