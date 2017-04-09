<?php
	$q_instansi	= $this->db->query("SELECT * FROM tr_instansi LIMIT 1")->row();
	$q_aplikasi	= $this->db->query("SELECT * FROM t_aplikasi LIMIT 1")->row();
?>
<div class="footer">
	<h4 style="font-weight: bold"><?= $q_aplikasi->projectName?></h4>
	<span> <?= $q_aplikasi->developedBy?></span>
	<h6>&copy;  <?= date('Y'); ?>. Waktu Eksekusi : {elapsed_time}, Penggunaan Memori : {memory_usage}</h6>
	<a href="#" class="go-top">
		<i class="icon-angle-up"></i>
	</a>
</div>