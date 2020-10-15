<?php
header('Content-Type: application/json; charset=utf-8');
include('../../db.php');

try{
    $db = new PDO("mysql:host=$data[hostname];dbname=$data[dbname];port=$data[port];charset=$data[charset];",$data['user'],$data['pass']);




}catch(PDOException $e){
    echo $e->getMessage();
    exit;
}

$update="DELETE FROM list WHERE list_id=:list_id";
$statement=$db->prepare($update);
$statement->bindValue(':list_id',$_POST['id']);
$result= $statement->execute();

if($result){
    echo json_encode(['id'=> $_POST['id']]);
}
else{
    echo var_dump($statement->errorInfo());
}

