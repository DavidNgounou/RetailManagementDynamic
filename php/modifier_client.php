<?php
    $client_id = $_GET["client_id"];
    header("Refresh: 0; url=../html/client_details.php?client_id=$client_id");
    $hostname = "localhost";
    $username = "root";
    $password = '';
    $dbname = 'gest_stock';
    $word_limit = 15;
    $conn = new mysqli($hostname,$username,$password,$dbname);
    if($conn->error){
        echo "Sorry connection failed";
    }
    else{
        echo "Connection was a success <br>";
        $target_dir = "uploads_client/";
        $nom_client  = $_POST["nom"];
        $adresse = $_POST["adresse"];
        $numero = $_POST["numero"];
        $email = $_POST["email"];

        if(!file_exists($target_dir)){
            mkdir($target_dir);
        }
        if($_FILES["prod_img"]["name"]!=''){
            $file_info = explode('.',$_FILES["prod_img"]["name"]);
            $target_file = $target_dir . substr($file_info[0],0,$word_limit) . date('Ymdhis') . '.'. $file_info[1];
            move_uploaded_file($_FILES["prod_img"]["tmp_name"],$target_file);
            
            //Deleting the old path
            $sql1 = "SELECT c_image FROM client WHERE id_client = $client_id";
            $resultp = $conn->query($sql1);
            while($row = $resultp->fetch_assoc()){
                $img_path = $row["c_image"];
                if(file_exists($img_path)){
                    unlink($img_path);
                }
            }
            $sql = "UPDATE client SET nom_client = '$nom_client', adresse = '$adresse', email = '$email', numero = $numero, c_image = '$target_file' WHERE id_client = $client_id ;";
        }else{
            $sql = "UPDATE client SET nom_client = '$nom_client', adresse = '$adresse', email = '$email', numero = $numero WHERE id_client = $client_id;";
        }
        $result = $conn->query($sql);
        if($result){
            echo "Success";
        }
        else{
            echo $conn->error;
        }
    }
?>