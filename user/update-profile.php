<?php
if(isset($_POST['submit'])){
    $upload_dir = 'images/';
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $jenis_kelamin = $_POST['gender'];
    $no_ktp = $_POST['no_ktp'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $address = $_POST['address'];
    $new_date = date('Y-m-d', strtotime($_POST['dateFrom']));
    $profileImageName = time() . '-' . $_FILES["image"]["name"];

    require_once "D:/Kuliah/xampp/htdocs/final_project_vsga/koneksi.php";
    $query1 = mysqli_query($koneksi, "SELECT * FROM user where id='$id'") or die(mysqli_error());
    $row = mysqli_fetch_array($query1);

    move_uploaded_file($image_tmp,"images/$profileImageName");

    $query = "UPDATE user SET name = '$name',
                      email = '$email', image = '$profileImageName', no_ktp='$no_ktp',tempat_lahir='$tempat_lahir', jenis_kelamin='$jenis_kelamin',alamat = '$address', tanggal_lahir = '$new_date'
                      WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    ?>

    <script type="text/javascript">
        alert("Update Successfull.");
        window.location = "halaman_user.php";
    </script>
    <?php
}
?>