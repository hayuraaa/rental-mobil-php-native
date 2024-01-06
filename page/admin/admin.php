<!-- menampilkan semua data tb_user -->
<?php 
$queryUser = $conn->query("SELECT * FROM tb_user") or die(mysqli_error($conn));

if(isset($_POST['tambahuser'])) {
	if(tambahuser($_POST) > 0) {
		echo "<script>alert('Data User berhasi ditambahkan.');window.location='?p=user';</script>";
	} else {
		echo "<script>alert('Data User gagal ditambahkan.');window.location='?p=user';</script>";
	}
}

if(isset($_POST['ubahuser'])) {
	if(ubahuser($_POST) > 0) {
		echo "<script>alert('Data User berhasi diubah.');window.location='?p=user';</script>";
	} else {
		echo "<script>alert('Data User gagal diubah.');window.location='?p=user';</script>";
	}
}
?>
<?php 
// cek jika ada level 2 yang ingin mengakses level 1, akan di redirect ke halaman index utamanya.
if($_SESSION['level'] == 1) {
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formTambahUser">
  Tambah User
</button>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Data User
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
                	$no = 1;
                	while($dUser = $queryUser->fetch_assoc()) {
                	?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $dUser['nama_user']; ?></td>
										<td><?= $dUser['jk_user'] == 'L' ? 'Pria' : 'Perempuan'; ?></td>
										<td><?= $dUser['level'] == '1' ? 'Admin' : 'User'; ?></td>
										<td>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formUbahUser<?= $dUser['id_user']; ?>">
											  <i class="fas fa-user-edit"></i>
											</button>
											<a href="?p=huser&id=<?= $dUser['id_user']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ?')"><i class="fas fa-trash"></i></a>
										</td>
									</tr>
									<!-- Modal Tambah User -->
									<div class="modal fade" id="formUbahUser<?= $dUser['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="formUbahModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="formUbahModalLabel">Ubah Data</h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
									      <div class="modal-body">
									        <form action="" method="post">
									      	<!-- <?php 
									      	$id_user = $dUser['id_user'];
									      	$queryUserId = $conn->query("SELECT * FROM tb_user WHERE id_user = $id_user") or die(mysqli_error($conn));
									      	$dUserId = $queryUserId->fetch_assoc();
									      	?> -->
									        	<input type="text" name="id" value="<?= $dUser['id_user']; ?>">
									        	<div class="form-group">
									        		<label for="nama">Nama</label>
									        		<input type="text" name="nama" id="nama" class="form-control" value="<?= $dUser['nama_user']; ?>">
									        	</div>
									        	<div class="form-group">
									        		<label for="username">Username</label>
									        		<input type="text" name="username" id="username" value="<?= $dUser['username']; ?>" class="form-control">
									        	</div>
									        	<div class="form-group">
									        		<label for="password">Password</label>
									        		<input type="text" name="password" id="password" class="form-control">
									        	</div>
									        	<div class="form-group">
										          <div class="form-check">
										            <input class="form-check-input" type="radio" name="jk" id="jk" value="L" <?php if($dUser['jk_user'] == 'L'){echo "checked";} ?>>
										            <label class="form-check-label" for="jk">
										              Pria
										            </label>
										          </div>
										          <div class="form-check">
										            <input class="form-check-input" type="radio" name="jk" id="jk" value="P"<?php if($dUser['jk_user'] == 'P'){echo "checked";} ?>>
										            <label class="form-check-label" for="jk">
										              Perempuan
										            </label>
										          </div>
									          </div>
												      <div class="modal-footer">
												        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												        <button type="submit" name="ubahuser" class="btn btn-primary">Ubah</button>
												      </div>
									        </form>
									      </div>
									    </div>
									  </div>
									</div>
                	<?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Tambah User -->
<div class="modal fade" id="formTambahUser" tabindex="-1" role="dialog" aria-labelledby="formTambahModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formTambahModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        	<div class="form-group">
        		<label for="nama">Nama</label>
        		<input type="text" name="nama" id="nama" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="username">Username</label>
        		<input type="text" name="username" id="username" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="password">Password</label>
        		<input type="text" name="password" id="password" class="form-control">
        	</div>
        	<div class="form-group">
	          <div class="form-check">
	            <input class="form-check-input" type="radio" name="jk" id="jk" value="L">
	            <label class="form-check-label" for="jk">
	              Pria
	            </label>
	          </div>
	          <div class="form-check">
	            <input class="form-check-input" type="radio" name="jk" id="jk" value="P">
	            <label class="form-check-label" for="jk">
	              Perempuan
	            </label>
	          </div>
          </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" name="tambahuser" class="btn btn-primary">Tambah</button>
			      </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
} else {
	header("Location: index.php");
	exit;
} 

?>