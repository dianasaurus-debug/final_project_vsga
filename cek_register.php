<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$name = $_POST['name'];
$level = 2;


// menyeleksi data user dengan username dan password yang sesuai
$register = mysqli_query($koneksi,"INSERT into `user` (username, name, email, password, level)
                     VALUES ('$username', '$name','$email', '" . md5($password) . "', '$level')");
// menghitung jumlah data yang ditemukan
// cek apakah username dan password di temukan pada database
if($register){
        header("location:login.php");
}
else{
    header("location:register.php?pesan=gagal");
}

?>