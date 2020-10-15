<?php
include('../../db.php');
header('Content-Type: application/json; charset=utf-8');

try{
    $db = new PDO("mysql:host=$data[hostname];dbname=$data[dbname];port=$data[port];charset=$data[charset];",$data['user'],$data['pass']);
}catch(PDOException $e){
    echo $e->getMessage();
    exit;
}
$id=$_POST['id'];

$original_status=$_POST['status'];
//echo $original_status."  ";
$new_status=5;



if( $original_status == "true" ){
    //echo "true";
    $new_status=0;
}
else{
    //echo "false";
    $new_status=1;
}




//echo $new_status;
$update="UPDATE list SET list_status= :list_status WHERE list_id=:list_id";
$statement=$db->prepare($update);
$statement->bindValue(':list_status',$new_status);
$statement->bindValue(':list_id',$id);

$result= $statement->execute();

if($result){
    echo json_encode(['id'=> $id]);
}
else{
    echo "bad";
}
