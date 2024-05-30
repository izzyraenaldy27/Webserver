<?php
header("Content-Type: application/json");

include 'db_config.php';
// Get the posted data
$data = json_decode(file_get_contents("php://input"));

// Validate the data
if (!isset($data->name) || !isset($data->nim) || !isset($data->kelas) || !isset($data->email)) {
    die(json_encode(["error" => "Invalid input"]));
}

$name = $koneksi->real_escape_string($data->name);
$nim = $koneksi->real_escape_string($data->nim);
$kelas = $koneksi->real_escape_string($data->kelas);
$email = $koneksi->real_escape_string($data->email);


$sql = "INSERT INTO users (name, nim, kelas, email) VALUES ('$name', '$nim', '$kelas', '$email')";


if ($koneksi->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => $koneksi->error]);
}

$koneksi->close();
