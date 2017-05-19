-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2014 at 09:40 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forkit`
--

-- --------------------------------------------------------

--
-- Table structure for table `forkit_cats`
--

CREATE TABLE IF NOT EXISTS `forkit_cats` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  `cat_status` tinyint(1) NOT NULL,
  `cat_created` int(11) NOT NULL,
  `cat_updated` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `forkit_cats`
--

INSERT INTO `forkit_cats` (`cat_id`, `cat_name`, `cat_status`, `cat_created`, `cat_updated`) VALUES
(1, 'Web Development', 1, 1406617258, 1406617258),
(2, 'Web Design', 1, 1406617258, 1406617258),
(3, 'Hiburan Malam', 1, 1406617258, 1406617258),
(4, 'Teknologi', 1, 1406567668, 1406567668),
(5, 'Entertainment', 1, 1406567668, 1406567668),
(6, 'Selebriti', 1, 1406567668, 1406567668),
(7, 'Olah Raga', 1, 1406567668, 1406567668),
(8, 'Musik', 1, 1406567668, 1406567668),
(9, 'Film', 1, 1406567668, 1406567668);

-- --------------------------------------------------------

--
-- Table structure for table `forkit_forum_photos`
--

CREATE TABLE IF NOT EXISTS `forkit_forum_photos` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `forkit_forum_photos`
--

INSERT INTO `forkit_forum_photos` (`photo_id`, `topic_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `forkit_pm`
--

CREATE TABLE IF NOT EXISTS `forkit_pm` (
  `pm_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_sender` int(11) NOT NULL,
  `user_receiver` int(11) NOT NULL,
  `pm_title` text NOT NULL,
  `pm_descript` text NOT NULL,
  `pm_created` int(11) NOT NULL,
  `pm_updated` int(11) NOT NULL,
  `pm_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forkit_pm_answer`
--

CREATE TABLE IF NOT EXISTS `forkit_pm_answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `pm_id` int(11) NOT NULL,
  `user_sender` int(11) NOT NULL,
  `user_receiver` int(11) NOT NULL,
  `answer` text NOT NULL,
  `answer_created` int(11) NOT NULL,
  `answer_updated` int(11) NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forkit_pm_attachment`
--

CREATE TABLE IF NOT EXISTS `forkit_pm_attachment` (
  `attach_id` int(11) NOT NULL AUTO_INCREMENT,
  `pm_id` int(11) NOT NULL,
  `attach_filetype` varchar(50) NOT NULL,
  `attach_filename` varchar(100) NOT NULL,
  `attach_filesize` int(11) NOT NULL,
  PRIMARY KEY (`attach_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forkit_replies`
--

CREATE TABLE IF NOT EXISTS `forkit_replies` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply` text NOT NULL,
  `reply_created` int(11) NOT NULL,
  `reply_updated` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `forkit_replies`
--

INSERT INTO `forkit_replies` (`reply_id`, `topic_id`, `user_id`, `reply`, `reply_created`, `reply_updated`, `parent_id`) VALUES
(1, 1, 4, 'kok cuma gitu aja ya, jadi bingung gue nich... :*', 1406950777, 1406950777, 0),
(2, 3, 4, 'bolehlah tutorialnya, lumayan mudah kok untuk dipelajarin dan dimengerti\r\nbisa gak belajar sama master.... :''(', 1406952495, 1406952495, 0),
(3, 1, 2, 'emank maunya gimana, mau ngajak berantem ayoooooooooooooooooooooooooooooooooooooooooo <3\npostingannya kan belum selesai masih mau dilanjut lagi, dasaaaaaaaaaaar.... :O', 1406952730, 1406952730, 1),
(4, 1, 2, 'gimana ayo berantem.......... :/', 1406952811, 1406952811, 1),
(5, 4, 5, 'ga kuat coy, pake bahasa inggris, keren ya.. :(', 1406956427, 1406956427, 0),
(6, 4, 5, 'hi mulan, apa kabar bisa kenalan ga yach...\r\nkamu cantik ya, seksi lagi... ^_^  :*', 1406956555, 1406956555, 0),
(7, 3, 5, 'oklah... :3', 1406959695, 1406959695, 2),
(8, 1, 4, 'nasib-nasib.... :O', 1406962940, 1406962940, 0),
(9, 3, 3, 'coba lagi dech... -_-', 1406965487, 1406965487, 0),
(10, 3, 4, 'wow....................... 8)', 1406965958, 1406965958, 0),
(11, 3, 4, 'mantaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaap....\r\n8) ^_^ -_- 8|', 1406966007, 1406966007, 10),
(12, 4, 4, 'biasa aja kali....', 1406966419, 1406966419, 5),
(13, 4, 4, 'ah masa sich, kamu gombal dech... :)', 1406966441, 1406966441, 6),
(14, 3, 2, 'boleh kok, silahkan menanyakan apa yang ingin dipelajari sama saya... :v', 1406988688, 1406988688, 2),
(15, 3, 2, 'sampai nangis-nangis gitu yach.... -_-', 1406991587, 1406991587, 2),
(16, 4, 6, 'keren buangeet bahasa inggrisnya,,\r\nasli ga mudeng gue... :)', 1406994740, 1406994740, 0),
(17, 2, 2, 'mana komentarnya cuy,,,, :(', 1406999341, 1406999341, 0),
(18, 13, 4, 'wow, gileeeeeee nich Facebook,, keren banget ya kalau soal cari duit ^_^', 1407001412, 1407001412, 0),
(19, 15, 4, 'alah biasa aja, gitu aja kok diberitain\r\nga mutu tau ga... :p', 1407001639, 1407001639, 0),
(20, 1, 7, 'ah masa sich.. :) :* :v', 1407021540, 1407021540, 0),
(21, 6, 7, 'memanglah wanita ganas... :)', 1407022198, 1407022198, 0),
(22, 1, 2, 'ga berani kan..... ;)', 1407206031, 1407206031, 4),
(23, 14, 6, 'muantaaaaaaaaaaaaappp... :D', 1407233697, 1407233697, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forkit_topics`
--

CREATE TABLE IF NOT EXISTS `forkit_topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `descript` text NOT NULL,
  `views` int(11) NOT NULL,
  `topic_created` int(11) NOT NULL,
  `topic_updated` int(11) NOT NULL,
  `topic_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `forkit_topics`
--

INSERT INTO `forkit_topics` (`topic_id`, `cat_id`, `user_id`, `title`, `descript`, `views`, `topic_created`, `topic_updated`, `topic_status`) VALUES
(1, 1, 2, 'Aplikasi Database Pegawai Sederhana dengan PHP dan MySQL', 'Baru-baru ini saya telah menyelesaikan sebuah aplikasi database pegawai sederhana dengan menggunakan beberapa bahasa pemrograman seperti PHP, MySQL, CSS, dan JavaScript. Aplikasi ini menitikberatkan kepada implementasi PHP dan MySQL dalam pengembangan aplikasi dinamis dan interaktif yang dalam hal ini adalah pengolahan data pegawai yang meliputi aktivitas penambahan data pegawai, ubah data, menghapus data serta menampilkan data pegawai.\r\n\r\nUntuk menunjang proses pengembangan telah dikembangkan beberapa fungsi-fungsi buatan yang bertujuan untuk mempermudah dan mempercepat proses penulisan kode program sehingga diharapkan dapat menghemat waktu pengembangan aplikasi.\r\n\r\nSedangkan untuk struktur tablenya, dapat dilihat sebagai berikut:\r\n\r\n[code]CREATE TABLE IF NOT EXISTS `pegawai` (\r\n  `pegawai_id` int(11) NOT NULL AUTO_INCREMENT,\r\n  `kode` varchar(10) NOT NULL,\r\n  `nama` varchar(50) NOT NULL,\r\n  `alamat` varchar(100) NOT NULL,\r\n  `gaji` double NOT NULL,\r\n  `tanggal_gabung` int(11) NOT NULL,\r\n  PRIMARY KEY (`pegawai_id`)\r\n) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;[/code]\r\n\r\nKemudian buat sebuah file bernama config.php yang berfungsi untuk mengatur konfigurasi awal website sebagai berikut:\r\n\r\n[code]<?php\r\n/**\r\n * Aplikasi Pegawai Sederhana\r\n *\r\n * @file config.php\r\n * @author Andrew Hutauruk | http://blizze.wordpress.com\r\n * @date 17 Aug 2012 23:40\r\n */\r\n \r\n/**\r\n * Koneksi ke server dan memilih database\r\n */\r\nmysql_connect( ''localhost'', ''root'', '''' );\r\nmysql_select_db( ''blog'' );\r\n \r\n/**\r\n * Fungsi sederhana untuk mempersingkat penulisan kdoe program\r\n * Bersifat opsional, tetap bisa menggunakan fungsi PHP pada umumnya\r\n */\r\nfunction hajar_coy( $query ) { return mysql_query( $query ); }\r\nfunction itung_jumlahnya( $query ) { return mysql_num_rows( $query ); }\r\nfunction uraikan( $query ) { return mysql_fetch_array( $query ); }\r\nfunction bersihkan( $query ) { return mysql_real_escape_string( $query ); }\r\n \r\ndefine( ''URL'', ''http://localhost/blog'' );\r\ndefine( ''NAME'', ''Aplikasi Data Pegawai Sederhana'' );\r\n$option = isset( $_GET[''option''] ) ? $_GET[''option''] : '''';\r\n$action = isset( $_POST[''action''] ) ? $_POST[''action''] : '''';\r\n?>[/code]\r\n\r\nDemikianlah forum saya kali ini.', 300, 1406801823, 1406942241, 1),
(2, 1, 2, 'Membuat Program Media Player MP3 Sederhana dengan VB6', 'Meski akan segera UAS namun hasrat untuk tetep menulis tidak tertahankan lagi apalagi blog ini seakan tidak keurus lagi dikarenakan beragam kesibukan yang melanda. Namun, di tengah berbagai kesibukan yang melanda kali ini saya kembali lagi memposting sebuah artikel sederhana dan masih seputar pemrograman yaitu program tentang media player untuk format file MP3. \r\n\r\nMeski sangat sederhana, namun program ini dapat Anda jadikan sebagai media maupun referensi untuk memulai membuat program serupa atau bagi Anda yang sudah mahir Anda juga dapat memahami teknik maupun coding yang terdapat dalam program ini untuk lebih dikembangkan lagi sehingga menjadi program yang lebih kompleks dan menarik. Berikut gambar dari program final yang telah berhasil dirancang.\r\n\r\nUntuk saat ini program ini tidak membutuhkan sebuah database karena data yang kita ambil dan mainkan hanya berasal dari local hard disk meski memang bisa juga jika dibuatkan database khusus untuk menyimpan data lagu baik yang bersifat flat database maupun menggunakan tool RDBMS.\r\n\r\nKonsep yang diusung dalam program ini sangatlah sederhana dimana adanya berbagai tombol-tombol yang secara umum terdapat di dalam aplikasi media player MP3. Pengguna dapat memilih sbeuah file MP3 tunggal dan akan langsung dimainkan. Atau pengguna juga bisa memilih beberapa file lagu MP3 lalu memainkan lagu mana yang disukai, bisa dengan menekan tombol Play atau dengan double click.\r\n\r\n[b]Kebutuhan dasar untuk pengembangan program ini adalah sebagai berikut:\r\n1. Pastinya IDE Visual Studio 6 donk\r\n2. Component Microsoft Multimedia Control 6.0\r\n3. Component Microsoft Common Dialog Control 6.0\r\n4. Component Microsoft Windows Common Control 6.0 (SP6)\r\n5. File OCX tambahan lavolpeButton (cari aja di internet)\r\n6. File OCX tambahan ctrlLine (cari aja di internet)[/b]\r\n\r\n[code]Option Explicit\r\n \r\nDim z As String\r\nDim A, B, C, Min, Min1, Sec, Sec1, totFiles As Integer\r\n \r\nPrivate Sub Check1_Click()\r\n    If mc1.Silent = False Then\r\n        mc1.Silent = True\r\n    ElseIf mc1.Silent = True Then\r\n        mc1.Silent = False\r\n    End If\r\nEnd Sub\r\n \r\nPrivate Sub Form_Load()\r\n    totFiles = 0\r\n    Label8.Caption = totFiles + List1.ListCount\r\n     \r\n    Slider2.Value = GetVolume\r\nEnd Sub\r\n \r\nPrivate Sub List1_Click()\r\n    z = List1\r\n    mc1.FileName = List1\r\nEnd Sub\r\n \r\nPrivate Sub List1_DblClick()\r\n    mc1.Command = "Close"\r\n    lvb3.Caption = "Play"\r\n    If List1.ListCount > 0 Then\r\n        mc1.Command = "Open"\r\n        mc1.Command = "Play"\r\n        lvb3.Caption = "Stop"\r\n        Label2.Caption = List1.Text\r\n    Else\r\n        Exit Sub\r\n    End If\r\nEnd Sub\r\n \r\nPrivate Sub lvb1_Click()\r\n    totFiles = 0\r\n    mc1.Command = "Close"\r\n    cd1.ShowOpen\r\n    mc1.FileName = cd1.FileName\r\n    mc1.Command = "Open"\r\n    mc1.Command = "Play"\r\n    lvb3.Caption = "Stop"\r\n    Label2.Caption = cd1.FileTitle\r\n    List1.Clear\r\n    List1.AddItem cd1.FileTitle\r\n    Label8.Caption = totFiles + List1.ListCount\r\nEnd Sub\r\n \r\nPrivate Sub lvb2_Click()\r\n    mc1.Command = "Close"\r\n    On Error Resume Next\r\n    If List1.ListCount = 0 Then\r\n        MsgBox "Sorry, no file selected. Please select one...", vbExclamation, "Select file"\r\n    Else:\r\n        List1.ListIndex = List1.ListIndex - 1\r\n        mc1.FileName = List1\r\n        mc1.Command = "Open"\r\n        mc1.Command = "Play"\r\n        lvb3.Caption = "Stop"\r\n        Label2.Caption = List1.Text\r\n    End If\r\nEnd Sub\r\n \r\nPrivate Sub lvb3_Click()\r\n    If List1.ListCount = 0 Then\r\n        MsgBox "Sorry, no file found. Please choose at least one file...", vbExclamation, "Select file"\r\n        lvb1.SetFocus\r\n    Else\r\n        If lvb3.Caption = "Play" Then\r\n            mc1.Command = "Open"\r\n            mc1.Command = "Play"\r\n            lvb3.Caption = "Stop"\r\n            Label2.Caption = List1.Text\r\n        ElseIf lvb3.Caption = "Stop" Then\r\n            mc1.Command = "Close"\r\n            lvb3.Caption = "Play"\r\n            Label1.Caption = "00:00"\r\n            Label2.Caption = "No file selected. Choose one and play it..."\r\n            Label3.Caption = "00"\r\n            Label4.Caption = "00"\r\n            Slider1.SelStart = 0\r\n            Slider1.SelLength = 0\r\n        End If\r\n    End If\r\nEnd Sub\r\n \r\nPrivate Sub lvb4_Click()\r\n    If List1.ListCount = 0 Then\r\n        MsgBox "Sorry, no file selected. Please select at least file one...", vbExclamation, "Select file"\r\n    Else\r\n        If lvb4.Caption = "Pause" Then\r\n            mc1.Command = "Pause"\r\n            lvb4.Caption = "Play"\r\n        Else\r\n            mc1.Command = "Play"\r\n            lvb4.Caption = "Pause"\r\n        End If\r\n    End If\r\nEnd Sub\r\n \r\nPrivate Sub lvb5_Click()\r\n    mc1.Command = "Close"\r\n    On Error Resume Next\r\n    If List1.ListCount = 0 Then\r\n        MsgBox "Sorry, no file selected. Please select one...", vbExclamation, "Select file"\r\n    Else:\r\n        List1.ListIndex = List1.ListIndex + 1\r\n        mc1.FileName = List1\r\n        mc1.Command = "Open"\r\n        mc1.Command = "Play"\r\n        lvb3.Caption = "Stop"\r\n        Label2.Caption = List1.Text\r\n    End If\r\nEnd Sub\r\n \r\nPrivate Sub lvb6_Click()\r\n    totFiles = 0\r\n    cd2.FileName = "*.mp3"\r\n    cd2.ShowOpen\r\n    List1.AddItem cd2.FileTitle\r\n    Label8.Caption = totFiles + List1.ListCount\r\nEnd Sub\r\n \r\nPrivate Sub lvb7_Click()\r\n    If List1.ListIndex = -1 Then\r\n        MsgBox "Sorry, no file selected. Please select at least one...", vbExclamation, "Select File"\r\n    Else\r\n        List1.RemoveItem List1.ListIndex\r\n    End If\r\nEnd Sub\r\n \r\nPrivate Sub lvb8_Click()\r\n    totFiles = 0\r\n    List1.Clear\r\n    mc1.Command = "Close"\r\n    lvb3.Caption = "Play"\r\n    lvb4.Caption = "Pause"\r\n    Label1.Caption = "00:00"\r\n    Label2.Caption = "No file selected. Choose one and play it..."\r\n    Label3.Caption = "00"\r\n    Label4.Caption = "00"\r\n    Label8.Caption = totFiles + List1.ListCount\r\n    Slider1.SelStart = 0\r\n    Slider1.SelLength = 0\r\nEnd Sub\r\n \r\nPrivate Sub mc1_StatusUpdate()\r\n    If mc1.FileName = "" Then\r\n        lvb3.Caption = "Play"\r\n    Else\r\n        lvb3.Caption = "Stop"\r\n    End If\r\n     \r\n    Slider1.Max = mc1.Length\r\n    Slider1.Value = mc1.Position\r\n    A = mc1.Length Mod 1000\r\n    B = (mc1.Length - A) / 1000\r\n    Label4.Caption = Format(B Mod 100, "0#")\r\n    Label3.Caption = Format(Round((B - Val(Label4.Caption)) / 60, 0), "0#")\r\n     \r\n    C = mc1.Position Mod 1000\r\n    Sec = ((mc1.Position - C) / 1000) Mod 60\r\n    Label1.Caption = Sec\r\n     \r\n    If Sec = 0 Then\r\n        Min = Min + 1\r\n    End If\r\n     \r\n    Min = Min Mod 60\r\n    Label1.Caption = Format(Min, "0#") & ":" & Format(Sec, "0#")\r\n     \r\n    If Check1.Value = 1 Then\r\n        mc1.Silent = True\r\n    Else\r\n        mc1.Silent = False\r\n    End If\r\n     \r\n    On Error Resume Next\r\n    If mc1.Position = mc1.Length Then\r\n        List1.ListIndex = List1.ListIndex + 1\r\n        mc1.Command = "Close"\r\n        mc1.FileName = List1\r\n        mc1.Command = "Open"\r\n        mc1.Command = "Play"\r\n    End If\r\nEnd Sub\r\n \r\nPrivate Sub Slider2_Change()\r\n    SetVolume Slider2.Value\r\nEnd Sub\r\n \r\nPrivate Sub Slider2_Scroll()\r\n    Slider2_Change\r\nEnd Sub[/code]\r\n\r\nSedangkan berikut ini merupakan API untuk mengatur Master Volume artinya nilai volume bisa diatur dari program aplikasi yang telah kita rancang sebelumnya.\r\n\r\n[code]Option Explicit\r\n \r\nPrivate hMixerHandle As Long\r\nPrivate uMixerControls(20) As MIXERCONTROL\r\n \r\nPrivate Const MMSYSERR_NOERROR = 0\r\nPrivate Const MAXPNAMELEN = 32\r\nPrivate Const MIXER_LONG_NAME_CHARS = 64\r\nPrivate Const MIXER_SHORT_NAME_CHARS = 16\r\nPrivate Const MIXER_GETLINEINFOF_COMPONENTTYPE = &H3&\r\nPrivate Const MIXER_GETLINECONTROLSF_ONEBYTYPE = &H2&\r\nPrivate Const MIXER_SETCONTROLDETAILSF_VALUE = &H0&\r\nPrivate Const MIXERLINE_COMPONENTTYPE_DST_FIRST = &H0&\r\nPrivate Const MIXERLINE_COMPONENTTYPE_DST_SPEAKERS = &H4\r\nPrivate Const MIXERCONTROL_CONTROLTYPE_VOLUME = &H50030001\r\nPrivate Const MIXER_GETCONTROLDETAILSF_VALUE = &H0&\r\n \r\nPrivate Declare Function mixerOpen Lib "winmm.dll" (phmx As Long, _\r\nByVal uMxId As Long, ByVal dwCallback As Long, ByVal dwInstance As Long, _\r\nByVal fdwOpen As Long) As Long\r\nPrivate Declare Function mixerGetLineInfo Lib "winmm.dll" Alias _\r\n"mixerGetLineInfoA" (ByVal hmxobj As Long, pmxl As MIXERLINE, _\r\nByVal fdwInfo As Long) As Long\r\nPrivate Declare Function mixerGetLineControls Lib "winmm.dll" Alias _\r\n"mixerGetLineControlsA" (ByVal hmxobj As Long, pmxlc As MIXERLINECONTROLS, _\r\nByVal fdwControls As Long) As Long\r\nPrivate Declare Function mixerSetControlDetails Lib "winmm.dll" (ByVal hmxobj _\r\nAs Long, pmxcd As MIXERCONTROLDETAILS, ByVal fdwDetails As Long) As Long\r\nPrivate Declare Function mixerClose Lib "winmm.dll" (ByVal hmx As Long) As Long\r\nPrivate Declare Sub CopyMemory Lib "kernel32" Alias "RtlMoveMemory" _\r\n(Destination As Any, Source As Any, ByVal Length As Long)\r\nPrivate Declare Function GlobalAlloc Lib "kernel32" (ByVal wFlags As Long, _\r\nByVal dwBytes As Long) As Long\r\nPrivate Declare Function GlobalLock Lib "kernel32" (ByVal hMem As Long) As Long\r\nPrivate Declare Function GlobalFree Lib "kernel32" (ByVal hMem As Long) As Long\r\n \r\nPrivate Declare Function mixerGetNumDevs Lib "winmm.dll" () As Long\r\nPrivate Declare Sub CopyStructFromPtr Lib "kernel32" Alias "RtlMoveMemory" (struct As Any, ByVal ptr As Long, ByVal cb As Long)\r\nPrivate Declare Function mixerGetControlDetails Lib "winmm.dll" Alias "mixerGetControlDetailsA" (ByVal hmxobj As Long, pmxcd As MIXERCONTROLDETAILS, ByVal fdwDetails As Long) As Long\r\n \r\nPublic Enum VOL_CONTROL\r\nSPEAKER = 0\r\nEnd Enum\r\n \r\nPrivate Type MIXERCONTROL\r\ncbStruct As Long\r\ndwControlID As Long\r\ndwControlType As Long\r\nfdwControl As Long\r\ncMultipleItems As Long\r\nszShortName As String * MIXER_SHORT_NAME_CHARS\r\nszName As String * MIXER_LONG_NAME_CHARS\r\nlMinimum As Long\r\nlMaximum As Long\r\nRESERVED(10) As Long\r\nEnd Type\r\n \r\nPrivate Type MIXERCONTROLDETAILS\r\ncbStruct As Long\r\ndwControlID As Long\r\ncChannels As Long\r\nitem As Long\r\ncbDetails As Long\r\npaDetails As Long\r\nEnd Type\r\n \r\nPrivate Type MIXERCONTROLDETAILS_UNSIGNED\r\ndwValue As Long\r\nEnd Type\r\n \r\nPrivate Type MIXERLINE\r\ncbStruct As Long\r\ndwDestination As Long\r\ndwSource As Long\r\ndwLineID As Long\r\nfdwLine As Long\r\ndwUser As Long\r\ndwComponentType As Long\r\ncChannels As Long\r\ncConnections As Long\r\ncControls As Long\r\nszShortName As String * MIXER_SHORT_NAME_CHARS\r\nszName As String * MIXER_LONG_NAME_CHARS\r\ndwType As Long\r\ndwDeviceID As Long\r\nwMid As Integer\r\nwPid As Integer\r\nvDriverVersion As Long\r\nszPname As String * MAXPNAMELEN\r\nEnd Type\r\n \r\nPrivate Type MIXERLINECONTROLS\r\ncbStruct As Long\r\ndwLineID As Long\r\ndwControl As Long\r\ncControls As Long\r\ncbmxctrl As Long\r\npamxctrl As Long\r\nEnd Type\r\n \r\nPublic Function SetVolume(VolumeLevel As Long) As Boolean\r\nDim hmx As Long\r\nDim uMixerLine As MIXERLINE\r\nDim uMixerControl As MIXERCONTROL\r\nDim uMixerLineControls As MIXERLINECONTROLS\r\nDim uDetails As MIXERCONTROLDETAILS\r\nDim uUnsigned As MIXERCONTROLDETAILS_UNSIGNED\r\nDim RetValue As Long\r\nDim hMem As Long\r\n \r\n'' VolumeLevel value must be between 0 and 100\r\nIf VolumeLevel < 0 Or VolumeLevel > 100 Then GoTo error\r\n \r\n'' Open the mixer\r\nRetValue = mixerOpen(hmx, 0, 0, 0, 0)\r\nIf RetValue <> MMSYSERR_NOERROR Then GoTo error\r\n \r\n'' Initialize MIXERLINE structure and call mixerGetLineInfo\r\nuMixerLine.cbStruct = Len(uMixerLine)\r\nuMixerLine.dwComponentType = MIXERLINE_COMPONENTTYPE_DST_SPEAKERS\r\nRetValue = mixerGetLineInfo(hmx, uMixerLine, _\r\nMIXER_GETLINEINFOF_COMPONENTTYPE)\r\nIf RetValue <> MMSYSERR_NOERROR Then GoTo error\r\n \r\n'' Initialize MIXERLINECONTROLS strucure and\r\n'' call mixerGetLineControls\r\nuMixerLineControls.cbStruct = Len(uMixerLineControls)\r\nuMixerLineControls.dwLineID = uMixerLine.dwLineID\r\nuMixerLineControls.dwControl = MIXERCONTROL_CONTROLTYPE_VOLUME\r\nuMixerLineControls.cControls = 1\r\nuMixerLineControls.cbmxctrl = Len(uMixerControl)\r\n \r\n'' Allocate a buffer to receive the properties of the master volume control\r\n'' and put his address into uMixerLineControls.pamxctrl\r\nhMem = GlobalAlloc(&H40, Len(uMixerControl))\r\nuMixerLineControls.pamxctrl = GlobalLock(hMem)\r\nuMixerControl.cbStruct = Len(uMixerControl)\r\nRetValue = mixerGetLineControls(hmx, uMixerLineControls, _\r\nMIXER_GETLINECONTROLSF_ONEBYTYPE)\r\nIf RetValue <> MMSYSERR_NOERROR Then GoTo error\r\n \r\n'' Copy data buffer into the uMixerControl structure\r\nCopyMemory uMixerControl, ByVal uMixerLineControls.pamxctrl, _\r\nLen(uMixerControl)\r\nGlobalFree hMem\r\nhMem = 0\r\n \r\nuDetails.item = 0\r\nuDetails.dwControlID = uMixerControl.dwControlID\r\nuDetails.cbStruct = Len(uDetails)\r\nuDetails.cbDetails = Len(uUnsigned)\r\n \r\n'' Allocate a buffer in which properties for the volume control are set\r\n'' and put his address into uDetails.paDetails\r\nhMem = GlobalAlloc(&H40, Len(uUnsigned))\r\nuDetails.paDetails = GlobalLock(hMem)\r\nuDetails.cChannels = 1\r\nuUnsigned.dwValue = CLng((VolumeLevel * uMixerControl.lMaximum) / 100)\r\nCopyMemory ByVal uDetails.paDetails, uUnsigned, Len(uUnsigned)\r\n \r\n'' Set new volume level\r\nRetValue = mixerSetControlDetails(hmx, uDetails, _\r\nMIXER_SETCONTROLDETAILSF_VALUE)\r\nGlobalFree hMem\r\nhMem = 0\r\nIf RetValue <> MMSYSERR_NOERROR Then GoTo error\r\n \r\nmixerClose hmx\r\n'' signal success\r\nSetVolume = True\r\nExit Function\r\n \r\nerror:\r\n'' An error occurred\r\n \r\n'' Release resources\r\nIf hmx <> 0 Then mixerClose hmx\r\nIf hMem Then GlobalFree hMem\r\n'' signal failure\r\nSetVolume = False\r\nEnd Function\r\n \r\nPublic Function GetVolume() As Long\r\nOpenMixer (0)\r\nIf GetVolumeP(SPEAKER) >= 0 Or GetVolumeP(SPEAKER) <= 100 Then\r\nGetVolume = GetVolumeP(SPEAKER)\r\nElse\r\nGetVolume = 0\r\nEnd If\r\nCloseMixer\r\nEnd Function\r\n \r\nPublic Function OpenMixer(ByVal MixerNumber As Long) As Long\r\nDim ret As Long\r\n'' is there a mixer available?\r\nIf MixerNumber < 0 Or MixerNumber > mixerGetNumDevs = 1 Then Exit Function\r\n \r\n'' open the mixer\r\nret = mixerOpen(hMixerHandle, MixerNumber, 0, 0, 0)\r\nIf ret <> MMSYSERR_NOERROR Then Exit Function\r\n \r\n'' get the primary line controls by name, (this does not get all of the controls).\r\n \r\n'' speaker (master) volume\r\nret = GetMixerControl(hMixerHandle, MIXERLINE_COMPONENTTYPE_DST_SPEAKERS, MIXERCONTROL_CONTROLTYPE_VOLUME, uMixerControls(SPEAKER))\r\n'' return the mixer handle\r\nOpenMixer = True\r\nEnd Function\r\n \r\nPrivate Function CloseMixer() As Long\r\nCloseMixer = mixerClose(hMixerHandle)\r\nhMixerHandle = 0\r\nEnd Function\r\n \r\nPrivate Function GetVolumeP(Control As VOL_CONTROL) As Long\r\nGetVolumeP = GetControlValue(hMixerHandle, uMixerControls(Control))\r\nEnd Function\r\n \r\nPrivate Function GetMixerControl(ByVal hMixer As Long, ByVal componentType As Long, ByVal ctrlType As Long, ByRef mxc As MIXERCONTROL) As Long\r\n'' This function attempts to obtain a mixer control. Returns True if successful.\r\nDim mxlc As MIXERLINECONTROLS\r\nDim mxl As MIXERLINE\r\nDim hMem As Long\r\nDim ret As Long\r\n \r\nmxl.cbStruct = Len(mxl)\r\nmxl.dwComponentType = componentType\r\n \r\n'' Obtain a line corresponding to the component type\r\nret = mixerGetLineInfo(hMixer, mxl, MIXER_GETLINEINFOF_COMPONENTTYPE)\r\n \r\nIf ret = MMSYSERR_NOERROR Then\r\nmxlc.cbStruct = Len(mxlc)\r\nmxlc.dwLineID = mxl.dwLineID\r\nmxlc.dwControl = ctrlType\r\nmxlc.cControls = 1\r\nmxlc.cbmxctrl = Len(mxc)\r\n \r\n'' Allocate a buffer for the control\r\nhMem = GlobalAlloc(&H40, Len(mxc))\r\nmxlc.pamxctrl = GlobalLock(hMem)\r\nmxc.cbStruct = Len(mxc)\r\n \r\n'' Get the control\r\nret = mixerGetLineControls(hMixer, mxlc, MIXER_GETLINECONTROLSF_ONEBYTYPE)\r\n \r\nIf ret = MMSYSERR_NOERROR Then\r\nGetMixerControl = True\r\n \r\n'' Copy the control into the destination structure\r\nCopyStructFromPtr mxc, mxlc.pamxctrl, Len(mxc)\r\nElse\r\nGetMixerControl = False\r\nEnd If\r\nGlobalFree (hMem)\r\nExit Function\r\nEnd If\r\n \r\nGetMixerControl = False\r\nEnd Function\r\n \r\nPrivate Function GetControlValue(ByVal hMixer As Long, mxc As MIXERCONTROL) As Long\r\n''This function gets the value for a control.\r\n \r\nDim mxcd As MIXERCONTROLDETAILS\r\nDim vol As MIXERCONTROLDETAILS_UNSIGNED\r\nDim hMem As Long\r\nDim ret As Long\r\n \r\nmxcd.item = 0\r\nmxcd.dwControlID = mxc.dwControlID\r\nmxcd.cbStruct = Len(mxcd)\r\nmxcd.cbDetails = Len(vol)\r\n \r\nhMem = GlobalAlloc(&H40, Len(vol))\r\nmxcd.paDetails = GlobalLock(hMem)\r\nmxcd.cChannels = 1\r\n \r\n'' Get the control value\r\nret = mixerGetControlDetails(hMixer, mxcd, MIXER_GETCONTROLDETAILSF_VALUE)\r\n \r\n'' Copy the data into the control value buffer\r\nCopyStructFromPtr vol, mxcd.paDetails, Len(vol)\r\n \r\nIf mxc.lMaximum > 100 Then\r\nGetControlValue = ((vol.dwValue * 100) / (mxc.lMaximum - mxc.lMinimum))\r\nElse\r\nGetControlValue = vol.dwValue\r\nEnd If\r\n \r\nGlobalFree (hMem)\r\nEnd Function[/code]', 71, 1406803412, 1406942109, 1),
(3, 1, 2, 'Konsep Pintar Untuk Perulangan dengan PHP', 'Pada kesempatan yang berbahagia ini, kita akan belajar bagaimana melakukan sebuah perintah perulangan dengan menggunakan bahasa PHP. Tentunya setiap bahasa pemrograman juga mendukung hal yang satu ini demikian juga halnya dengan bahasa PHP. Setiap pengembang aplikasi web dengan menggunakan bahasa PHP diberikan keleluasaan untuk melakukan aktivitas perulangan dengan menggunakan fungsi-fungsi perulangan yang telah disediakan oleh si PHP itu sendiri.\r\n\r\nOkay tanpa banyak cengkunek marilah kita satukan hati dan jiwa raga untuk memulai belajar perulangan dengan menggunakan bahasa PHP. So, siapkan segala perlengkapan perang Anda dan kencangkan sabuk Anda.\r\n\r\n[b]1. WHILE[/b]\r\nPerulangan ini akan melakukan proses iterasi selama nilai pernyataan lebih kecil atau sama dengan nilai penentu. Perhatikan contoh berikut ini:\r\n\r\n[code]<?php\r\n$x = 0;\r\nwhile( $x <= 10) {\r\n    echo "Baris ke - " . $x . "<br>";\r\n    $x++;\r\n}\r\n?>[/code]\r\nContoh program di atas akan melakukan perulangan dengan menampilkan:\r\n"Baris ke - 1"\r\n"Baris ke - 2"\r\ndst... hingga ke 10\r\n\r\n[b]2. FOR[/b]\r\nPerulangan ini akan melakukan iterasi dengna syarat batas awal dan batas akhir sudha diketahui.\r\n\r\n[code]<?php\r\nfor( $x = 1; $x <= 10; $x++) {\r\n    echo "Baris - ke " . $x . "<br>";\r\n}\r\n?>[/code]\r\nProgram perulangan dengan for di atas juga akan menghasilkan output yang sama dengan perulangan dengan menggunakan perintah while di atas.\r\n', 556, 1406775073, 1406941492, 1),
(4, 2, 4, 'HTML 5 For New Web Design Concept From The Scratch', 'Have you ever wonder when you visit a website which displays stunning animation, videos, nice navigation and everything within it?. Or do you even wonder how they create it?. Or at least, do you even curious enough how to create or build it?.\r\n\r\nMay be these questions above to much for you but you as a web designer you must considered to start to use HTML 5 for all of your projects, from now on of course. Because it''s been a common standard now that every sites start to use HTML 5 code to build website.\r\n\r\nThese things below are a very substantial object that you must take care if you have decided to use HTML5 as your layout code.\r\n\r\n[b]1. Never use these words[/b]\r\nIt meas that you have to start to use another words than what is said to be not used. Maybe it''s about not to use several words that against the words.\r\n\r\n[b]2. Always look upwards[/b]\r\nYes, this caution is very strictly which order you to always look upwards but not backwards. Perhaps, you want to look a little to your backwards but please don''t do that OKAY. This is just for your own safety.\r\n\r\n[b]3. That''s all, nothing left.[/b]\r\n\r\nSo, thank you for reading this stupid article about how to use HTML 5 code for your web design projects. -_-  :O', 34, 1406939809, 1407010413, 1),
(5, 2, 5, 'Merancang Template Website Keren dengan HTML 5 dan CSS 3', 'Hallo semuanya agan-agan terkasih dalam nama Anda masing-masing. Apa kabarnya semua semoga sehat-sehat saja ya. Pada kesempatan yang berbahagia ini saya akan berbagi pengetahuan dan ilmu tentang bagaimana merancang sebuah template website yang keren dengan menggunakan bahasa HTML 5 dan CSS 3.\r\n\r\nKedua bahasa ini merupakan suatu pasangan yang sangat cocok jika digunakan untuk membangun sebuah aplikasi website baik untuk website keperluan organisasi, personal website, pemerintahan, institusi LSM dan lain sebagainya.\r\n\r\nBaiklah tanpa memperpanjang waktu maka saya akan memulai pelajaran kita hari ini. So, segera siapkan segala perlengkapan perang Anda ya. :)\r\n\r\nKetiklah perintah berikut dan simpan sebagai [b]index.php[/b]\r\n[code]<!DOCTYPE HTML>\r\n<html>\r\n<head>\r\n<title>My Website</title>\r\n<link rel="stylesheet" type="text/css" href="css/style.css" />\r\n</head>\r\n<body>\r\n\r\n<!-- ketik content website disini //-->\r\n\r\n</body>\r\n</html>[/code]\r\n\r\nProgram di atas adalah tampilan utama yang akan menampung segala konten maupun informasi yang akan kita tampilkan di dalam website kita.', 8, 1406996982, 1406996982, 1),
(6, 6, 5, 'Aih, Miranda Kerr Topless untuk Iklan Celana Jeans', '[b]Jakarta[/b] - Miranda Kerr kembali memamerkan tubuhnya untuk kampanye produk celana jeans terbaru 7 For All Mankind (7FAM). Tampil seksi, model asal Australia tersebut lagi-lagi berpose topless. Aih!\r\n\r\nMiranda mengunggah foto tersebut pada akun Instagram resminya. Ibu satu anak itu nampak berbaring di dalam bathub, hanya dengan balutan celana jeans.\r\n\r\n"Kampanye @7fam terbaruku diambil oleh @sebastian_faena! #7obsessions," tulis Miranda pada caption foto yang diunggahnya.\r\n\r\nFoto yang diunggah 14 jam lalu tersebut hingga kini telah menrima 165 ribu likes dari para penggemar. Tak hanya itu, fans dari berbagai belahan dunia juga memberikan komentarnya.\r\n\r\nNama Miranda Kerr beberapa hari ini kembali menjadi bahan pembicaraan. Penyebabnya, sang mantan suami, Orlando Bloom, berkelahi dengan Justin Bieber karena membela Miranda. Namun hingga kini masih belum ada konfirmasi lebih lanjut tentang insiden tersebut dari kedua belah pihak.\r\n\r\n(kmb/wes) ', 3, 1406999522, 1406999522, 1),
(7, 6, 5, 'Lebaran di Dalam Penjara, Guntur Bumi Dijenguk Keluarga', '[b]Jakarta [/b]- Guntur Bumi terpaksa menjalani lebaran tahun ini di balik jeruji besi. Hal itu tak lepas dari kasus penipuan yang disangkakan kepada dirinya masih bergulir di persidangan.\r\n\r\nMeski begitu, Guntur masih bisa dijenguk oleh sanak keluarga. Hal tersebut dikatakan oleh kuasa hukumnya, Afrian Bondjol, saat dihubungi lewat telepon, Jumat (1/8/2014).\r\n\r\n"Ada lah pihak keluarga, wajar kan kalau keluarga menjenguk," ujarnya.\r\n\r\nLebih lanjut, Afrian menuturkan tak ada perlakuan khusus yang diterima suami Puput Melati itu selama jam kunjungan tahanan saat lebaran.\r\n\r\n"Jadwal kunjungan masih sama kaya jadwal di rutan," jelasnya.\r\n\r\nAfrian juga bersyukur di momen lebaran ini, Guntur dan para korban sudah tak ada lagi masalah. Para korban, tambah Afrian, telah memaafkan dan damai dengan Guntur.\r\n\r\n"Saksi sudah tak mempermasalahkan dengan UGB. UGB dan saksi tersebut telah berdamai, semua telah menandatangani akte perdamaian," tandasnya.\r\n', 1, 1406999967, 1406999967, 1),
(8, 7, 5, 'Instruksi Khusus Rodgers Jika Liverpool Bertemu Suarez di Liga Champions', '[b]KOMPAS.com[/b] - Manajer Liverpool Brendan Rodgers melontarkan guyonan mengenai instruksi khusus bagi para pemain belakangnya jika The Reds bertemu Barcelona di pentas Liga Champions pada musim ini. Rodgers mengatakan para pemain di barisan pertahanan harus lebih mewaspadai aksi sulit Luis Suarez yang kerab melewatkan bola di antara kedua kaki lawan.\r\n\r\nLiverpool berpeluang bertemu Barcelona di kompetisi paling bergengsi antarklub Eropa itu, setelah Suarez memberikan andil besar membawa The Merseyside finis di peringkat kedua musim lalu. Jika terjadi, maka Steven Gerrard dan kawan-kawan akan bertarung melawan Suarez, yang pada bursa transfer musim panas ini memutuskan pindah dari Anfield ke Camp Nou.\r\n\r\nKetika ditanya oleh para wartawan, Rodgers, yang sedang memimpin timnya melakoni tur pra-musim di Amerika Serikat, mengaku pertemuan Liverpool dan Barcelona akan sangat menarik. Pasalnya, dua tim ini termasuk raksasa di sepak bola Eropa.\r\n\r\n"Akan menjadi pertandingan yang menakjubkan. Dua klub ini raksasa di pertandingan dunia," ujar Rodgers kepada para wartawan Amerika.\r\n\r\n"Saya mungkin akan mengatakan kepada para pemain belakangku agar menjaga kaki mereka supaya tetap rapat."\r\n\r\nRodgers tentu saja sangat mengenal karakter Suarez, yang sedang menjalani hukuman larangan bermain di sembilan laga internasional dan tak boleh aktif selama empat bulan di dunia sepak bola akibat ulahnya menggigit bek Italia, Giorgio Chiellini, dalam laga penyisihan grup Piala Dunia 2014 lalu. Striker asal Uruguay itu memiliki skill dan naluri gol luar biasa, yang membuatnya menjadi top scorer Premier League musim lalu.', 2, 1407000147, 1407000147, 1),
(9, 6, 5, 'Cameron Diaz dan Benji Madden Berencana Menikah?', '[b]Jakarta [/b]- "Aku merasa sangat bahagia sekarang!" Tegas Benji Madden yang telah menjalani hubungan asmara dengan aktris Cameron Diaz selama tiga bulan belakangan ini. Kepada media, Benji menceritakan kisah asmaranya yang tengah ia jalani bersama Cameron.\r\n\r\nMenurut Benji, hubungan yang mereka jalani ini, telah berikan banyak pengaruh baik dalam pekerjaan yang dijalani Benji sebagai musisi. "Apapun yang ia lakukan seperti membuatku lebih terarah," jelas pria berusia 35 tahun itu.\r\n\r\nBagi Benji kekasihnya yang berusia 41 tahun itu memberikannya banyak inspirasi yang positif. "Kami ingin menjadi yang terbaik yang kami bisa."\r\n\r\nMantan personil band Good Charlotte ini tampak beberapa kali jalan bersama dengan Cameron Diaz, sebelum akhirnya resmi berpacaran tiga bulan lalu. Benji dan Cameron baru saja kembali ke Los Angeles dari liburan bersamanya di Eropa.\r\n\r\nSeorang sumber terpecaya telah membocorkan informasi kepada media mengenai ada rencana menikah dari pasangan ini. "Ini masih awal, tapi mereka sudah bicarakan soal pernikahan," jelasnya. Sumber tersebut juga menceritakan bahwa kini Cameron pun tampak lebih bahagia dibanding tahun-tahun sebelumnya.\r\n\r\n"Benji menghabiskan banyak waktu di rumah Cameron, ia tampak seperti tinggal di sana." Baik Cameron maupun Benji sudah bertemu dengan masing-masing anggota keluarga mereka.\r\n\r\n\r\n(ass/ass) ', 3, 1407000156, 1407000156, 1),
(10, 7, 5, 'Banyak Pemain Chelsea Terkejut Lihat Costa Bermain', '[b]LONDON, KOMPAS.com[/b] - Pelatih Chelsea, Jose Mourinho, mengaku puas dengan penyerang barunya, Diego Costa. Menurut Mourinho, banyak pemain Chelsea yang sangat gembira dan terkejut karena kualitas Costa jauh lebih besar dari perkiraan mereka.\r\n\r\n"Ia pemain baru yang luar biasa bagi kami. Ia pemain fantastis. Secara teknik, ia sangat bagus. Itu kenapa, banyak pemain sangat gembira dan terkejut karena kualitasnya jauh lebih besar dari yang mereka kira," ujar Mourinho.\r\n\r\n"Secara fisik, ia sangat kuat dan ia bekerja keras selama pertandingan. Ketika orang melihatnya bermain, itulah hal pertama yang mereka tangkap, yaitu kapasitas untuk bekerja keras untuk tim dan sangat kuat dan bertenaga secara fisik."\r\n\r\n"Memiliki penyerang seperti Diego, Fernando Torres, dan Didier Drogba adalah sesuatu yang memberi kami kualitas berbeda. Sekarang, kami sangat kuat dalam posisi itu," tuturnya.\r\n\r\nDiego Costa direkrut Chelsea dari Atletico Madrid pada 1 Juli 2014 dan dikontrak selama lima musim atau hingga Juni 2019. Ia menjalani debutnya pada laga persahabatan melawan  Olimpija pada 27 Juli.\r\n\r\nPada laga yang berakhir 2-1 untuk Chelsea itu, Costa mencetak satu gol.', 2, 1407000385, 1407000385, 1),
(11, 7, 5, 'MU Tundukkan Madrid, Van Gaal Puji Pemain Belakang', '[b]MICHIGAN, KOMPAS.com[/b] - Manchester United meraih kemenangan 3-1 atas Real Madrid pada laga terakhir fase grup turnamen persahabatan International Champions Cup di Michigan Stadium, Ann Arbor, Sabtu (2/8/2014). Gol MU dicetak Ashley Young (21, 37) dan Javier Hernandez, sementara gol Madrid dicetak Gareth Bale dari titik penalti pada menit ke-27.\r\n\r\nLaga melawan Madrid itu adalah laga keempat MU sejak ditangani pelatih Louis van Gaal. Dalam tiga pertandingan sebelumnya, MU juga tidak pernah kalah. Setelah menang 7-0 atas LA Galaxy, MU menang 3-2 atas AS Roma. MU kemudian menang adu penalti atas Inter Milan, setelah bermain imbang 0-0.\r\n\r\nDalam empat pertandingan itu, MU bermain dengan pola 3-5-2 wingback. Van Gaal pun memuji para pemainnya, terutama pada bek.\r\n\r\n"Ini luar biasa karena mereka telah beradaptasi dengan sistem baru seperti ini. Sistem ini bukan hal baru bagi Juan Mata, misalnya, karena ia bermain di posisi idealnya, tetapi Wayne Rooney, Danny Welbeck, dan dua gelandang (tidak bermain pada posisi idealnya)," ujar Van Gaal.\r\n\r\n"Dampak terbesar dari sistem ini terjadi pada lini belakang. Namun, kami hanya (memberi Madrid satu peluang) pada babak pertama dan dua peluang pada babak kedua," lanjut Van Gaal.\r\n\r\nDua pemain muda terlibat dalam pertandingan melawan Madrid itu. Mereka adalah Tyler Blackett (20) dan Michael Keane (21). Meski memuji dua pemain itu, Van Gaal menilai mereka belum bisa terlibat dalam kompetisi resmi.\r\n\r\n"Terlalu cepat (jika langsung melibatkan dua pemain itu) karena kita harus melihat apakah mereka sesuai dengan tim kami. Anda melihat mereka bermain hari ini dan mereka bisa melakukan tugasnya, tetapi kita belum melihat mereka dalam banyak pertandingan. Mereka bisa melakukannya untuk satu pertandingan. Mungkin, jika Anda memainkan mereka lebih sering, level pengalaman mereka akan meningkat," ujar Van Gaal.', 3, 1407000659, 1407000659, 1),
(12, 4, 5, 'Bos Bisnis Google Mengundurkan Diri', '[b]Jakarta [/b]- Nikesh Arora salah satu eksekutif penting Google, memutuskan mundur dari raksasa internet ini. Nikesh yang menjabat sebagai Chief Business Officer hengkang ke perusahaan telekomunikasi Jepang, Softbank sebagai Vice Chairman.\r\n\r\nNikesh adalah salah satu eksekutif yang paling diandalkan CEO dan pendiri Google, Larry Page. Dia sudah bekerja di Google kurang lebih selama 10 tahun. Untuk sementara, ia akan digantikan oleh Omid Kordestani, salah satu bos sales Google.\r\n\r\nKepergian Nikesh terasa cukup mengejutkan. Pasalnya bisnis Google yang jadi tanggung jawabnya sedang bagus-bagusnya. Pendapatan Google dalam tiga bulan sampai Juni total sejumlah USD 15,86 miliar, melonjak dari USD 13,11 miliar di tahun sebelumnya.\r\n\r\nKepergian Nikesh dinilai sebagai kerugian bagi Google. Dia dianggap sebagai tangan kanan Larry Page. "Ini adalah sebuah kerugian. Dia adalah eksekutif yang berbakat," kata salah seorang analis teknologi yang dikutip detikINET dari CNBC, Senin (21/7/2014).\r\n\r\nKarena posisinya yang penting, Nikesh Arora termasuk eksekutif dengan bayaran tertinggi di Google. Tahun 2012, Google membayarnya total USD 51 juta.\r\n\r\nPada awal Juli lalu, Nikesh baru saja menikahi Ayesha Thapar, CEO Indian City Properties Ltd. Pernikahan mewah mereka dilangsungkan di Puglia, Italia.\r\n\r\n\r\n(fyk/fyk) ', 2, 1407000742, 1407000742, 1),
(13, 4, 4, 'Facebook Messenger Digenjot Jadi Mesin Uang', '[b]Jakarta [/b]- Facebook tampaknya belum cukup puas hanya menghasilkan uang dari iklan yang berseliweran di jejaring sosialnya. Raksasa social media ini masih berniat untuk mencari tambahan fulus dari aplikasi messaging buatannya.\r\n\r\nDari 1,3 miliar pengguna Facebook di seluruh dunia saat ini, tercatat 200 juta di antaranya menggunakan aplikasi tambahan Facebook Messenger untuk mengirimkan 12 miliar pesan setiap harinya.\r\n\r\nAngka ini kemungkinan masih akan terus bertambah mengingat Facebook kini mengharuskan penggunanya untuk menginstal aplikasi messaging tambahan terlebih dahulu jika masih ingin ngobrol dengan temannya di Facebook.\r\n\r\nKebijakan ini sudah dijalankan Facebook di Eropa pada April lalu dan mendapatkan respons positif. Alasan yang diapungkan Facebook dalam pernyataan resminya, jika aplikasi diunduh terpisah kinerjanya dalam berkirim pesan menjadi lebih cepat.\r\n\r\nPotensi ini jelas bisa jadi ladang duit di kemudian harinya. Apalagi jika melihat pergerakan Facebook yang belum lama ini merekrut mantan Presiden PayPal David Marcus untuk mengisi posisi Vice President di unit Messenger milik Facebook.\r\n\r\nSeperti detikINET kutip Phone Arena, Sabtu (2/8/2014), Facebook disinyalir akan berusaha mendapatkan uang dari aplikasi messenger setelah menjadikannya fasilitas pembayaran.\r\n\r\n(rou/rou) ', 5, 1407001365, 1407001365, 1),
(14, 4, 4, 'Pendapatan Twitter Menggelembung 124%', '[b]Jakarta [/b]- Twitter di kuartal kedua 2014 berhasil membukukan pendapatan USD 312 juta, naik 124% dibandingkan periode sama tahun lalu sebesar USD 139,3 juta berkat kontribusi pendapatan dari mobile advertising.\r\n\r\nSeperti detikINET kutip dari TechCrunch, Sabtu (2/8/2014), saat ini pengguna aktif Twitter sebanyak 271 juta per bulan naik dari posisi 255 juta di kuartal pertama 2014.\r\n\r\nPos EBITDA dari perusahaan dengan kode TWTR di lantai bursa pada kuartal kedua tahun ini sebesar USD 54 juta dengan kerugian USD 145 juta, naik dari USD 42 juta periode sama 2013.\r\n\r\nPada kuartal ketiga 2014 ini Twitter mengharapkan pendapatannya bisa naik dengan proyeksi sekitar USD 330 juta hingga USD 340 juta.\r\n\r\n(rou/rou) ', 3, 1407001549, 1407001549, 1),
(15, 8, 4, 'Lagu Religi Kesukaan Prisia Nasution', '[b]JAKARTA, KOMPAS.com[/b] -- Bersama teman-temannya, artis film Prisia Nasution (30) merasa heran, mengapa setiap pusat perbelanjaan selama bulan puasa memutar lagu religi yang sama. Mayoritas lagu-lagu tersebut merupakan lagu lama yang selalu berkumandang saat Ramadhan saja.\r\n\r\n"Kebanyakan lagu-lagu itu dibuat sebelum anak-anak muda sekarang lahir. Lagu yang itu-itu saja membuat kami enggan ikut bersenandung," kata Prisia saat peluncuran album grup musik iHAQi Nasyid di Tebet, Jakarta, Minggu (13/7/2014) lalu.\r\n\r\nAkan tetapi, ketika mendengar lagu yang dinyanyikan Ustaz Erick Yusuf, Danny S Gumilar, dan Rida Farida dari kelompok iHAQi Nasyid, Pia, sapaan akrab Prisia, langsung terpikat. Dia paling senang mendengar lagu "Astaghfirullah".\r\n\r\n"Ketika mendengar lagu ini di mobil, tahu-tahu saya ikut bersenandung. Kata-kata dan iramanya sungguh enak didengar dan dinyanyikan. Pas buat anak muda," ujar Pia yang datang ke acara tersebut sepulang dari lokasi pengambilan gambar film televisi di Depok.\r\n\r\nSelain sibuk shooting, Pia juga menjadi pembawa acara di salah satu stasiun televisi. Di acara itu, Pia bertemu kembali dengan Ustaz Erick Yusuf.\r\n\r\n"Mulanya, saya tak yakin membawakan acara tersebut. Namun, produser meyakinkan bahwa saya bisa," ucap peraih Piala Citra untuk perannya dalam film Sang Penari itu. (TIA)\r\nSumber :\r\nprint.kompas.com\r\nEditor :\r\nAti Kamil', 5, 1407001591, 1407001591, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forkit_users`
--

CREATE TABLE IF NOT EXISTS `forkit_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passw` varchar(32) NOT NULL,
  `website` varchar(50) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `user_level` tinyint(1) NOT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `like_by` int(11) NOT NULL,
  `dislike_by` int(11) NOT NULL,
  `likedislike_by` int(11) NOT NULL,
  `marriage` tinyint(1) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `bdate` varchar(25) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `forkit_users`
--

INSERT INTO `forkit_users` (`user_id`, `fname`, `lname`, `uname`, `email`, `passw`, `website`, `photo`, `user_status`, `user_level`, `user_created`, `user_updated`, `sex`, `like_by`, `dislike_by`, `likedislike_by`, `marriage`, `phone`, `bdate`) VALUES
(1, 'Admin', 'Forkit', 'superadmin', 'admin@forkit.com', 'e10adc3949ba59abbe56e057f20f883e', 'http://www.forkit.com', '', 0, 9, 1406615359, 1407002204, 0, 0, 0, 0, 0, '', ''),
(2, 'Andrew', 'Hutauruk', 'ahutauruk', 'ahradg@gmail.com', 'd914e3ecf6cc481114a3f534a5faf90b', 'http://blizze.wordpress.com', 'ahutauruk.jpg', 1, 1, 1406710412, 1407316571, 1, 1, 0, 0, 1, '085668833123', '17-11-1987'),
(3, 'Joko', 'Programmer Sejati', 'jprogrammersejati', 'programmer-sejati@yahoo.com', '9ba0009aa81e794e628a04b51eaf7d7f', 'http://joko.blogspot.com', 'jprogramersejati.jpg', 1, 1, 1406858901, 1407012884, 1, 0, 0, 0, 3, '087321345432', '03-01-1988'),
(4, 'Mulan', 'Cantik', 'mcantik', 'mulan@yahoo.com', 'bd2f935091786d0d89313135423d6534', 'http://www.dunia-mulan.web.id', 'msari.jpg', 0, 1, 1406886972, 1407209525, 2, 3, 0, 6, 3, '082145671234', '04-12-1996'),
(5, 'Costa', 'Da Player', 'cdaplayer', 'costa@gmail.com', '2fe44044f40217387daaf299f2eb7340', 'http://www.da-costa.com', 'cdaplayer.jpg', 1, 1, 1406931243, 1407012952, 1, 11, 5, 7, 3, '082134568734', '05-06-1982'),
(6, 'Ayu', 'Larasati', 'alarasati', 'larasati@gmail.com', 'c31dce6ce8cb6b3a9cb1f182a403b902', 'http://www.larasati.com', 'alarasati.jpg', 0, 1, 1406961434, 1407234344, 2, 0, 0, 0, 3, '081324576234', '03-04-1990'),
(7, 'Ratih', 'Garnis', 'rgarnis', 'garnis@gmail.com', '8baeb137396d9878108266ac3608353b', 'http://blizze.wordpress.com', 'rgarnis.jpg', 0, 1, 1407021067, 1407023268, 2, 3, 1, 7, 1, '081345675432', '05-08-1986');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
