<div class="clearfix">
    <div class="row">
        <div class="col-lg-12">

            <div class="navbar navbar-inverse animated ">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Data Pelaksanaan Intruksi </a>
                    </div>
                    <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="<?php echo base_URL(); ?>referensi/pelaksanaan_intruksi/add" class="btn-info"><i
                                        class="icon-plus-sign icon-white"> </i> Tambah Data</a>
                            </li>
                        </ul>

                    </div><!-- /.nav-collapse -->
                </div><!-- /.container -->
            </div><!-- /.navbar -->

        </div>
    </div>

    <?php echo $this->session->flashdata("k");?>

    <div class="adv-table">
        <section id="unseen">
            <table  class="display table table-bordered table-striped table-condensed table-hover" id="example">
                <thead>
                <tr>
                    <th width="50%">Nama Intruksi</th>
                    <th width="30%">Kategori</th>
                    <th width="20%">Aksi</th>
                </tr>
                </thead>

                <tbody>
                <?php
                if (empty($data)) {
                    echo "<tr><td colspan='4'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
                } else {
                    $no 	= ($this->uri->segment(4) + 1);
                    $l_kode_intruksi = array('1' => 'Tidak Ada Laporan', '2' => 'Ada Laporan');
                    foreach ($data as $b) {
                        ?>
                        <tr>
                            <td><?php echo $b->intruksi; ?></td>
                            <?php
                            if ($b->kode_intruksi == 1) {
                                $btn = "label-warning";
                                $icon = "";
                            }
                            elseif  ($b->kode_intruksi == 2) {
                                $btn = "label-danger";
                                $icon = "";
                            }
                            elseif ($b->kode_intruksi == 3) {
                                $btn = "label-success";
                                $icon = "icon-check-sign";
                            }
                            else {
                                $btn = "label-default";
                                $icon = "";
                            }
                            ?>
                            <td class="ctr">
                                <span class="label <?= $btn?>">
                                    <span class="<?= $icon; ?> icon-white"></span> <?php echo  $l_kode_intruksi[$b->kode_intruksi]; ?>
                                </span>
                            </td>

                            <?php
                            if ($this->session->userdata('admin_level') == "Super Admin") {
                                ?>
                                <td class="ctr">
                                    <div class="btn-group">
                                        <a href="<?php echo base_URL(); ?>referensi/pelaksanaan_intruksi/edt/<?php echo $b->id; ?>" class="btn btn-success btn-sm"><i class="icon-edit icon-white"> </i> Edit</a>
                                        <a href="<?php echo base_URL() ?>referensi/pelaksanaan_intruksi/del/<?php echo $b->id ?>"
                                           class="btn btn-warning btn-sm" title="Hapus Data"
                                           onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove"> </i>
                                            Del</a>
                                    </div>
                                </td>
                                <?php
                            } else {
                                echo "<td class='ctr'> -- </td>";
                            }
                            ?>
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
