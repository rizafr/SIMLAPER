<?php
$mode = $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $idp = $datpil->id;
    $nama = $datpil->nama;
    $uraian = $datpil->uraian;
    $kode = $datpil->kode;
} else {
    $act = "act_add";
    $idp = "";
    $nama = "";
    $uraian = "";
    $kode = "";
}
?>
<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Klasifikasi Surat
            </a>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<?php echo $this->session->flashdata("k");?>

<div class="well">

    <form action="<?php echo base_URL(); ?>klasifikasi_surat/klas_surat/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <input type="hidden" name="idp" value="<?php echo $idp; ?>">
        <table width="100%" class="table-form">
            <tr>
                <td width="20%">Kode</td>
                <td>
                    <input type="text" name="kode" required value="<?php echo $kode; ?>" style="width: 700px" class="form-control" autofocus>
                </td>
            </tr>
            <tr>
                <td width="20%">Nama</td>
                <td>
                    <input type="text" name="nama" required value="<?php echo $nama; ?>" style="width: 700px" class="form-control" autofocus>
                </td>
            </tr>
            <tr>
                <td width="20%">Uraian</td>
                <td>
                    <textarea name="uraian" style="width: 700px; height: 100px" class="form-control"><?php echo $uraian; ?></textarea>
                </td>
            </tr>
        </table>
        <div class="row">
            <div class="col-md-12">
                <div class="right mt25">
                    <a href="<?php echo base_URL(); ?>klasifikasi_surat/klas_surat" class="btn btn-success">
                        <i class="icon icon-arrow-left icon-white"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="icon icon-ok icon-white"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
