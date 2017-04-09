<?php
$mode = $this->uri->segment(4);

if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $id_disposisi = $datpil->id_disposisi;
    $id_surat_masuk = $datpil->id_surat_masuk;
    $tujuan_disposisi = $datpil->tujuan_disposisi;
    $kode_intruksi = $datpil->kode_intruksi;
    $isi_instruksi = $datpil->isi_instruksi;
    $tgl_instruksi = $datpil->tgl_instruksi;
    $waktu_lama_instruksi = $datpil->waktu_lama_instruksi;
    $batas_waktu = $datpil->batas_waktu;
    $paraf_kasi = $datpil->paraf_kasi;
    $paraf_kajari = $datpil->paraf_kajari;
    $tgl_disposisi = $datpil->tgl_disposisi;
    $catatan = $datpil->catatan;
    $lampiran_dokumen = $datpil->lampiran_dokumen;
    $lampiran_foto = $datpil->lampiran_foto;
    $status_disposisi = $datpil->status_disposisi;
    $kode_intruksi = $datpil->kode_intruksi;
} else {
    $act = "act_add";
    $id_disposisi = "";
    $id_surat_masuk = $this->uri->segment(3);
    $tujuan_disposisi = "";
    $kode_intruksi = "";
    $isi_instruksi = "";
    $tgl_instruksi = "";
    $waktu_lama_instruksi = "";
    $batas_waktu = "";
    $paraf_kasi = "";
    $paraf_kajari = "";
    $tgl_disposisi = "";
    $catatan = "";
    $lampiran_dokumen = "";
    $lampiran_foto = "";
    $status_disposisi = "";
}
?>
<div class="navbar navbar-inverse navJudul">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Disposisi Surat</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->
<?= $this->breadcrumbs->show(); ?>
<form action="<?php echo base_URL(); ?>disposisi/surat_disposisi/<?php echo $this->uri->segment(3) ?>/<?php echo $act; ?>"
    method="post" accept-charset="utf-8" enctype="multipart/form-data">

    <input type="hidden" name="id_disposisi" value="<?php echo $id_disposisi; ?>">
    <input type="hidden" name="id_surat_masuk" value="<?php echo $id_surat_masuk; ?>">

    <div class="alert alert-info">
        <p> Perihal Surat</b> :<?php echo $judul_surat; ?> </p>
        <p> Pengirim</b> : <?php echo $pengirim; ?> </p>
        <p> Sifat </b> : <?php echo $sifat; ?> </p>
    </div>

    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-6">
            <table width="100%" class="table-form">
                <tr>
                    <td width="20%">Disposisi Ke:</td>
                    <td>
                        <select name="tujuan_disposisi" class="col-md-12" tabindex="3" required>
                            <option value="">--Pilih--</option>
                            <?php foreach ($ref_disposisi as $ref_disposisi) { ?>
                                <option
                                    value="<?php echo $ref_disposisi->id ?>" <?php echo $ref_disposisi->id == $tujuan_disposisi ? 'selected' : ''; ?>>
                                    <?php echo $ref_disposisi->tujuan_disposisi ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Jenis Intruksi</td>
                    <td>
                        <select name="kode_intruksi" class="col-md-12" required>
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
                    <td width="20%">Isi Intruksi</td>
                    <td>
                        <textarea name="isi_instruksi" tabindex="11" style="width: 400px; height: 90px" class="form-control" required><?php echo $isi_instruksi; ?></textarea>
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-lg-6">
            <table width="100%" class="table-form">
                <tr>
                    <td width="20%">Batas Waktu</td>
                    <td>
                            <input type="text" tabindex="4" name="batas_waktu" required
                                  value="<?php echo $batas_waktu; ?>" id="tgl_surat" style="width: 100px"
                                  class="form-control">
                    </td>
                </tr>
                <tr>
                    <td width="20%">Catatan</td>
                    <td>
                        <textarea name="catatan" tabindex="11" style="width: 400px; height: 90px" class="form-control"><?php echo $catatan; ?></textarea>
                    </td>
                </tr>
                <?php  if($kode_intruksi == 2):?>
                <tr>
                    <td width="20%">Laporan Dokumen</td>
                    <td>
                        <b>
                            <input type="file" name="lampiran_dokumen" tabindex="10" class="form-control"
                                   style="width: 100%"></b>
                        <br/>
                        <?php
                        if ($lampiran_dokumen) {
                            echo "<a href='" . base_URL() . "upload/surat_masuk/" . $lampiran_dokumen . "' target='_blank'> <button type='button' class='btn btn-info '><i class='icon-cloud-upload'></i> " . $lampiran_dokumen . "</button></a>";
                        } else {
                            echo "<button type='button' class='btn btn-danger'><i class='icon-warning-sign'></i> Belum ada Laporan</button>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Laporan Foto</td>
                    <td>
                        <b>
                            <input type="file" name="lampiran_foto" tabindex="10" class="form-control"
                                   style="width: 100%"></b>
                        <br/>
                        <?php
                        if ($lampiran_foto) {
                            echo "<a href='" . base_URL() . "upload/surat_masuk/" . $lampiran_foto . "' target='_blank'> <button type='button' class='btn btn-info '><i class='icon-cloud-upload'></i> " . $lampiran_foto . "</button></a>";
                        }else {
                            echo "<button type='button' class='btn btn-danger'><i class='icon-warning-sign'></i> Belum ada Laporan</button>";
                        }
                        ?>
                    </td>
                </tr>
                <?php endif;?>
            </table>
        </div>

        <div class="col-lg-6">
            <table width="100%" class="table-form">
                <tr>
                    <td width="20%">
                    <tr>
                        <td width="60%">
                            <input id="paraf_kasi" type="checkbox" value="1" name="paraf_kasi" <?php echo set_checkbox('paraf_kasi', '1'); ?> > Paraf
                            Lurah <br/>
                            <input id="paraf_kajari" type="checkbox" value="1" name="paraf_kajari" <?php echo set_checkbox('paraf_kajari', '1'); ?>> Paraf Seklur <br/>
                        </td>
                    </tr>
                </td>
                </tr>
            </table>
        </div>
        <div class="row ">
            <div class="col-lg-12">
                <div class="right mt25">
                    <a href="<?php echo base_URL(); ?>surat_masuk/masuk" class="btn btn-success"
                       tabindex="11"><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
                   <button type="submit" class="btn btn-primary">
                        <i class="icon icon-ok icon-white"></i> Simpan
                    </button>
                </div>
            </div>
        </div>

    </div>

</form>

<script>
    $(document).ready(function () {
        $(function () {
            var kajari, kasi;
            kajari = <?php echo (empty($datpil->paraf_kajari)) ? '0' : $datpil->paraf_kajari;  ?>;
            kasi = <?php echo (empty($datpil->paraf_kasi)) ? '0' : $datpil->paraf_kasi; ?>;
            if (kasi == 1) {
                $('#paraf_kasi').prop('checked', true);
            }
            if (kajari == 1) {
                $('#paraf_kajari').prop('checked', true);
            }

        });
    });
</script>
