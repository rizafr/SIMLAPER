<?php
$mode = $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $id_surat_masuk = $datpil->id_surat_masuk;
    $no_agenda = $datpil->no_agenda;
    $tgl_diterima = $datpil->tgl_diterima;
    $tgl_penyelesaian = $datpil->tgl_penyelesaian;
    $pengirim = $datpil->pengirim;
    $kode_surat_masuk = $datpil->kode_surat_masuk;
    $asal_surat_masuk = $datpil->asal_surat_masuk;
    $no_surat_masuk = $datpil->no_surat_masuk;
    $status_surat_masuk = $datpil->status_surat_masuk;
    $tgl_surat_masuk = $datpil->tgl_surat_masuk;
    $perihal_surat_masuk = $datpil->perihal_surat_masuk;
    $keterangan = $datpil->keterangan;
    $lampiran = $datpil->lampiran;

} else {
    $act = "act_add";
    $id_surat_masuk = "";
    $tgl_diterima = date('Y-m-d');
    $no_agenda = gli("surat_masuk", "no_agenda", 4);
    $pengirim = "";
    $kode_surat_masuk = "";
    $asal_surat_masuk = "";
    $no_surat_masuk = "";
    $status_surat_masuk = "";
    $tgl_surat_masuk = "";
    $tgl_penyelesaian = "";
    $perihal_surat_masuk = "";
    $keterangan = "";
    $lampiran = "";
}
?>
<?= $this->breadcrumbs->show(); ?>

<div class="navbar navbar-inverse navJudul">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Surat Masuk</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->


<form action="<?php echo base_URL(); ?>index.php/surat_masuk/masuk/<?php echo $act; ?>" method="post"
      accept-charset="utf-8" enctype="multipart/form-data">

    <input type="hidden" name="id_surat_masuk" value="<?php echo $id_surat_masuk; ?>">
    <input type="hidden" name="tgl_penyelesaian" class="tgl" tabindex="9" value="<?php echo $tgl_penyelesaian; ?>" style="width: 100px" class="form-control" required></b>

    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-6">
            <table class="table-form">
                <tr>
                    <td width="20%">No. Agenda</td>
                    <td>
                        <input type="text" name="no_agenda" autofocus tabindex="1" readonly value="<?php echo $no_agenda; ?>" style="width: 100px" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td width="20%">Tgl. Diterima</td>
                    <td><input type="text" name="tgl_diterima" autofocus tabindex="2" value="<?php echo $tgl_diterima; ?>" style="width: 120px" class="form-control tgl" required></td>
                </tr>
                <tr>
                    <td width="20%">Tanggal Surat</td>
                    <td>
                        <b><input type="text" name="tgl_surat_masuk" tabindex="3" required value="<?php echo $tgl_surat_masuk; ?>" id="tgl_surat_masuk" style="width: 100px" class="form-control"></b>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Sifat</td>
                    <td>
                        <select name="status_surat_masuk" class="col-md-12" required>
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
                    <td width="20%">Perihal</td>
                    <td>
                        <b><textarea name="perihal_surat_masuk" tabindex="5" style="width: 400px; height: 90px" class="form-control" required><?php echo $perihal_surat_masuk; ?></textarea></b>
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-lg-6">
            <table class="table-form">
                <tr>
                    <td width="20%">Klasifikasi Surat</td>
                    <td>
                        <b><input type="text" name="kode_surat_masuk" tabindex="6" id="kode_surat_masuk" value="<?php echo $kode_surat_masuk; ?>" style="width: 100px" class="form-control" required></b>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Pengirim</td>
                    <td>
                        <b><input id="pengirim" type="text" name="asal_surat_masuk" tabindex="7" required value="<?php echo $asal_surat_masuk; ?>" id="asal_surat_masuk" style="width: 400px" class="form-control"></b>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Nomor Surat</td>
                    <td>
                        <b><input type="text" name="no_surat_masuk" tabindex="8" required value="<?php echo $no_surat_masuk; ?>" id="no_surat_masuk" style="width: 300px" class="form-control"></b>
                    </td>
                </tr>


                <tr>
                    <td width="20%">File Surat (Scan)</td>
                    <td>
                        <b>
                            <input type="file" name="lampiran" tabindex="10" class="form-control" style="width: 100%"></b>
                        <br/>
                        <?php
                        if ($lampiran) {
                            echo "<a href='" . base_URL() . "upload/surat_masuk/" . $lampiran . "' target='_blank'> <button type='button' class='btn btn-info '><i class='icon-cloud-upload'></i> " . $lampiran . "</button></a>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Keterangan</td>
                    <td>
                        <textarea name="keterangan" tabindex="11" style="width: 400px; height: 90px" class="form-control"><?php echo $keterangan; ?></textarea>
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

<script type="text/javascript">
    $(function () {
        $("#tgl_surat_masuk").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
</script>
