<?php
header('Content-Type: application/json; charset=utf-8');
include('../../db.php');

try{
    $db = new PDO("mysql:host=$data[hostname];dbname=$data[dbname];port=$data[port];charset=$data[charset];",$data['user'],$data['pass']);




}catch(PDOException $e){
    echo $e->getMessage();
    exit;
}

$insert="INSERT INTO list(	list_content,list_status,list_order) VALUES(:list_content,:list_status,:list_order)";
$statement=$db->prepare($insert);
$statement->bindValue(':list_content',$_POST['content']);
$statement->bindValue(':list_status',0);
$statement->bindValue(':list_order',$_POST['order']);

$result= $statement->execute();

if($result){
    echo json_encode(['id'=> $db->lastInsertId()]);

}
else{
   // echo "eff";
   echo var_dump($db->errorInfo());
}
