-- MySQL dump 10.13  Distrib 5.6.16, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: simlaper
-- ------------------------------------------------------
-- Server version	5.6.16-1~exp1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `disposisi`
--

DROP TABLE IF EXISTS `disposisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disposisi` (
  `id_disposisi` int(11) NOT NULL AUTO_INCREMENT,
  `id_surat_masuk` int(30) NOT NULL,
  `kode_intruksi` tinyint(4) DEFAULT NULL,
  `isi_instruksi` text NOT NULL,
  `tgl_instruksi` date NOT NULL,
  `batas_waktu` date NOT NULL,
  `waktu_lama_instruksi` int(5) NOT NULL,
  `paraf_kasi` varchar(100) NOT NULL,
  `paraf_kajari` varchar(100) NOT NULL,
  `tujuan_disposisi` varchar(50) NOT NULL,
  `tgl_disposisi` date NOT NULL,
  `catatan` varchar(300) NOT NULL,
  `lampiran_foto` varchar(300) NOT NULL,
  `lampiran_dokumen` varchar(300) DEFAULT NULL,
  `tgl_laporan` date DEFAULT NULL,
  PRIMARY KEY (`id_disposisi`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disposisi`
--

LOCK TABLES `disposisi` WRITE;
/*!40000 ALTER TABLE `disposisi` DISABLE KEYS */;
INSERT INTO `disposisi` VALUES (1,2,2,'Silakan langsung datang ke tempat','2016-07-09','2016-07-06',30,'1','1','1','2016-07-09','','git.ppt','java_lect_213.pdf','2016-08-05'),(4,3,2,'Silakan langsung datang ke tempat','2016-07-09','2016-07-09',22,'1','1','5','2016-07-09','','git1.ppt','java_lect_211.pdf','2016-08-05'),(5,4,2,'tes','2016-08-05','2016-08-04',1,'1','1','3','2016-08-05','tes','','java_lect_212.pdf','2016-08-05');
/*!40000 ALTER TABLE `disposisi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inbox`
--

DROP TABLE IF EXISTS `inbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inbox` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `datetime` date DEFAULT NULL,
  `rwCode` int(10) unsigned DEFAULT NULL,
  `userType` tinyint(2) unsigned DEFAULT NULL,
  `userId` int(11) unsigned DEFAULT NULL,
  `messageType` int(3) unsigned DEFAULT NULL,
  `messageTime` datetime DEFAULT NULL,
  `messages` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inbox`
--

LOCK TABLES `inbox` WRITE;
/*!40000 ALTER TABLE `inbox` DISABLE KEYS */;
/*!40000 ALTER TABLE `inbox` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kader`
--

DROP TABLE IF EXISTS `kader`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kader` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `phoneNumber` varchar(25) DEFAULT NULL,
  `rw` varchar(11) NOT NULL DEFAULT '',
  `status` tinyint(3) DEFAULT NULL,
  `createdTime` datetime NOT NULL,
  `updatedTime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `createdBy` varchar(11) DEFAULT NULL,
  `isRemoved` int(11) DEFAULT '0',
  `removedTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kader`
--

LOCK TABLES `kader` WRITE;
/*!40000 ALTER TABLE `kader` DISABLE KEYS */;
/*!40000 ALTER TABLE `kader` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(100) NOT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level`
--

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` VALUES (1,'Super Admin'),(2,'Bagian Administrasi'),(3,'Seklur'),(4,'Kasi');
/*!40000 ALTER TABLE `level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasien`
--

DROP TABLE IF EXISTS `pasien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pasien` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `phoneNumber` varchar(25) DEFAULT NULL,
  `rw` varchar(11) NOT NULL DEFAULT '',
  `age` int(11) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `createdTime` datetime NOT NULL,
  `updatedTime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `createdBy` varchar(11) DEFAULT NULL,
  `isRemoved` int(11) DEFAULT '0',
  `removedTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasien`
--

LOCK TABLES `pasien` WRITE;
/*!40000 ALTER TABLE `pasien` DISABLE KEYS */;
/*!40000 ALTER TABLE `pasien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelaksanaan_intruksi`
--

DROP TABLE IF EXISTS `pelaksanaan_intruksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pelaksanaan_intruksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_intruksi` varchar(50) DEFAULT NULL,
  `intruksi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelaksanaan_intruksi`
--

LOCK TABLES `pelaksanaan_intruksi` WRITE;
/*!40000 ALTER TABLE `pelaksanaan_intruksi` DISABLE KEYS */;
INSERT INTO `pelaksanaan_intruksi` VALUES (1,'1','UDK'),(2,'1','Saya Hadir'),(3,'2','Hadiri'),(4,'2','Penuhi'),(5,'2','Edaran / Pemberitahuan'),(6,'2','Undangan'),(7,'2','Lain-lain');
/*!40000 ALTER TABLE `pelaksanaan_intruksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `id_level` int(10) NOT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengguna`
--

LOCK TABLES `pengguna` WRITE;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','IYAN SUKMANA, S.IP','19741202 200701 1 00','Administrator',1),(3,'seklur','faca25fa364201d24b323a91a6f6b463','Seklur','123456789123456','Seklur',3),(4,'kasipem','ec326e3752a6419e328ae0c2e910e1c0','Kasi Pem','123456789','Kasi Pem',4),(6,'staf','7b8a17c3f48d4453fde0fd74b4fa9212','Staf','123456789123456','Staf',2),(8,'rully','21232f297a57a5a743894a0e4a801fc3','RULLY SULFANORIDA, ST','19710127 200501 1 00','Administrator',1),(9,'agus','21232f297a57a5a743894a0e4a801fc3','AGUS IRWAN KUSTIAWAN, S.IP','19730810 200501 1 00','Administrator',1),(10,'jajang','21232f297a57a5a743894a0e4a801fc3','JAJANG BINTAYA, SE','19800510 200701 1 00','Administrator',1),(11,'nanang','21232f297a57a5a743894a0e4a801fc3','NANANG SUNANDAR, SE','19771223 200501 1 00','Administrator',1),(12,'iyan','21232f297a57a5a743894a0e4a801fc3','IYAN SUKMANA, S.IP','19741202 200701 1 00','Administrator',1),(13,'juanda','21232f297a57a5a743894a0e4a801fc3','JUANDA INDRA BANGSAWAN, SE','19660315 199203 1 00','Administrator',1),(14,'nurdaningsih','21232f297a57a5a743894a0e4a801fc3','NURDANINGSIH, S.SOS','19800107 200801 2 00','Administrator',1),(15,'wanda','21232f297a57a5a743894a0e4a801fc3','WANDA, SE','19810129 201001 1 00','Administrator',1),(16,'bertha','21232f297a57a5a743894a0e4a801fc3','BERTHA IMMANIA, S.IP','19871012 200604 1 00','Administrator',1),(17,'osid','21232f297a57a5a743894a0e4a801fc3','OSID ROCHSIDI, S.Pd','19740102 200604 1 00','Administrator',1),(18,'siran','21232f297a57a5a743894a0e4a801fc3','SIR\'AN','19701110 200801 1 00','Administrator',1),(19,'taufik','21232f297a57a5a743894a0e4a801fc3','TAUFIK RAHMAN','19830708 201001 1 00','Administrator',1),(20,'dedi','21232f297a57a5a743894a0e4a801fc3','DEDI SUPRIADI','19780715 201406 1 00','Administrator',1);
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengirim`
--

DROP TABLE IF EXISTS `pengirim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengirim` (
  `id_pengirim` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `instansi` text,
  PRIMARY KEY (`id_pengirim`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengirim`
--

LOCK TABLES `pengirim` WRITE;
/*!40000 ALTER TABLE `pengirim` DISABLE KEYS */;
INSERT INTO `pengirim` VALUES (1,'WALIKOTA CIMAHI'),(2,'WAKIL WALIKOTA CIMAHI'),(3,'SEKRETARIS DAERAH KOTA CIMAHI'),(4,'ASISTEN PEMERINTAHAN SETDA KOTA CIMAHI'),(5,'ASISTEN PEREKONOMIAN DAN PEMBANGUNAN SETDA KOTA CIMAHI'),(6,'ASISTEN ADMINISTRASI UMUM SETDA KOTA CIMAHI'),(7,'DPRD KOTA CIMAHI'),(8,'SEKRETARIAT DPRD KOTA CIMAHI'),(9,'DINAS KESEHATAN'),(10,'DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL'),(11,'DINAS TENAGA KERJA, TRANSMIGRASI DAN SOSIAL'),(12,'DINAS PERHUBUNGAN'),(13,'DINAS PENDIDIKAN, PEMUDA DAN OLAH RAGA'),(14,'DINAS KOPERASI, UMKM, PERINDUSTRIAN, PERDAGANGAN DAN PERTANIAN'),(15,'DINAS PENDAPATAN'),(16,'DINAS PEKERJAAN UMUM'),(17,'DINAS KEBERSIHAN DAN PERTAMANAN'),(18,'BAPPEDA'),(19,'BKD'),(20,'BPMPPKB'),(21,'BPMPTSP'),(22,'BPKAD'),(23,'BPBD'),(24,'INSPEKTORAT'),(25,'KANTOR LINGKUNGAN HIDUP'),(26,'KANTOR KESBANG'),(27,'KAPPDE'),(28,'SATPOL PP'),(29,'BAGIAN PEMERINTAHAN SETDA KOTA CIMAHI'),(30,'BAGIAN HUKUM SETDA KOTA CIMAHI'),(31,'BAGIAN ORGANISASI SETDA KOTA CIMAHI'),(32,'BAGIAN ADMINISTRASI PEREKONOMIAN SETDA KOTA CIMAHI'),(33,'BAGIAN ADMINISTRASI PEMBANGUNAN SETDA KOTA CIMAHI'),(34,'BAGIAN ADMINISTRASI KESRA SETDA KOTA CIMAHI'),(35,'BAGIAN HUMAS SETDA KOTA CIMAHI'),(36,'BAGIAN UMUM DAN PROTOKOL SETDA KOTA CIMAHI'),(37,'RUMAH SAKIT UMUM DAERAH'),(38,'SEKRETARIAT KORPRI'),(39,'KECAMATAN CIMAHI SELATAN');
/*!40000 ALTER TABLE `pengirim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perkara`
--

DROP TABLE IF EXISTS `perkara`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perkara` (
  `id_perkara` int(11) NOT NULL AUTO_INCREMENT,
  `no_agenda` varchar(10) NOT NULL,
  `tanggal_perkara` date NOT NULL,
  `nama_tersangka` varchar(50) NOT NULL,
  `perkara` varchar(100) NOT NULL,
  `id_jaksa` int(11) NOT NULL,
  PRIMARY KEY (`id_perkara`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perkara`
--

LOCK TABLES `perkara` WRITE;
/*!40000 ALTER TABLE `perkara` DISABLE KEYS */;
INSERT INTO `perkara` VALUES (3,'0002','2015-08-13','Dikdik','Khasanah Dunia Pencopetan',1),(4,'0003','2007-02-08','Dikdik','Khasanah Dunia Pencopetan',0),(6,'001','2015-08-15','Muslihat saja','Preman Pensiun 2',2),(7,'002','2015-08-14','Dikdik','Khasanah Dunia Pencopetan',1),(8,'003','2015-08-21','Dikdik','Khasanah Dunia Pencopetan',1),(9,'004','2015-08-11','Muslihat saja','Preman Pensiun 3',1),(10,'005','2015-08-10','Dikdik','Khasanah Dunia Pencopetan',2),(11,'006','2015-08-11','Dikdik','Khasanah Dunia Pencopetan',1),(12,'007','2015-08-13','Muslihat saja','Preman Pensiun 4',1),(13,'008','2015-08-22','Dikdik','Khasanah Dunia Pencopetan',2),(14,'009','2015-08-12','Dikdik','Khasanah Dunia Pencopetan',1),(15,'010','2015-08-14','Muslihat saja','Preman Pensiun 5',1),(16,'011','2015-08-12','Dikdik','Khasanah Dunia Pencopetan',2),(17,'012','2015-08-11','Dikdik','Khasanah Dunia Pencopetan',1),(18,'013','2015-08-20','Muslihat saja','Preman Pensiun 6',2),(19,'014','2015-08-18','Dikdik','Khasanah Dunia Pencopetan',1),(20,'015','2015-08-10','Dikdik','Khasanah Dunia Pencopetan',1),(21,'016','2015-08-20','Muslihat saja','Preman Pensiun 7',2),(22,'017','2015-08-13','Dikdik','Khasanah Dunia Pencopetan',1),(23,'018','2015-08-19','Dikdik','Khasanah Dunia Pencopetan',2),(24,'019','2015-08-12','Muslihat saja','Preman Pensiun 8',1);
/*!40000 ALTER TABLE `perkara` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rawMessages`
--

DROP TABLE IF EXISTS `rawMessages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rawMessages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `datetime` date DEFAULT NULL,
  `sender` varchar(15) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rawMessages`
--

LOCK TABLES `rawMessages` WRITE;
/*!40000 ALTER TABLE `rawMessages` DISABLE KEYS */;
/*!40000 ALTER TABLE `rawMessages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_disposisi`
--

DROP TABLE IF EXISTS `ref_disposisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_disposisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tujuan_disposisi` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_disposisi`
--

LOCK TABLES `ref_disposisi` WRITE;
/*!40000 ALTER TABLE `ref_disposisi` DISABLE KEYS */;
INSERT INTO `ref_disposisi` VALUES (1,'Sekretaris Kelurahan'),(2,'Kasi Pemerintahan'),(3,'Kasi Ekonomi dan Pembangunan'),(4,'Kasi Pemberdayaan Masyarakat dan Kesra'),(5,'Kasi Trantib'),(6,'Staff'),(7,'Lurah');
/*!40000 ALTER TABLE `ref_disposisi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_klasifikasi`
--

DROP TABLE IF EXISTS `ref_klasifikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_klasifikasi` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `uraian` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_klasifikasi`
--

LOCK TABLES `ref_klasifikasi` WRITE;
/*!40000 ALTER TABLE `ref_klasifikasi` DISABLE KEYS */;
INSERT INTO `ref_klasifikasi` VALUES (1,'000','Umum','Surat Umum'),(2,'001','Lambang',''),(3,'002','Tanda Kehormatan/Penghargaan',''),(4,'003','Hari Raya / Besar',''),(5,'004','Ucapan',''),(6,'005','Undangan',''),(7,'006','Tanda Jabatan',''),(8,'010','URUSAN DALAM',''),(9,'020','PERALATAN',''),(10,'030','KEKAYAAN DAERAH',''),(11,'040','PERPUST./DOK./KEARS./SANDI',''),(12,'050','PERENCANAAN',''),(13,'060','ORGANISASI/KETATALAKSANAAN',''),(14,'070','PENELITIAN',''),(15,'080','KONFERENSI',''),(16,'090','PERJALANAN DINAS',''),(17,'100','PEMERINTAHAN',''),(18,'110','PEMERINTAH PUSAT',''),(19,'120','PEMERINTAH DAERAH Tk.I',''),(20,'130','PEMERINTAH DAERAH TK.II',''),(21,'140','DESA/KELURAHAN',''),(22,'144','Lembaga-lembaga Tk.Kelurahan',''),(23,'149','RT/RW',''),(24,'150','MPR/DPR',''),(25,'160','DPRD Tk.I',''),(26,'170','DPRD Tk. II',''),(27,'180','HUKUM',''),(28,'190','HUBUNGAN LUAR NEGERI',''),(29,'200','POLITIK',''),(30,'210','KEPARTAIAN',''),(31,'220','ORGANISASI KEMASYARAKATAN',''),(32,'230','ORG.PROFESI DAN FUNGSIONAL',''),(33,'240','ORGANISASI PEMUDA',''),(34,'250','ORG.BURUH, TANI DAN NELAYAN',''),(35,'260','ORGANISASI WANITA',''),(36,'270','PEMILIHAN UMUM',''),(37,'300','KEAMANAN/KETERTIBAN UMUM',''),(38,'310','PERTAHANAN',''),(39,'320','KEMILITERAN',''),(40,'330','KEAMANAN',''),(41,'340','PERTAHANAN SIPIL',''),(42,'350','KEJAHATAN',''),(43,'360','BENCANA',''),(44,'370','KECELAKAAN',''),(45,'400','KESEJAHTERAAN RAKYAT',''),(46,'410','-',''),(47,'420','PENDIDIKAN',''),(48,'430','KEBUDAYAAN',''),(49,'440','KESEHATAN',''),(50,'450','AGAMA',''),(51,'460','SOSIAL',''),(52,'470','KEPENDUDUKAN',''),(53,'480','MEDIA MASA',''),(54,'500','PEREKONOMIAN',''),(55,'510','PERDAGANGAN',''),(56,'520','PERTANIAN',''),(57,'530','PERINDUSTRIAN',''),(58,'540','PERTAMBANGAN KESAMUDRAAN',''),(59,'550','PERHUBUNGAN',''),(60,'560','TENAGA KERJA',''),(61,'570','PERMODALAN',''),(62,'580','PERBANKAN/MONETER',''),(63,'590','AGRARIA',''),(64,'600','PEKERJAAN UMUM',''),(65,'610','PENGAIRAN',''),(66,'620','JALAN',''),(67,'630','JEMBATAN',''),(68,'640','BANGUNAN',''),(69,'650','TATA KOTA',''),(70,'660','TATA LINGKUNGAN',''),(71,'670','KETENAGAAN',''),(72,'680','PERALATAN',''),(73,'690','AIR MINUM',''),(74,'700','PENGAWASAN',''),(75,'710','BIDANG PEMERINTAHAN',''),(76,'720','BIDANG POLITIK',''),(77,'730','BIDANG KEAMANAN/KETERTIBAN',''),(78,'740','BIDANG KESRA',''),(79,'750','BIDANG PEREKONOMIAN',''),(80,'760','BIDANG PEKERJAAN UMUM',''),(81,'770','-',''),(82,'780','BIDANG KEPEGAWAIAN',''),(83,'790','BIDANG KEUANGAN',''),(84,'800','KEPEGAWAIAN',''),(85,'810','PENGADAAN',''),(86,'820','MUTASI',''),(87,'830','KEDUDUKAN',''),(88,'840','KESEJAHTERAAN PEGAWAI',''),(89,'850','CUTI',''),(90,'860','PENILAIAN',''),(91,'870','TATA USAHA KEPEGAWAIAN',''),(92,'880','PEMBERHENTIAN',''),(93,'890','PENDIDIKAN PEGAWAI',''),(94,'900','KEUANGAN',''),(95,'910','ANGGARAN',''),(96,'920','OTORISASI',''),(97,'930','VERIFIKASI',''),(98,'940','PEMBUKUAN',''),(99,'950','PERBENDAHARAAN',''),(100,'960','PEMBINAAN KEBENDAHARAAN',''),(101,'970','PENDAPATAN',''),(102,'980','-',''),(103,'990','BENDAHARAWAN','');
/*!40000 ALTER TABLE `ref_klasifikasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_sifat_surat`
--

DROP TABLE IF EXISTS `ref_sifat_surat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_sifat_surat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_sifat_surat`
--

LOCK TABLES `ref_sifat_surat` WRITE;
/*!40000 ALTER TABLE `ref_sifat_surat` DISABLE KEYS */;
INSERT INTO `ref_sifat_surat` VALUES (1,'Biasa'),(2,'Penting'),(3,'Rahasia'),(4,'Segera');
/*!40000 ALTER TABLE `ref_sifat_surat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `sender` varchar(15) DEFAULT NULL,
  `rwNumber` int(5) unsigned DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surat_masuk`
--

DROP TABLE IF EXISTS `surat_masuk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `kode_surat_masuk` varchar(30) NOT NULL,
  `no_surat_masuk` varchar(15) NOT NULL,
  `asal_surat_masuk` varchar(100) NOT NULL,
  `tgl_surat_masuk` date NOT NULL,
  `status_surat_masuk` varchar(50) NOT NULL,
  `perihal_surat_masuk` text NOT NULL,
  `tgl_penyelesaian` date DEFAULT NULL,
  `no_agenda` varchar(30) NOT NULL,
  `lampiran` varchar(100) NOT NULL,
  `tgl_diterima` date NOT NULL,
  `pengolah` varchar(50) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `status_disposisi` int(11) NOT NULL,
  PRIMARY KEY (`id_surat_masuk`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surat_masuk`
--

LOCK TABLES `surat_masuk` WRITE;
/*!40000 ALTER TABLE `surat_masuk` DISABLE KEYS */;
INSERT INTO `surat_masuk` VALUES (2,'003','12010','WALIKOTA CIMAHI','2016-07-09','Biasa','Lebaran','2016-07-09','0001','House-GM1-04-800x6611.jpg','2016-07-09','0','',3),(3,'230','123.3/34.2016','WAKIL WALIKOTA CIMAHI','2016-07-11','Penting','undangan','2016-07-11','0002','House-GM1-04-800x6612.jpg','2016-07-10','0','keterangan',3),(4,'360','33','KECAMATAN CIMAHI SELATAN','2016-07-19','Segera','tes','0000-00-00','0003','','2016-07-31','0','',3),(7,'730','33333','KANTOR LINGKUNGAN HIDUP','2016-08-30','Biasa','tes','0000-00-00','0004','java_lect_215.pdf','2016-08-06','Agus Irwan Kustiawan, S.IP','3',1);
/*!40000 ALTER TABLE `surat_masuk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_aplikasi`
--

DROP TABLE IF EXISTS `t_aplikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_aplikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `desc` varchar(150) DEFAULT NULL,
  `projectName` varchar(150) DEFAULT NULL,
  `developedBy` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_aplikasi`
--

LOCK TABLES `t_aplikasi` WRITE;
/*!40000 ALTER TABLE `t_aplikasi` DISABLE KEYS */;
INSERT INTO `t_aplikasi` VALUES (1,'.:: SIMLAPER ::.','.:: SIMLAPER ::.','Proyek Perubahan Diklatpim IV - Iyan','Developed by Riza Fauzi Rahman dan Ismail');
/*!40000 ALTER TABLE `t_aplikasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_instansi`
--

DROP TABLE IF EXISTS `tr_instansi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_instansi` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kepsek` varchar(100) NOT NULL,
  `nip_kepsek` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_instansi`
--

LOCK TABLES `tr_instansi` WRITE;
/*!40000 ALTER TABLE `tr_instansi` DISABLE KEYS */;
INSERT INTO `tr_instansi` VALUES (1,'Kelurahan Leuwigajah','Jl. Sadarmanah No.11 Telp/Fax 022-6672995 Cimahi 40532','Rully Sulfanorida, ST','19710127 200501 1 004','Copy_of_100_63181.JPG');
/*!40000 ALTER TABLE `tr_instansi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-24 12:32:43
