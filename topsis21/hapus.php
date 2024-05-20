<?php
// File: hapus.php
include('konfig/koneksi.php');

// Assuming you have a GET parameter with the ID to delete
$id = $_GET['id'];

// Prepare the SQL DELETE query
$query = "DELETE FROM kriteria WHERE id_kriteria='$id'";

// Execute the query using MySQLi
$s = mysqli_query($k21, $query); // Using $k21 from koneksi.php

if($s){
    echo "<script>
            alert('Record deleted successfully');
            window.open('index.php?a=kriteria&k=kriteria', '_self');
          </script>";
} else {
    echo "<script>
            alert('Error deleting record: " . mysqli_error($k21) . "');
            window.open('index.php?a=kriteria&k=kriteria', '_self');
          </script>";
}

// Close the connection
mysqli_close($k21);
?>
