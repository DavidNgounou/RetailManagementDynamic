<?php
    header("Refresh:0; url=../html/client.php");
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'gest_stock';
    $conn = new mysqli($hostname,$username,$password,$dbname);

    if(!$conn){
        die("Sorry!!! a problem occured");
    }else{
        echo "Connection was a success";

        if(isset($_POST["submit"])){
            // Collecting values from the form
            $target_dir = 'uploads_client/';
            $nom  = $_POST["nom"];
            $adresse = $_POST["adresse"];
            $numero = $_POST["numero"];
            $email = $_POST["email"];
    
            if(!file_exists($target_dir)){
                mkdir($target_dir,0777,true);
            }
            if($_FILES["prod_img"]["name"]!=''){
    
                $file_name = explode('.',$_FILES["prod_img"]["name"]);
                $target_file = $target_dir . substr($file_name[0],0,16) . date('Ymdhis') . '.' . $file_name[1];
                move_uploaded_file($_FILES["prod_img"]["tmp_name"],$target_file);               
            }
            else{
                $target_file = $target_dir . 'no_image.jpeg';
            }

            //Inserting values in database
            $sql_prod_desc = "INSERT INTO client(nom_client,adresse,email,numero,c_image) VALUES ('$nom','$adresse','$email',$numero,'$target_file');";
            if($conn->query($sql_prod_desc)){
                echo "<br> Client details insertion was a success";
            }
            else{
                echo "Error occured: ".$conn->error;
            }
        }
    }
?>