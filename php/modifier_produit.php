<?php
    $prod_id = $_GET["prod_id"];
    header("Refresh: 0; url=../html/product_details.php?prod_id=$prod_id");
    $hostname = "localhost";
    $username = "root";
    $password = '';
    $dbname = 'gest_stock';
    $conn = new mysqli($hostname,$username,$password,$dbname);
    if($conn->error){
        echo "Sorry connection failed";
    }
    else{
        echo "Connection was a success <br>";
        $target_dir = "uploads/";
        $nom_p  = $_POST["nom_prod"];
        $qte_stock = $_POST["qte_stock"];
        $seuil_rupt = $_POST["seuil_rupt"];
        $categorie = $_POST["prod_cat"];

        if(!file_exists($target_dir)){
            mkdir($target_dir);
        }
        if($_FILES["prod_img"]["name"]!=''){
            $file_info = explode('.',$_FILES["prod_img"]["name"]);
            $target_file = $target_dir . substr($file_info[0],0,15) . date('Ymdhis') . '.'. $file_info[1];
            move_uploaded_file($_FILES["prod_img"]["tmp_name"],$target_file);
            
            //Deleting the old path
            $sql1 = "SELECT pimage_path FROM produit WHERE id_produit = $prod_id";
            $resultp = $conn->query($sql1);
            while($row = $resultp->fetch_assoc()){
                $img_path = $row["pimage_path"];
                if(file_exists($img_path)){
                    unlink($img_path);
                }
            }
            $sql = "UPDATE produit SET nom = '$nom_p', quantite_stock = $qte_stock, seuil_rupture = $seuil_rupt, id_categorie = $categorie, pimage_path = '$target_file' WHERE id_produit = $prod_id ;";
        }else{
            $sql = "UPDATE produit SET nom = '$nom_p', quantite_stock = $qte_stock, seuil_rupture = $seuil_rupt, id_categorie = $categorie WHERE id_produit = $prod_id;";
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