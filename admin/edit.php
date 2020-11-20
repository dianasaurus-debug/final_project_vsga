<?php
require_once "D:/Kuliah/xampp/htdocs/final_project_vsga/koneksi.php";

$name = $email = $username = "";
$name_err = $email_err = $username_err = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

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

    if(empty($name_err) && empty($email_err) && empty($username_err)){
        $sql = "UPDATE user SET name=?, email=?, username=? WHERE id=?";

        if($stmt = mysqli_prepare($koneksi, $sql)){
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_email, $param_username, $param_id);

            $param_name = $name;
            $param_email = $email;
            $param_username = $username;
            $param_id = $id;

            if(mysqli_stmt_execute($stmt)){
                header("location: halaman_admin.php");
                exit();
            } else{
                echo "Ada kesalahan. Silahkan mencoba lagi!";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    mysqli_close($koneksi);
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);

        $sql = "SELECT * FROM user WHERE id = ?";
        if($stmt = mysqli_prepare($koneksi, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;

            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $name = $row["name"];
                    $email = $row["email"];
                    $username = $row["username"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);

        mysqli_close($koneksi);
    }  else{
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2>Update Data Mobil</h2>
                </div>
                <p>Mohon isikan data untuk merubah data mobil jika perlu</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err;?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
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
