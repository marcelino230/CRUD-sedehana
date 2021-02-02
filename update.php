<!DOCTYPE html>
<html>
<head>
 <title>Form Pendaftaran Anggota</title>
 <!-- Load file CSS Bootstrap offline -->
<link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
 <?php
 //Include file koneksi, untuk koneksikan ke database
 include "koneksi.php";
 //Fungsi untuk mencegah inputan karakter yang tidak sesuai
 function input($data) {
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
 }
 //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_anggota
 if (isset($_GET['id_anggota'])) {
 $id_anggota=input($_GET["id_anggota"]);
 $sql="select * from anggota where id_anggota=$id_anggota";
 $hasil=mysqli_query($kon,$sql);
 $data = mysqli_fetch_assoc($hasil);
 }
 //Cek apakah ada kiriman form dari method post
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $id_anggota=htmlspecialchars($_POST["id_anggota"]);
 $username=input($_POST["username"]);
 $nama=input($_POST["nama"]);
 $alamat=input($_POST["alamat"]);
 $email=input($_POST["email"]);
 $no_hp=input($_POST["no_hp"]);
 //Query update data pada tabel anggota
 $sql="update anggota set
username='$username',
nama='$nama',
alamat='$alamat',
email='$email',
no_hp='$no_hp'
where id_anggota=$id_anggota";
 //Mengeksekusi atau menjalankan query diatas
 $hasil=mysqli_query($kon,$sql);
 //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
 if ($hasil) {
 header("Location:index.php");
 }
 else {
 echo "<div class='alert alert-danger'> Data Gagal diupdate.</div>";
 }
 }
 ?>
 <h2>Update Data</h2>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
 <div class="form-group">
 <label>Username:</label>
 <input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>" placeholder="Masukan Username"
required />
 </div>
 <div class="form-group">
 <label>Nama:</label>
 <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" placeholder="Masukan Nama" required/>
 </div>
 <div class="form-group">
 <label>Alamat:</label>
 <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan Alamat" required><?php echo $data['alamat'];
?></textarea>
</div>
 <div class="form-group">
 <label>Email:</label>
 <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" placeholder="Masukan Email"
required/>
 </div>
 <div class="form-group">
 <label>No HP:</label>
 <input type="text" name="no_hp" class="form-control" value="<?php echo $data['no_hp']; ?>" placeholder="Masukan No HP" required/>
 </div>
 <input type="hidden" name="id_anggota" value="<?php echo $data['id_anggota']; ?>" />
 <button type="submit" name="submit" class="btn btn-primary">Submit</button>
 </form>
</div>
</body>
</html>