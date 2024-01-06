<?php 
ob_start();
require '../config/functions.php';
require '../assets/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$order = $conn->query("SELECT * FROM tb_mobil, tb_order WHERE tb_mobil.id_mobil = tb_order.id_mobil") or die(mysqli_error($conn));
// var_dump($mobil);

$html2pdf = new Html2Pdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cetak Laporan Mobil</title>
</head>
<body>
	<h1 align="center">Laporan Sewa Mobil</h1>
	<table border="1" cellpadding="10" cellspacing="0" align="center">
		<tr>
			<th>No</th>
      <th>No.Polisi</th>
      <th>Merk</th>
      <th>Nama</th>
      <th>Tujuan</th>
      <th>Tanggal Pinjam</th>
      <th>Tanggal Kembali</th>
      <th>Lama Sewa</th>
      <th>Total Sewa</th>
		</tr>';
		$no = 1;
		while($data = $order->fetch_assoc()) { 
		$html .= '
					<tr>
						<td>'. $no++ .'</td>
						<td>'. $data['no_polisi'] .'</td>
						<td>'. $data['merk'] .'</td>
						<td>'. $data['nama_order'] .'</td>
						<td>'. $data['tujuan'] .'</td>
						<td>'. $data['tgl_pinjam'] .'</td>
						<td>'. $data['tgl_kembali'] .'</td>
						<td>'. $data['lama'] .'</td>
						<td>'. "Rp." . number_format($data['hrg_mobil']) .'</td>
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
