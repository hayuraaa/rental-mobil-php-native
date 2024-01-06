<?php 
ob_start();
require '../config/functions.php';
require '../assets/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$mobil = $conn->query("SELECT * FROM tb_mobil WHERE status_mobil = 'Aktif'") or die(mysqli_error($conn));
var_dump($mobil);

$html2pdf = new Html2Pdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cetak Laporan Mobil</title>
</head>
<body>
	<h1 align="center">Laporan Rental Mobil</h1>
	<table border="1" cellpadding="10" cellspacing="0" align="center">
		<tr>
			<th>No</th>
			<th>No.Polisi</th>
			<th>Merk</th>
			<th>Tahun</th>
			<th>Harga/Hari</th>
		</tr>';
		$no = 1;
		while($data = $mobil->fetch_assoc()) { 
		$html .= '
					<tr>
						<td>'. $no++ .'</td>
						<td>'. $data['no_polisi'] .'</td>
						<td>'. $data['merk'] .'</td>
						<td>'. $data['tahun'] .'</td>
						<td>'. number_format($data['hrg_mobil']) .'</td>
					</tr>
		';
	}
$html .= '
	</table>
</body>
</html>';
$html2pdf->writeHTML($html);
ob_end_clean();
$html2pdf->output();

?>
