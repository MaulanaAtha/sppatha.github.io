<?php include 'header.php';
include 'koneksi.php';
 ?>

<!-- button triger -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</button>
<!-- button triger -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nis</th>
                                            <th>Nama Siswa</th>
                                            <th>Angkatan</th>
                                            <th>Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $query = "SELECT siswa.*,angkatan.*,jurusan.*,kelas.* FROM siswa,angkatan,jurusan,kelas WHERE siswa.id_angkatan = angkatan.id_angkatan AND siswa.id_jurusan = jurusan.id_jurusan AND siswa.id_kelas = kelas.id_kelas ORDER BY id_siswa";
                                    $exec = mysqli_query($conn,$query);
                                    while($res = mysqli_fetch_assoc($exec)) :
                                    
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $res['nisn'] ?></td>
                                            <td><?= $res['nama_siswa'] ?></td>
                                            <td><?= $res['nama_angkatan'] ?></td>
                                            <td><?= $res['nama_kelas'] ?></td>
                                            <td><?= $res['nama_jurusan'] ?></td>
                                            <td><?= $res['alamat'] ?></td>
                                            <td>
                                                <a href="hapusdata.php?id_datasiswa<?= $res['id_siswa'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Yakin Ingin Menghapus Data?')">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
            <input type="nama_siswa" placeholder="Nama Siswa" class="form-control mb-2">
            <select class="form-control mb-2" name="id_angkatan">
                <option selected="">-Pilih Angkatan-</option>
                <?php
                $exec = mysqli_query($conn,"SELECT * FROM angkatan order by id_angkatan");
                while ($angkatan = mysqli_fetch_assoc($exec)) :
                echo "<option value=".$angkatan['id_angkatan'].">".$angkatan['nama_angkatan']."</option>";
                endwhile;
                ?>
            </select>
            <select class="form-control mb-2" name="id_kelas">
                <option selected="">-Pilih Kelas-</option>
                <?php
                $exec = mysqli_query($conn,"SELECT * FROM kelas order by id_kelas");
                while ($kelas = mysqli_fetch_assoc($exec)) :
                echo "<option value=".$kelas['id_kelas'].">".$kelas['nama_kelas']."</option>";
                endwhile;
                ?>
            </select>
            <select class="form-control mb-2" name="id_jurusan">
                <option selected="">-Pilih Jurusan-</option>
                <?php
                $exec = mysqli_query($conn,"SELECT * FROM jurusan order by id_jurusan");
                while ($angkatan = mysqli_fetch_assoc($exec)) :
                echo "<option value=".$angkatan['id_jurusan'].">".$angkatan['nama_jurusan']."</option>";
                endwhile;
                ?>
            </select>
            <textarea class="form-control mt-2" name="alamat" placeholder="Alamat Siswa"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="Submit" name="montir" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php

if(isset($_POST['simpan'])) {
    $nama_siswa = htmlentities(strip_tags($_POST['nama_siswa']));
    $id_kelas = htmlentities(strip_tags($_POST['id_kelas']));
    $id_jurusan = htmlentities(strip_tags($_POST['id_jurusan']));
    $id_angkatan = htmlentities(strip_tags($_POST['id_angkatan']));
    $alamat = htmlentities(strip_tags($_POST['alamat']));
    $nisn = date('dmYHis');

    $query = "INSERT INTO siswa (nisn,nama,id_angkatan,id_jurusan,id_kelas,alamat) values('$nisn','$nama_siswa','$id_angkatan','$id_jurusan','$id_kelas','$alamat')";
    $exec = mysqli_query($conn, $query);
    if($exec) {
        echo "<script>alert('Data siswa Berhasil disimpan')
        document.location = 'editdatasiswa.php';
        </script>";
    }else {
        echo "<script>alert('Data siswa Gagal disimpan')
        document.location = 'editdatasiswa.php';
        </script>";
    }
}

?>
<?php include 'footer.php'; ?>