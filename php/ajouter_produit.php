<?php
    header("Refresh:0; url=../html/produit.php");
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
            $target_dir = 'uploads/';
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

            //Collecting the values from the form. 
            $prod_cat = $_POST["prod_cat"];
            $nom_prod = $_POST["nom_prod"];
            $seuil_rupt = $_POST["seuil_rupt"];
            $qte_stock = $_POST["qte_stock"];

            //Inserting values in database
            $sql_prod_desc = "INSERT INTO produit(id_categorie,nom,quantite_stock,seuil_rupture,pimage_path) VALUES ('$prod_cat','$nom_prod','$qte_stock','$seuil_rupt','$target_file');";
            if($conn->query($sql_prod_desc)){
                echo "<br> Product details insertion was a success";
            }
            else{
                echo "Error occured during Insertion";
            }
        }
    }
?>