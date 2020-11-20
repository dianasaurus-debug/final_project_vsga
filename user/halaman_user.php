<!DOCTYPE html>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
<link href="../user_page.css" type="text/css" rel="stylesheet">
</head>
<body class="home">
<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['level']!=2){
    header("location:../login.php?pesan=nopermissionuser");
}
require_once "D:/Kuliah/xampp/htdocs/final_project_vsga/koneksi.php";
$id = $_SESSION['id'];
$query = mysqli_query($koneksi, "SELECT * FROM user where id='$id'") or die(mysqli_error());
$row = mysqli_fetch_array($query);

?>
<div class="container-fluid display-table">
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
                <h1>Hello, <?php echo $_SESSION['username'];?></h1>
                <div class="row">
                    <div class="col-md-5 col-sm-5 col-xs-12 gutter">
                        <div class="sales">
                            <?php if($row['tanggal_lahir']==null) {
                                echo '<h2> Ayo!Lengkapi Profilmu!</h2>
                                <br>
                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-10" >
                                    <a href = "lengkapi-profile.php" class="btn btn-success" >Lengkapi</a >
                                    </div >
                                </div>
                            ';
                            }
                            else {
                                echo '<h2> Selamat anda sudah terdaftar!</h2>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

</div>



<!-- Modal -->
<div id="add_project" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header login-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Add Project</h4>
            </div>
            <div class="modal-body">
                <input type="text" placeholder="Project Title" name="name">
                <input type="text" placeholder="Post of Post" name="mail">
                <input type="text" placeholder="Author" name="passsword">
                <textarea placeholder="Desicrption"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel" data-dismiss="modal">Close</button>
                <button type="button" class="add-project" data-dismiss="modal">Save</button>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function(){
        $('[data-toggle="offcanvas"]').click(function(){
            $("#navigation").toggleClass("hidden-xs");
        });
    });

</script>

</body>
</html>