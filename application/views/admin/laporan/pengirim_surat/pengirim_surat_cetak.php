<?php
//Format Tanggal Berbahasa Indonesia 
// Array Hari
$array_hari = array(1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');
$hari = $array_hari[date('N')];

//Format Tanggal 
$tanggal = date('j');

//Array Bulan 
$array_bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
$bulan = $array_bulan[date('n')];

//Format Tahun 
$tahun = date('Y');
?>

<html>
<title><b> DATA SURAT
        MASUK <?php echo tgl_jam_sql($tgl_start) . "</b> sampai dengan tanggal <b>" . tgl_jam_sql($tgl_end) . "</b>"; ?>
</title>
<head>
    <meta charset="utf-8">
</head>
<body>
<h2 class="text-center">LAPORAN BERDASARKAN PENGIRIM SURAT</h2>
<h3 class="text-center"><?php echo $pengirim_surat ?></h3>
<hr />
<table class="display table table-bordered table-striped table-condensed table-hover" id="laporan">
    <thead>
    <tr style="background-color:#004D66;color: #fff ; border:1px solid #eee ; align:center;">
        <th width="3%">No</th>
        <th width="5%">Kode Surat</th>
        <th width="17%">No Surat</th>
        <th width="7%">Tgl. Surat</th>
        <th width="7%">Sifat</th>
        <th width="28%">Perihal</th>
        <th width="18%">Pengirim</th>
        <th width="7%">Tgl Penyelesaian</th>
        <th width="7%">Tgl Laporan</th>
        <th width="5%">File Laporan</th>
        <th width="10%">Disposisi Ke</th>
        <th width="10%">Penginput</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $disposisi = array("1" => "Register Aplikasi", "2" => "Belum ada laporan", "3" => "Selesai");
    $keterangan = '';

    if (!empty($data)) {
        $no = 0;
        foreach ($data as $d) {
            $tgl1 =  $d->batas_waktu;  // 1 Oktober 2009
            $tgl2 = $d->tgl_laporan;  // 10 Oktober 2009

            // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
            // dari tanggal pertama

            $pecah1 = explode("-", $tgl1);
            $date1 = $pecah1[2];
            $month1 = $pecah1[1];
            $year1 = $pecah1[0];

            // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
            // dari tanggal kedua

            $pecah2 = explode("-", $tgl2);
            $date2 = $pecah2[2];
            $month2 = $pecah2[1];
            $year2 =  $pecah2[0];

            // menghitung JDN dari masing-masing tanggal

            $jd1 = GregorianToJD($month1, $date1, $year1);
            $jd2 = GregorianToJD($month2, $date2, $year2);

            // hitung selisih hari kedua tanggal

            $selisih = $jd2 - $jd1;
            if($selisih == 0) {
                $keterangan = 'GOOD';
            } else if($selisih > 0) {
                $keterangan = 'BAD';
            } else {
                $keterangan = 'EXCELLENT';
            }
            $no++;
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $d->kode_surat_masuk; ?></td>
                <td><?php echo $d->no_surat_masuk; ?></td>
                <td><?php echo tgl_jam_sql($d->tgl_surat_masuk); ?></td>
                <td><?php echo $d->status_surat_masuk; ?></td>
                <td><?php echo $d->perihal_surat_masuk; ?></td>
                <td><?php echo $d->asal_surat_masuk; ?></td>
                <td><?php echo tgl_jam_sql($d->batas_waktu); ?></td>
                <td><?php echo tgl_jam_sql($d->tgl_laporan); ?></td>
                <td>
                    <?php
                    if ($d->lampiran_dokumen) {
                        echo "<a href='" . base_URL() . "upload/surat_masuk/" . $d->lampiran_dokumen . "' target='_blank'> <button type='button' class='btn btn-info '><i class='icon-cloud-upload'></i> " . $d->lampiran_dokumen . "</button></a>";
                    } else {
                        echo "<button type='button' class='btn btn-danger'><i class='icon-warning-sign'></i> Belum ada Laporan</button>";
                    }
                    ?>
                    <?php
                    if ($d->lampiran_foto) {
                        echo "<a href='" . base_URL() . "upload/surat_masuk/" . $d->lampiran_foto . "' target='_blank'> <button type='button' class='btn btn-info '><i class='icon-cloud-upload'></i> " . $d->lampiran_foto . "</button></a>";
                    }
                    ?>
                </td>
                <td><?php echo $d->disposisi_ke ?></td>
                <td><?php echo $d->pengolah ?></td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='11' style='text-align: center'>Tidak ada data</td></tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#laporan').dataTable({
            "aaSorting": [[0, "asc"]]
        });
    });
</script>
