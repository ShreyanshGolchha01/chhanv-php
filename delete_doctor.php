<?php
require 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];   // falls back to 0 if not provided

// 1️⃣ Remove the doctor with the given ID
$conn->query("DELETE FROM doctors WHERE id = ".$id);

// 2️⃣ Fetch the updated list of doctors
$stmt = $conn->query("
    SELECT id, name, specialization, phoneNo, email,
           experience, qualification, assignedCamps
    FROM doctors
");


while ($r = $stmt->fetch_array()) {
    $posts[] = array(
        "id"            => $r[0],
        "name"          => $r[1],
        "specialty"     => $r[2],
        "phone"         => $r[3],
        "email"         => $r[4],
        "experience"    => $r[5],
        "qualification" => $r[6],
        "assignedCamps" => $r[7],
    );
}

echo json_encode(array('posts' => $posts));
?>
