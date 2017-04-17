<?php
$q_instansi	= $this->db->query("SELECT * FROM tr_instansi LIMIT 1")->row();
$q_aplikasi	= $this->db->query("SELECT * FROM t_aplikasi LIMIT 1")->row();
$queryUnReported	= $this->db->query("SELECT * FROM surat_masuk where status_disposisi = '2'");
$unReportCount = $queryUnReported->num_rows();
?>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<span class="navbar-brand"><strong><?= $q_aplikasi->name; ?></strong></span>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">	
				<li>
					<a href="<?php echo base_url(); ?>admin">
					<i class="icon-home icon-white"></i> 
						Beranda
					</a>
				</li>

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-th-list icon-white"> </i> Master <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<li>
							<a tabindex="-1" href="<?php echo base_url(); ?>kader/index">Data Kader</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo base_url(); ?>pasien/index">Data Pasien</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo base_url(); ?>template-sms/index">Template SMS</a>
						</li>
					</ul>
				</li>

				<?php
				if ($this->session->userdata('admin_id_level') == "1") {
					?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-wrench icon-white"> </i> Pengaturan <span class="caret"></span>
						</a>
						<ul class="dropdown-menu" aria-labelledby="themes">
							<li>
								<a tabindex="-1" href="<?php echo base_url(); ?>pengaturan/pengguna">Instansi</a>
							</li>
							<li>
								<a tabindex="-1" href="<?php echo base_url(); ?>pengaturan/manage_admin">Manajemen Personil</a>
							</li>
						</ul>
					</li>
					<?php 
				}
				?>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-user icon-white"></i> <?php echo $this->session->userdata('admin_nama'); ?> <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<li>
							<a tabindex="-1" href="<?php echo base_url(); ?>pengaturan/passwod">Ubah Password</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo base_url(); ?>logins/logout">Logout</a>
						</li>
						<li>
							<a tabindex="-1"  data-toggle="modal" href="#help">Help</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>