<?php
include("konfig/koneksi.php");

// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the maximum id_kriteria
$query = "SELECT max(id_kriteria) as idMaks FROM kriteria";
$hasil = mysqli_query($k21, $query); // Use $k21 for database connection
$data = mysqli_fetch_array($hasil);
$nim = $data['idMaks'];

// Generate new ID
$noUrut = (int) substr($nim, 2, 3);
$noUrut++;
$char = "kr";
$IDbaru = $char . sprintf("%03s", $noUrut);

// Get data to edit
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $s = mysqli_query($k21, "SELECT * FROM kriteria WHERE id_kriteria='$id'"); // Use $k21 for database connection
    $d = mysqli_fetch_assoc($s);
}

if (isset($_POST['ubah'])) {
    $id_kriteria = $_POST['id_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $bobot = $_POST['bobot'];
    $poin1 = $_POST['poin1'];
    $poin2 = $_POST['poin2'];
    $poin3 = $_POST['poin3'];
    $poin4 = $_POST['poin4'];
    $poin5 = $_POST['poin5'];
    $sifat = $_POST['sifat'];

    $query = "UPDATE kriteria SET nama_kriteria=?, bobot=?, poin1=?, poin2=?, poin3=?, poin4=?, poin5=?, sifat=? WHERE id_kriteria=?";
    $stmt = mysqli_prepare($k21, $query); // Use $k21 for database connection
    mysqli_stmt_bind_param($stmt, "sssssssss", $nama_kriteria, $bobot, $poin1, $poin2, $poin3, $poin4, $poin5, $sifat, $id_kriteria);
    $result = mysqli_stmt_execute($stmt);

    if($result){
        echo "<script>
                alert('update data successfully');
                window.open('index.php?a=kriteria&k=kriteria', '_self');
              </script>";
    } else {
        echo "<script>
                alert('Error update: " . mysqli_error($k21) . "');
                window.open('index.php?a=kriteria&k=kriteria', '_self');
              </script>";
    }
}
?>

<div class="box-header">
    <h3 class="box-title">Ubah Kriteria</h3>
</div>

<div class="box-body pad">
    <form action="" method="POST">
        <input type="text" name="id_kriteria" class="form-control" value="<?php echo isset($d['id_kriteria']) ? $d['id_kriteria'] : ''; ?>" readonly>
        <br />
        <input type="text" name="nama_kriteria" class="form-control" placeholder="Nama Kriteria" value="<?php echo isset($d['nama_kriteria']) ? $d['nama_kriteria'] : ''; ?>">
        <br />
        <input type="text" name="bobot" class="form-control" placeholder="Bobot" value="<?php echo isset($d['bobot']) ? $d['bobot'] : ''; ?>">
        <br />
        <input type="text" name="poin1" class="form-control" placeholder="Poin 1" value="<?php echo isset($d['poin1']) ? $d['poin1'] : ''; ?>">
        <br />
        <input type="text" name="poin2" class="form-control" placeholder="Poin 2" value="<?php echo isset($d['poin2']) ? $d['poin2'] : ''; ?>">
        <br />
        <input type="text" name="poin3" class="form-control" placeholder="Poin 3" value="<?php echo isset($d['poin3']) ? $d['poin3'] : ''; ?>">
        <br />
        <input type="text" name="poin4" class="form-control" placeholder="Poin 4" value="<?php echo isset($d['poin4']) ? $d['poin4'] : ''; ?>">
        <br />
        <input type="text" name="poin5" class="form-control" placeholder="Poin 5" value="<?php echo isset($d['poin5']) ? $d['poin5'] : ''; ?>">
        <br />
        <select name="sifat" class="form-control">
            <option value="benefit" <?php if(isset($d['sifat']) && $d['sifat'] == "benefit") echo "selected"; ?>>Benefit</option>
            <option value="cost" <?php if(isset($d['sifat']) && $d['sifat'] == "cost") echo "selected"; ?>>Cost</option>
        </select>
        <br />
        <input type="submit" name="ubah" value="Ubah" class="btn btn-primary">
        <br />
    </form>
</div>
