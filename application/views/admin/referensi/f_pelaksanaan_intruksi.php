<?php
$mode = $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $id = $datpil->id;
    $intruksi = $datpil->intruksi;
    $kode_intruksi = $datpil->kode_intruksi;
} else {
    $act = "act_add";
    $id = "";
    $intruksi = "";
    $kode_intruksi = "";
}
?>
<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Data Intruksi
            </a>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<?php echo $this->session->flashdata("k");?>

<div class="well">

    <form action="<?php echo base_URL(); ?>referensi/pelaksanaan_intruksi/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <table width="100%" class="table-form">
            <tr>
                <td width="20%">Nama Intruksi</td>
                <td>
                    <input type="text" name="intruksi" required value="<?php echo $intruksi; ?>" style="width: 700px" class="form-control" autofocus>
                </td>
            </tr>
            <tr>
                <td width="20%">Kategori</td>
                <td>
                    <select name="kode_intruksi">
                        <option value="1" <?= $kode_intruksi == 1 ? 'selected' :''?>>Tidak Ada Laporan</option>
                        <option value="2" <?= $kode_intruksi == 2 ? 'selected' :''?>>Ada Laporan</option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="row">
            <div class="col-md-12">
                <div class="right mt25">
                    <a href="<?php echo base_URL(); ?>referensi/pelaksanaan_intruksi" class="btn btn-success">
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
