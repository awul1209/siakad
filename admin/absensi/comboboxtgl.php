<?php
$conn = new mysqli('localhost', 'root', '', 'annawari');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['jadwal_id'])) {
    $category_id = $_POST['jadwal_id'];
    $result = $conn->query("SELECT id_absensi,tanggal FROM absensi WHERE jadwal_id = $category_id");
    $output = '<option value="">Select Subcategory</option>';
    while ($row = $result->fetch_assoc()) {
        $output .= '<option value="' . $row['id_absensi'] . '">' . $row['tanggal'] . '</option>';
    }
    echo $output;
}
?>