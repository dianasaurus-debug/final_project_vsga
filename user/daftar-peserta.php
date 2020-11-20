<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <link href="../user_page.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['level']!=2){
    header("location:../login.php?pesan=nopermissionuser");
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
    <div class="user-dashboard">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Daftar Peserta</h2>
                </div>
                <?php
                require_once "D:/Kuliah/xampp/htdocs/final_project_vsga/koneksi.php";
                $sql = "SELECT * FROM user WHERE level=2";
                if($result = mysqli_query($koneksi, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Nama</th>";
                        echo "<th>E-Mail</th>";
                        echo "<th>Username</th>";
                        echo "<th>Tanggal Join</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['created'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        mysqli_free_result($result);
                    } else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                    }
                } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($koneksi);
                }
                mysqli_close($koneksi);
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>