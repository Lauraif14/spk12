<?php
include("konfig/koneksi.php");

// Retrieve data for editing
$query = "SELECT * FROM alternatif WHERE id_alternatif='{$_GET['id']}'";
$result = mysqli_query($k21, $query); // Assuming $k21 is your database connection from koneksi.php
$data = mysqli_fetch_assoc($result);

?>

<div class="box-header">
    <h3 class="box-title">Ubah Alternatif</h3>
</div>

<div class="box-body pad">
    <form action="" method="POST">
        <input type="text" name="id_alternatif" class="form-control" value="<?php echo $data['id_alternatif']; ?>" readonly>
        <br />
        <input type="text" name="nama_alternatif" class="form-control" placeholder="Nama Alternatif" value="<?php echo $data['nm_alternatif']; ?>">
        <br />
        <input type="submit" name="ubah" value="Ubah" class="btn btn-primary">
        <br />
    </form>
</div>

<?php
// Process form submission
if(isset($_POST['ubah'])){
    $id_alternatif = $_POST['id_alternatif'];
    $nama_alternatif = $_POST['nama_alternatif'];

    $query = "UPDATE alternatif SET nm_alternatif='$nama_alternatif' WHERE id_alternatif='$id_alternatif'";
    $result = mysqli_query($k21, $query); // Assuming $k21 is your database connection from koneksi.php
    
    if($result){
        echo "<script>alert('Diubah'); window.open('index.php?a=alternatif&k=alternatif','_self');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($k21) . "');</script>";
    }
}
?>
