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

$filename = "DATA SURAT MASUK - " . $tanggal . " " . $bulan . " " . $tahun . ".xls";
header("Expires: Mon, 26 Jul 2001 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Cache-control: private");
header("Content-Type: application/vnd.ms-word; name='word'");
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
?>

<html>
<title><b> DATA SURAT
        MASUK <?php echo tgl_jam_sql($tgl_start) . "</b> sampai dengan tanggal <b>" . tgl_jam_sql($tgl_end) . "</b>"; ?>
</title>
<head>
    <meta charset="utf-8">
</head>
<body onload="window.print()">
<h2>DAFTAR SURAT MASUK </h2>
<h3><?php echo tgl_jam_sql($tgl_start) . " - " . tgl_jam_sql($tgl_end); ?></h3>
<table border="1" style="border-top:3px solid #004D66; ">
    <tr style="background-color:#004D66;color: #fff ; border:1px solid #eee ; align:center;">
        <th width="3%">No</th>
        <th width="5%">Kode Surat</th>
        <th width="17%">No Surat</th>
        <th width="7%">Tgl. Surat</th>
        <th width="7%">Sifat</th>
        <th width="28%">Perihal</th>
        <th width="18%">Pengirim</th>
        <th width="7%">Tgl Disposisi</th>
        <th width="5%">Status Disposi</th>
        <th width="10%">Penginput Surat</th>
    </tr>

    <?php
    $disposisi = array("1" => "Register Aplikasi", "2" => "Belum ada laporan", "3" => "Selesai");

    if (!empty($data)) {
        $no = 0;
        foreach ($data as $d) {
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
                <td><?php echo tgl_jam_sql($d->tgl_diterima); ?></td>
                <td><?php echo $disposisi[$d->status_disposisi]; ?></td>
                <td><?php echo $d->pengolah ?></td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='9' style='text-align: center'>Tidak ada data</td></tr>";
    }
    ?>
</table>
</body>
</html>
