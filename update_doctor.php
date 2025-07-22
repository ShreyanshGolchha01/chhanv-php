<?php
require 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");


// ── 1. Read incoming JSON  ─────────────────────────────────────────────────────
$data = json_decode(file_get_contents('php://input'), true);

$id             = $data['id'];                     // doctor ID (primary key)
$name           = $data['name'];
$specialty      = $data['specialty'];
$phone          = $data['phone'];
$email          = $data['email'];
$experience     = (int)$data['experience'];
$qualification  = $data['qualification'];
$assignedCamps  = $data['assignedCamps'];          // CSV or JSON string
$status         = $data['status'];                 // e.g. 'active'

// ── 2. UPDATE the record  ───────────────────────────────────────────────────────
$stmt = $conn->query(
    "UPDATE doctors SET
        name            = '".$name."',
        specialization       = '".$specialty."',
        phoneNo           = '".$phone."',
        email           = '".$email."',
        experience      = ".$experience.",
        qualification   = '".$qualification."',
        assignedCamps   = '".$assignedCamps."'
       
     WHERE id = ".$id
);


// ── 3. Return a fresh list of (active) doctors  ────────────────────────────────
$stmt = $conn->query(
    "SELECT id, name, specialization, phoneNo, email,
            experience, qualification, assignedCamps
     FROM doctors"

);

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

// Fallback if no doctors matched
$response['posts'] = $posts;

echo json_encode($response);
?>
