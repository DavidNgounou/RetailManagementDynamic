<?php
    header("Refresh:0; url=..\html\produit.php");
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'gest_stock';

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO categorie (nom_categorie) VALUES (?)");
    $stmt->bind_param("s", $nom_c);

    // Set parameters and execute
    $nom_c = trim($_POST['nom_cat']);
    $result = $stmt->execute();
    if ($result) {
        echo "bien";
        // Redirect to the same page
        // header('Location: '.$_SERVER['PHP_SELF']);
        // exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
?>
