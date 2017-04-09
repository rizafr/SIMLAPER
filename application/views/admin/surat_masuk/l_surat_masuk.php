<?= $this->breadcrumbs->show(); ?>
<div class="clearfix">
    <div class="row">
        <div class="col-lg-12">

            <div class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Surat Masuk</a>
                    </div>
                    <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo base_URL(); ?>surat_masuk/masuk/add" class="btn-info"><i
                                        class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
                        </ul>

                    </div><!-- /.nav-collapse -->
                </div><!-- /.container -->
            </div><!-- /.navbar -->

        </div>
    </div>

    <?php echo $this->session->flashdata("k"); ?>

    <div class="adv-table">
        <section id="unseen">
            <table class="display table table-bordered table-striped table-condensed table-hover" id="suratMasuk">
                <thead>
                <tr>
                    <th width="10%">No. Agd/Kode</th>
                    <th width="5%">Tgl. Diterima</th>
                    <th width="21%">Perihal, File</th>
                    <th width="15%">Pengirim</th>
                    <th width="11%">Nomor, Tgl. Surat</th>
                    <th width="7.5%">Sifat Surat</th>
                    <th width="5.5%">Status Disposisi</th>
                    <th width="7.5%">Disposisi Ke</th>
                    <th width="7.5%">Keterangan</th>
                    <th width="25%">Aksi</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $disposisi = array("1" => "Register Aplikasi", "2" => "Belum ada laporan", "3" => "Selesai");

                if (empty($data)) {
                    echo "<tr><td colspan='9'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
                } else {
                    $no = ($this->uri->segment(4) + 1);
                    foreach ($data as $b) {
                        ?>
                        <tr>
                            <td><?php echo $b->no_agenda . "/" . $b->kode_surat_masuk; ?></td>
                            <td>
                                <?= tgl_jam_sql($b->tgl_diterima) ?>
                            </td>
                            <td>
                                <?php
                                echo $b->perihal_surat_masuk;
                                if ($b->lampiran) {
                                    echo "<br><b>File : </b><i><a href='" . base_URL() . "upload/surat_masuk/" . $b->lampiran . "' target='_blank'>" . $b->lampiran."</a>";
                                } else {
                                    echo "<button type='button' class='btn btn-danger btn-sm'><i class='icon-warning-sign'></i> Belum ada Scan File</button>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $b->asal_surat_masuk; ?>
                            </td>
                            <td>
                                <?php echo $b->no_surat_masuk . "<br><i>" . tgl_jam_sql($b->tgl_surat_masuk) . "</i>" ?>
                            </td>
                            <td>
                                <span <?php
                                if ($b->status_surat_masuk == "Rahasia") {
                                    echo "class='label label-warning'";
                                } else if ($b->status_surat_masuk == "Penting") {
                                    echo "class='label label-danger'";
                                } else {
                                    echo "class='label label-default'";
                                }
                                ?>><?php echo $b->status_surat_masuk; ?>
                                </span>
                            </td>
                            <td>
                                <?php
                                    if ($b->status_disposisi == 1) {
                                        $btn = "label-warning";
                                        $icon = "icon-warning-sign";
                                    }
                                    elseif  ($b->status_disposisi == 2) {
                                        $btn = "label-danger";
                                        $icon = "icon-warning-sign";
                                    }
                                    elseif ($b->status_disposisi == 3) {
                                        $btn = "label-success";
                                        $icon = "icon-check-sign";
                                    }
                                    else {
                                        $btn = "label-default";
                                        $icon = "icon-warning-sign";
                                    }
                                ?>
                                <span class="label <?= $btn?>">
                                    <span class="<?= $icon; ?> icon-white"></span> <?php echo  $disposisi[$b->status_disposisi]; ?>
                                </span>

                            </td>
                            <td>
                                <?php if (empty($b->disposi_ke)) : ?>
                                <?= $b->disposisi_ke?>
                                <?php else : ?>
                                <p> Belum ada </p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= $b->keterangan?>
                            </td>

                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo base_URL() ?>index.php/surat_masuk/masuk/edt/<?php echo $b->id_surat_masuk ?>"
                                       class="btn btn-success btn-sm" title="Edit Data"><i
                                            class="icon-edit icon-white"> </i> Edt</a>
                                    <a href="<?php echo base_URL() ?>index.php/surat_masuk/masuk/del/<?php echo $b->id_surat_masuk ?>"
                                       class="btn btn-warning btn-sm" title="Hapus Data"
                                       onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove"> </i>
                                        Del</a>
                                    <a href="<?php echo base_URL() ?>disposisi/surat_disposisi/<?php echo $b->id_surat_masuk ?>/<?=  $b->id_disposisi ? 'edt/' : 'add/'?><?= $b->id_disposisi ?>"
                                       class="btn btn-default btn-sm" title="Disposisi Surat"><i
                                            class="icon-trash icon-list"> </i> Disp</a>
                                    <a href="<?php echo base_URL() ?>disposisi/disposisi_cetak/<?php echo $b->id_surat_masuk ?>"
                                       class="btn btn-info btn-sm" target="_blank" title="Cetak Disposisi"><i
                                            class="icon-print icon-white"> </i> Ctk</a>
                                </div>


                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                }
                ?>
                </tbody>
            </table>
        </section>
    </div>

</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#suratMasuk').dataTable({
            "aaSorting": [[0, "desc"]]
        });
    });
</script>