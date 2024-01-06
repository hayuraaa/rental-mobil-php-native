<!-- menampilkan semua data tb_user -->
<?php 
$queryOrder = $conn->query("SELECT * FROM tb_mobil, tb_order WHERE tb_mobil.id_mobil = tb_order.id_mobil") or die(mysqli_error($conn));

if(isset($_POST['tambahorder'])) {
	if(tambahorder($_POST) > 0) {
		echo "<script>alert('Data Order berhasil ditambahkan.');window.location='?p=order';</script>";
	} else {
		echo "<script>alert('Data Order gagal ditambahkan.');window.location='?p=order';</script>";
	}
}

if(isset($_POST['kembali'])) { 
	if(kembalimobil() > 0) {
		echo "<script>alert('Mobil berhasil dikembalikan.');window.location='?p=order';</script>";
	} else {
		echo "<script>alert('Mobil gagal dikembalikan.');window.location='?p=order';</script>";
	}
}

if(isset($_POST['ubahmobil'])) {
	if(ubahmobil($_POST) > 0) {
		echo "<script>alert('Data Mobil berhasil diubah.');window.location='?p=mobil';</script>";
	} else {
		echo "<script>alert('Data Mobil gagal diubah.');window.location='?p=mobil';</script>";
	}
}





?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formTambahOrder">
  Tambah Data Order
</button>
<a href="<?= base_url('laporan/') ?>ocetakpdf.php" class="btn btn-secondary" target="_blank"><i class="fa fa-print"></i></a>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Data Rental Mobil
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No.Polisi</th>
                        <th>Merk</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Tujuan</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Lama Sewa</th>
                        <th>Total Sewa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
                	$no = 1;
                	while($dOrder = $queryOrder->fetch_assoc()) {
                	?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $dOrder['no_polisi']; ?></td>
										<td><?= $dOrder['merk']; ?></td>
										<td><?= $dOrder['nama_order']; ?></td>
										<td><?= $dOrder['alamat']; ?></td>
										<td><?= $dOrder['tujuan']; ?></td>
										<td><?= $dOrder['tgl_pinjam']; ?></td>
										<td><?= $dOrder['tgl_kembali']; ?></td>
										<td><?= $dOrder['lama']; ?> Hari</td>
										<td>Rp.<?= number_format($dOrder['hrg_total']); ?></td>
										<td>
											<!-- <a href="?p=km&id=<?= $dOrder['id_mobil']; ?>" class="btn btn-warning">Kembali</a> --> 
											<form action="" method="post" onclick="return confirm('Kembalikan Mobil?')"> 
												<input type="hidden" name="id_order" value="<?= $dOrder['id_order']; ?>">
												<button type="submit" name="kembali" class="btn btn-primary"><i class="fa fa-car"></i>Kembali</button> 
											</form>
											<!-- <a href="?p=hmobil&id=<?= $dOrder['id_order']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ?')"><i class="fas fa-trash"></i></a> -->
										</td>
									</tr>
                	<?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Tambah User -->
<div class="modal fade" id="formTambahOrder" tabindex="-1" role="dialog" aria-labelledby="formTambahOrderLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formTambahOrderLabel">Tambah Data Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        	<input type="text" name="id_user" value="<?= $_SESSION['id_user']; ?>">
        	<div class="form-group">
        		<label for="polisi">Merk</label>
        		<select name="polisi" id="polisi" class="form-control">
        			<option value="">Pilih Merk</option>
        			<?php 
        			$tampilNoPolisi = $conn->query("SELECT * FROM tb_mobil");
        			while($dMerk = $tampilNoPolisi->fetch_assoc()) {
        			?>
        			<option value="<?= $dMerk['id_mobil']; ?>"><?= $dMerk['merk']; ?></option>
        			<?php } ?>	
        		</select>
        	</div>
        	<div class="form-group">
        		<label for="ktp">No.Ktp</label>
        		<input type="text" name="ktp" id="ktp" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="nama">Nama Order</label>
        		<input type="text" name="nama" id="nama" class="form-control">
        	</div>
        	<div class="form-group">
        		<label>Jenis Kelamin</label>
        		<div class="form-check">
						  <input class="form-check-input" type="radio" name="jk_order" id="jk_order" value="L">
						  <label class="form-check-label" for="jk_order">
						    Pria
						  </label>
						</div>
						<div class="form-check">
						  <input class="form-check-input" type="radio" name="jk_order" id="jk_order" value="P">
						  <label class="form-check-label" for="jk_order">
						    Perempuan
						  </label>
						</div>
        	</div>
        	<div class="form-group">
        		<label for="alamat">Alamat</label>
						<textarea name="alamat" id="alamat" class="form-control"></textarea>
        	</div>
        	<div class="form-group">
        		<label for="alamat">Tujuan</label>
        		<input type="text" name="tujuan" id="tujuan" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="telp">Telepon</label>
        		<input type="number" name="telp" id="telp" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="tgl_pinjam">Tanggal Pinjam</label>
        		<input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="tgl_kembali">Tanggal Kembali</label>
        		<input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control">
        	</div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" name="tambahorder" class="btn btn-primary">Tambah</button>
			      </div>
        </form>
      </div>
    </div>
  </div>
</div>
> 