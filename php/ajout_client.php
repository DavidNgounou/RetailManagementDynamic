<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'gest_stock';

    $conn = new mysqli($hostname, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "Connection was a success <br>";

    if(isset($_POST["submit"])){
        $file = addslashes(file_get_contents($_FILES["prod_img"]["tmp_name"]));
        $sql = "INSERT INTO client(nom_client, email, numero, adresse, c_image) VALUES ('" . $_POST["nom_c"] . "','"  . $_POST["email_c"] . "','" . $_POST["numero_c"] . "','" . $_POST["adresse_c"] ."',".$file.");";
        if ($conn->query($sql) === TRUE) {
            echo "Insertion made successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
    

    $conn->close();
?>
