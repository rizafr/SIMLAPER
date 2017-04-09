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
				<li><a href="<?php echo base_url(); ?>admin"><i class="icon-home icon-white"> </i> Beranda</a></li>
				<div class="nav notify-row" id="top_menu">
					<!--  notification start -->
					<ul class="nav top-menu">              
						<!-- notification dropdown start-->
						<li id="header_notification_bar" class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">

								<i class="icon-envelope icon-white"></i>
								<span class="badge bg-important"><?= $countSuratMasukNotReported+$countSuratBelumDisposisi; ?></span>
							</a>
							<ul class="dropdown-menu extended notification">
								<div class="notify-arrow notify-arrow-red"></div>
								<li>
									<p class="red">Ada <?= $countSuratMasukNotReported; ?> surat yang belum ditindaklanjuti atau belum ada laporan</p>
								</li>
								<li>
									<p class="red">Ada <?= $countSuratBelumDisposisi; ?> surat yang belum disposisi</p>
								</li>
								<li>
									<a href="<?php echo base_url(); ?>surat_masuk/masuk">
										<i class="fa fa-eye"></i> Lihat
									</a>
								</li>
							</ul>
						</li>
						<!-- notification dropdown end -->
					</ul>
				</div>

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-th-list icon-white"> </i> Master <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<li>
							<a tabindex="-1" href="<?php echo base_url(); ?>klasifikasi_surat/klas_surat">Klasifikasi Surat</a>
						</li>
						<li>
							<a tabindex="-2" href="<?php echo base_url(); ?>referensi/sifat_surat">Sifat Surat</a>
						</li>
						<li>
							<a tabindex="-2" href="<?php echo base_url(); ?>referensi/pengirim">Pengirim Surat</a>
						</li>
						<li>
							<a tabindex="-2" href="<?php echo base_url(); ?>referensi/ref_disposisi">Tujuan Disposisi Surat</a>
						</li>
						<li>
							<a tabindex="-2" href="<?php echo base_url(); ?>referensi/pelaksanaan_intruksi">Pelaksanaan Instruksi</a>
						</li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-random icon-white"> </i> Manajemen Surat <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<li>
							<a tabindex="-1" href="<?php echo base_url(); ?>surat_masuk/masuk">Surat Masuk</a>
						</li>
						<!-- 	<li><a tabindex="-1" href="<?php echo base_url(); ?>surat_keluar/keluar">Surat Keluar</a></li> -->
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-file icon-white"> </i> Laporan <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<li>
							<a tabindex="-1" href="<?php echo base_url(); ?>laporan/laporan_surat_masuk">Pertanggal</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo base_url(); ?>laporan/laporan_klasifikasi_surat">Perklasifikasi Surat</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo base_url(); ?>laporan/laporan_sifat_surat">Sifat Surat</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo base_url(); ?>laporan/laporan_pengirim_surat">Pengirim Surat</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo base_url(); ?>laporan/laporan_tujuan_disposisi">Tujuan disposisi</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo base_url(); ?>laporan/laporan_kategori_intruksi">Kategori Intruksi</a>
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