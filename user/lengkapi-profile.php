<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Image Preview and Upload PHP</title>
<!-- Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
<link rel="stylesheet" href="main.css">
 <link href="../user_page.css" type="text/css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <style>
        header {
            font-size: 15px;
        }
        lable {
            font-size: 15px;
            font-weight: bold;
            margin-right: 8px;
        }
    </style>
</head>
<body>
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

<div class="container-fluid">
    <div class="row">
        <header>
            <div class="col-md-7">
                <nav class="navbar-default pull-left">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                </nav>
            </div>
            <div class="col-md-5">
                <div class="header-rightside">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="list-inline header-top pull-right">
                            <li>Home</li>
                            <li><a href="daftar-peserta.php">Daftar Peserta</a></li>
                            <li>
                                <a href="profile.php">
                                    <?php echo $_SESSION['username']; ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../logout.php">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <div class="row">
        <div class="container">
            <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="update-profile.php" method="post" enctype="multipart/form-data">
                <h2 class="text-center mb-3 mt-3">Update profile</h2>
                <div class="form-group row">
                    <div class="col-sm-5">
                    <div class="form-group text-center" style="position: relative;" >
                        <span class="img-div">
                          <div class="text-center img-placeholder"  onClick="triggerClick()">
                            <h4>Upload Foto Profil</h4>
                          </div>
                          <img src="images/<?php echo $img?>" onClick="triggerClick()" id="profileDisplay" style="width : 60%;">
                        </span>
                            <input type="file" name="image" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                            <label>Profile Image</label>
                    </div>
                    </div>
                </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                        <input type="text" hidden class="form-control" name="id" required value="<?php echo $row['id']; ?>"/>
                            <lable>Name</lable>
                            <input type="text" class="form-control" name="name" required value="<?php echo $row['name']; ?>"/>
                        </div>
                        <div class="col-sm-6">
                            <lable>E-Mail</lable>
                            <input type="email" class="form-control" name="email" required value="<?php echo $row['email']; ?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <lable>Tempat Lahir</lable>
                            <input type="text" class="form-control" name="tempat_lahir" required value="<?php echo $row['tempat_lahir']; ?>"/>
                        </div>
                        <div class="col-sm-6">
                            <lable>Tanggal Lahir</lable>
                            <input type="date" class="form-control" name="dateFrom" required value="<?php echo $row['tanggal_lahir']; ?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <lable>Alamat</lable>
                            <textarea name="address" required class="form-control" ><?php echo $row['alamat']; ?></textarea>
                        </div>
                        <div class="col-sm-6">
                            <lable>Nomor KTP</lable>
                            <input type="text" class="form-control" name="no_ktp" required value="<?php echo $row['no_ktp']; ?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <lable>Jenis Kelamin</lable>
                            <div class="form-check form-check-inline">
                                <label class="radio-inline">
                                    <input required type="radio" name="gender" <?php echo ($status_id==1)?'checked':'' ?> value="Laki-laki">Laki-laki
                                </label>
                                <label class="radio-inline">
                                    <input required type="radio" name="gender" <?php echo ($status_id==2)?'checked':'' ?> value="Perempuan">Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </div>
            </form>
    </div>
            </div>
        </div>
</div>
</div>
<script type="text/javascript">
    function triggerClick(e) {
        document.querySelector('#profileImage').click();
    }
    function displayImage(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }
</script>
</body>
</html>
