<?php
require 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$name = $data['name'];
$specialty = $data['specialty'];
$phone = $data['phone'];
$email = $data['email'];
$experience = $data['experience'];
$qualification = $data['qualification'];
$assignedCamps = $data['assignedCamps'];


$stmt = $conn->query("
    INSERT INTO doctors 
    (id,name, specialization, phoneNo,email, experience, qualification, assignedCamps) 
    VALUES ('','".$name."','".$specialty."','".$phone."','".$email."',".$experience.",'".$qualification."','".$assignedCamps."')");

	

$stmt = $conn->query("SELECT id,name, specialization, phoneNo,email, experience, qualification, assignedCamps FROM doctors ");
//

while($r = $stmt ->fetch_array())
{

    $posts[]=array("id"=>$r[0],"location"=>$r[1],"DATE"=>$r[2],"startTime"=>$r[3],"endTime"=>$r[4],"address"=>$r[5],"coordinator"=>$r[6],"expectedBeneficiaries"=>$r[7],"doctors"=>$r[8],"STATUS"=>$r[9],"beneficiaries"=>$r[10]);

}
 $response['posts'] = $posts;

    // Encoding the response as JSON and sending it back
    echo json_encode($response);
?>
