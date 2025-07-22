<?php
require 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$location = $data['location'];
$date = $data['date'];
$d1 = $data['d1'];
$d2 = $data['d2'];
$address = $data['address'];
$coordinator = $data['coordinator'];
$expectedBeneficiaries = (int)$data['expectedBeneficiaries'];
$doctors = $data['doctors'];
$status = $data['status'];
$beneficiaries = (int)$data['beneficiaries'];

$stmt = $conn->query("update camps set   location='".$location."',DATE='".$date."',startTime='".$d1."',endTime='".$d2."',address='".$address."',coordinator='".$coordinator."',expectedBeneficiaries=".$expectedBeneficiaries.",doctors='".$doctors."',STATUS='".$status."',beneficiaries='".$beneficiaries."' where id=".$id);
$qry="update camps set   location='".$location."',DATE='".$date."',startTime='".$d1."',endTime='".$d2."',address='".$address."',coordinator='".$coordinator."',expectedBeneficiaries=".$expectedBeneficiaries.",doctors='".$doctors."',STATUS='".$status."',beneficiaries='".$beneficiaries."' where id=".$id;


$stmt = $conn->query("SELECT id,location, DATE, startTime,endTime, address, coordinator, expectedBeneficiaries, doctors, STATUS, beneficiaries FROM camps where status='scheduled' ");
//

while($r = $stmt ->fetch_array())
{

    $posts[]=array("id"=>$r[0],"location"=>$r[1],"DATE"=>$r[2],"startTime"=>$r[3],"endTime"=>$r[4],"address"=>$r[5],"coordinator"=>$r[6],"expectedBeneficiaries"=>$r[7],"doctors"=>$r[8],"STATUS"=>$r[9],"beneficiaries"=>$r[10]);

}
 $response['posts'] = $posts;

    // Encoding the response as JSON and sending it back
    echo json_encode($response);
?>
