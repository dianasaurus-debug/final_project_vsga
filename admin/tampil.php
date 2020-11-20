<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    require_once "D:/Kuliah/xampp/htdocs/final_project_vsga/koneksi.php";

    $sql = "SELECT * FROM user WHERE id = ?";

    if($stmt = mysqli_prepare($koneksi, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $img="avatar.png";
                if($row['image']!=null) {
                    $img=$row['image'];
                }

            } else{
                header("location: error.php");
                exit();
            }

        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    mysqli_stmt_close($stmt);

    mysqli_close($koneksi);
} else{
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../user/main.css">
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
                <h1>Tampilan user</h1>
            </div>
            <div class="form-group text-center" style="position: relative; width : 70%;"  >
                        <span class="img-div">
                          <div class="text-center img-placeholder"  onClick="triggerClick()">
                            <h4>Upload Foto Profil</h4>
                          </div>
                          <img src="../user/images/<?php echo $img?>" onClick="triggerClick()" id="profileDisplay">
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
                <p><a href="halaman_admin.php" class="btn btn-primary">Back</a></p>
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
