<?php
require_once "D:/Kuliah/xampp/htdocs/final_project_vsga/koneksi.php";
session_start();

// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['level']!=2){
    header("location:../login.php?pesan=nopermissionuser");
}
$id = $_SESSION['id'];
$query = mysqli_query($koneksi, "SELECT * FROM user where id='$id'") or die(mysqli_error());
$row = mysqli_fetch_array($query);
$status_id=0;
if($row['jenis_kelamin']!=null) {
    if ($row['jenis_kelamin'] == 'Perempuan') {
        $status_id = 2;
    } else if ($row['jenis_kelamin'] == 'Laki-laki') {
        $status_id = 1;
    }
}
$img="avatar.png";
if($row['image']!=null) {
    $img=$row['image'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="main.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="page-header">
                <h1>Profil</h1>
            </div>
            <div class="form-group text-center" style="position: relative; width : 70%;"  >
                        <span class="img-div">
                          <img src="images/<?php echo $img?>" onClick="triggerClick()" id="profileDisplay">
                        </span>
                <input type="file" name="image" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                <label>Profile Image</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama</label>
                    <p class="form-control-static"><?php echo $row["name"]; ?></p>
                </div>
                <div class="form-group">
                    <label>E-Mail</label>
                    <p class="form-control-static"><?php echo $row["email"]; ?></p>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <p class="form-control-static"><?php echo $row["username"]; ?></p>
                </div>
                <p><a href="halaman_user.php" class="btn btn-primary">Back</a><a href="lengkapi-profile.php" class="btn btn-info">Update</a></p>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Alamat</label>
                    <p class="form-control-static"><?php echo $row["alamat"]; ?></p>
                </div>
                <div class="form-group">
                    <label>Tempat Lahir dan Tanggal lahir</label>
                    <p class="form-control-static"><?php echo $row["tempat_lahir"]." ".$row["tanggal_lahir"]; ?></p>
                </div>
                <div class="form-group">
                    <label>No KTP</label>
                    <p class="form-control-static"><?php echo $row["no_ktp"]; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
