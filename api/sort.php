<?php
header('Content-Type: application/json; charset=utf-8');
include('../../db.php');

try{
    $db = new PDO("mysql:host=$data[hostname];dbname=$data[dbname];port=$data[port];charset=$data[charset];",$data['user'],$data['pass']);




}catch(PDOException $e){
    echo $e->getMessage();
    exit;
}
foreach($_POST['li_new_order'] as $li_new_order){
    $update="UPDATE list SET list_order=:list_order WHERE list_id=:list_id";
    $statement=$db->prepare($update);
    $statement->bindValue(':list_order',$li_new_order['index']);
   
    $statement->bindValue(':list_id',$li_new_order['id']);
    $result= $statement->execute();
    if($result)
        echo var_dump($statement->errorInfo());
}


if($result){
    echo json_encode(['id'=> 5]);
}
else{
    echo var_dump($statement->errorInfo());
}

