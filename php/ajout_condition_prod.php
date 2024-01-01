<?php
    $prod_id = $_GET["prod_id"];
    header("Refresh: 0; url=../html/product_details.php?prod_id=$prod_id");
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'gest_stock';
    $conn = new mysqli($hostname,$username,$password,$dbname);
    
    if($conn->error){
        echo "Connection Failed";
    }
    else{
        echo "Connection Success<br>";
        $condition = $_POST["nom_classe"];
        $qte = $_POST["qte_classe"];
        $prix_classe = $_POST["prix_classe"];

        $sql = "INSERT INTO classe VALUES ($prod_id, $condition ,$qte , $prix_classe);";
        $result = $conn->query($sql);
        if($result){
            echo "Successful Insertion";
        }
        else{
            echo "Unsuccessful Insertion: " . $conn->error;
        }

    }
?>