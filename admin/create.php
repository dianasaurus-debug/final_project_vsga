<?php
require_once "D:/Kuliah/xampp/htdocs/final_project_vsga/koneksi.php";

$name = $email = $username = $password = "";
$name_err = $email_err = $username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Mohon masukkan nama pendaftar.";
    } else{
        $name = $input_name;
    }

    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Mohon masukkan email pendaftar.";
    } else{
        $email = $input_email;
    }

    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Mohon masukkan username pendaftar.";
    }
    else{
        $username = $input_username;
    }

    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Mohon masukkan password pendaftar.";
    }
    else{
        $password = $input_password;
    }

    if(empty($name_err) && empty($email_err) && empty($username_err) && empty($password_err)){
        $sql = "INSERT INTO user (username, name, email, password, level) VALUES (?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($koneksi, $sql)){
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_name, $param_email , $param_password, $param_level);

            $param_name = $name;
            $param_email = $email;
            $param_username = $username;
            $param_password = md5($password);
            $param_level = 2;


            if(mysqli_stmt_execute($stmt)){
                header("location: halaman_admin.php");
                exit();
            } else{
                die('Error with execute: ' . htmlspecialchars($stmt->error));
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Tambah Data Mobil</h2>
                </div>
                <p>Mohon isi form berikut untuk menambahkan data mobil.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block"><?php echo $name_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <label>E-Mail</label>
                        <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                        <span class="help-block"><?php echo $email_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <span class="help-block"><?php echo $password_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="halaman_admin.php" class="btn btn-default">Cancel</a>
                    <button type="reset" value="Reset" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>