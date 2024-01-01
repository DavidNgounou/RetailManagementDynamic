<?php
    header("Refresh:0; url=produit.php");

    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'gest_stock';

    $nom_c=$_POST['nom_cond'];
    $con = new mysqli($hostname, $username, $password, $dbname);
    $r="insert into conditionement (nom_condition) values ('$nom_c') ";
    $e=mysqli_query($con,$r);
    if($e) echo("bien");
    else echo("mal");
?>