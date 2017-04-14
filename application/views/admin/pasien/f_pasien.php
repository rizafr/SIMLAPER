<?php
$mode = $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $id = $datpil->id;
    $name = $datpil->name;
    $age = $datpil->age;
    $phoneNumber = $datpil->phoneNumber;
    $rw = $datpil->rw;
} else {
    $act = "act_add";
    $id = "";
    $name = "";
    $age = "";
    $phoneNumber = "";
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

    <form action="<?php echo base_URL(); ?>pasien/index/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <table width="100%" class="table-form">
            <tr>
                <td width="20%">Name</td>
                <td>
                    <input type="text" name="name" required value="<?php echo $name; ?>" style="width: 700px" class="form-control" autofocus>
                </td>
            </tr>
            <tr>
                <td width="20%">Umur</td>
                <td>
                    <input type="text" name="age" required value="<?php echo $age; ?>" style="width: 700px" class="form-control" autofocus>
                </td>
            </tr>
            <tr>
                <td width="20%">Telepon</td>
                <td>
                    <input type="text" name="phoneNumber" required value="<?php echo $phoneNumber; ?>" style="width: 700px" class="form-control" autofocus>
                </td>
            </tr>
            <tr>
                <td width="20%">RW</td>
                <td>
                    <input type="text" name="rw" required value="<?php echo $rw; ?>" style="width: 700px" class="form-control" autofocus>
                </td>
            </tr>
        </table>
        <div class="row">
            <div class="col-md-12">
                <div class="right mt25">
                    <a href="<?php echo base_URL(); ?>pasien/index" class="btn btn-success">
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
