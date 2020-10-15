<?php

include('../db.php');


try{
    $db = new PDO("mysql:host=$data[hostname];dbname=$data[dbname];port=$data[port];charset=$data[charset];",$data['user'],$data['pass']);
}catch(PDOException $e){
    echo $e->getMessage();
    exit;
}
$select="SELECT * FROM list ORDER BY list_order ASC";
$statement= $db->prepare($select);
$statement->execute();
$li_list=$statement->fetchAll(PDO::FETCH_ASSOC);

/*
$list_array=array();
while($result=$statement->fetch(PDO::FETCH_ASSOC)){
    array_push($list_array,$result);
}
echo json_encode($list_array);
*/
?>

<script>
    var li_list=<?= json_encode($li_list,JSON_NUMERIC_CHECK);?>
</script>