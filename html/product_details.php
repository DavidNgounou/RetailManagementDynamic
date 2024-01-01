<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'gest_stock';
    $conn = new mysqli($hostname,$username,$password,$dbname);
    if($conn->error){
        die("Connection Failed <br>");
    }

    $prod_id = $_GET["prod_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product_details</title>
    <link rel="stylesheet" href="details.css">
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="prodpage.css">
</head>
<body>
    <section id="elt_details">
        <div class="elt_details">
            <div class="content elt_desc">
                <div class="elt_head">
                <?php
                    $sql = "SELECT * FROM produit WHERE id_produit = $prod_id";
                    $result = $conn->query($sql);
                    $word_limit = 15;
                    if($result){
                       while($row = $result->fetch_assoc()){
                         if(strlen($row["nom"])>$word_limit){
                            echo("<h2>");
                            echo substr($row["nom"],0,$word_limit)."...";
                            echo("</h2>");
                         }
                         else{
                            echo("<h2>");
                            echo substr($row["nom"],0,$word_limit);
                            echo("</h2>");

                         }
                       }
                    }
                ?>
                    <svg fill="#000000" onclick="document.getElementById('add_qty').style.display='flex'" width="24px" height="24px" viewBox="0 0 24 24" id="update" data-name="Flat Line" xmlns="http://www.w3.org/2000/svg" class="icon flat-line"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path id="primary" d="M4,12A8,8,0,0,1,18.93,8" style="fill: none; stroke: #9489F5; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path><path id="primary-2" data-name="primary" d="M20,12A8,8,0,0,1,5.07,16" style="fill: none; stroke: #9489F5; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path><polyline id="primary-3" data-name="primary" points="14 8 19 8 19 3" style="fill: none; stroke: #9489F5; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polyline><polyline id="primary-4" data-name="primary" points="10 16 5 16 5 21" style="fill: none; stroke: #9489F5; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polyline></g></svg>                </div>
                <div class="desc">
                    <div class="desc_img">
                        <?php
                            $sql = "SELECT * FROM produit WHERE id_produit = $prod_id;";
                            $result = $conn->query($sql);
                            if($result){
                                while($row = $result->fetch_assoc()){
                                    $nom = ''.$row["nom"] . '';
                                    echo "<img src='../php/" . $row["pimage_path"] . "' alt='" . $nom ."'>";
                                    $image = "'../php/" . $row["pimage_path"] . "' alt='" . $nom ."'";
                                    $qte_stock = $row["quantite_stock"];
                                    $seuil_rupt = $row["seuil_rupture"];
                                    $categorie = $row["id_categorie"];
                                }
                            }
                            $sql_cat = "SELECT nom_categorie FROM categorie WHERE id_categorie = $categorie;";
                            $result_c = $conn->query($sql_cat);
                            if($result_c){
                                while($row_c = $result_c->fetch_assoc()){
                                    $categories = $row_c["nom_categorie"];
                                }
                            }
                        ?>
                    </div>
                    <div class="desc_content">
                        <div class="operations">

                        </div>
                        <div class="desc_details">
                            <div class="head">
                                <h3>Description</h3>
                                <svg onclick="document.getElementById('new_prod').style.display='flex'" width=24px height=24px viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#9489F5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#9489F5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            </div>
                            <div class="details">
                                <p><span class="key">qte en stock </span>- <?php echo $qte_stock?></p>
                                <p><span class="key">Seuil de rupture </span>- <?php echo $seuil_rupt?></p>
                                <p><span class="key">Categorie </span>- <?php echo $categories ?></p>
                            </div>

                        </div>
                        <div class="cond_details">
                            <div class="head">
                                <h3>Conditionement et prix</h3>
                                <svg onclick="document.getElementById('new_classe').style.display='flex'"width=24px height=24px viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#9489F5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#9489F5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            </div>
                            <div class="details">
                            <?php 
                                $sql = "SELECT * FROM classe WHERE id_produit = $prod_id;";
                                $result = $conn->query($sql);
                                if($result->num_rows == 0){
                                    echo "<p><span class='error key' color=red>Aucun Conditionement attribuer pour ce produit </span>";

                                }
                                while ($row = $result->fetch_assoc()){
                                    $id_condition = $row["id_condition"];
                                    $quantite = $row["quantite"];
                                    $prix = $row["prix_classe"];
                                    $sqlc = "SELECT nom_condition FROM conditionement WHERE id_condition = $id_condition;";
                                    $resultc = $conn->query($sqlc);
                                    while($rowc = $resultc->fetch_assoc()){
                                        $configure_svg = '<svg width="24px" height = "24px" class= "right_icon" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>settings_5_fill</title> <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="System" transform="translate(-768.000000, -240.000000)" fill-rule="nonzero"> <g id="settings_5_fill" transform="translate(768.000000, 240.000000)"> <path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero"> </path> <path d="M14.4093,2.29252 C15.3919,2.53569 16.3171,2.92399 17.1605,3.43303 C17.5108,3.64448 17.697,4.04803 17.6305,4.45178 C17.5169,5.14078 17.6882,5.66772 18.0103,5.98974 C18.3323,6.31176 18.8592,6.48308 19.5482,6.36954 C19.952,6.30301 20.3555,6.48917 20.567,6.83951 C21.076,7.68291 21.4643,8.60804 21.7074,9.59069 C21.8058,9.98806 21.652,10.4052 21.3193,10.6437 C20.7515,11.0507 20.4999,11.5446 20.4999,12.0001 C20.4999,12.4556 20.7515,12.9495 21.3193,13.3565 C21.652,13.5949 21.8058,14.0121 21.7074,14.4095 C21.4643,15.3922 21.0759,16.3173 20.5669,17.1608 C20.3555,17.5111 19.9519,17.6973 19.5482,17.6307 C18.8592,17.5172 18.3323,17.6885 18.0103,18.0105 C17.6883,18.3325 17.5169,18.8595 17.6305,19.5484 C17.697,19.9522 17.5108,20.3557 17.1605,20.5672 C16.3171,21.0762 15.3919,21.4645 14.4092,21.7077 C14.0119,21.806 13.5947,21.6522 13.3562,21.3195 C12.9493,20.7517 12.4554,20.5001 11.9999,20.5001 C11.5443,20.5001 11.0504,20.7517 10.6435,21.3195 C10.405,21.6522 9.98782,21.806 9.59046,21.7077 C8.60778,21.4645 7.68263,21.0762 6.83922,20.5672 C6.48888,20.3557 6.30272,19.9522 6.36925,19.5484 C6.48277,18.8595 6.31146,18.3325 5.98944,18.0105 C5.66743,17.6885 5.14051,17.5172 4.45154,17.6307 C4.04779,17.6973 3.64424,17.5111 3.4328,17.1608 C2.92375,16.3173 2.53545,15.3922 2.29227,14.4095 C2.19394,14.0121 2.34772,13.5949 2.68044,13.3565 C3.24825,12.9495 3.49985,12.4556 3.49985,12.0001 C3.49985,11.5446 3.24825,11.0507 2.68044,10.6437 C2.34772,10.4052 2.19394,9.98806 2.29227,9.5907 C2.53544,8.60804 2.92373,7.68291 3.43274,6.83952 C3.64419,6.48918 4.04774,6.30301 4.4515,6.36955 C5.14049,6.48309 5.66743,6.31177 5.98945,5.98975 C6.31147,5.66772 6.48279,5.14078 6.36924,4.45179 C6.30271,4.04803 6.48887,3.64447 6.83921,3.43303 C7.68262,2.92399 8.60777,2.53569 9.59045,2.29252 C9.98782,2.19418 10.405,2.34797 10.6435,2.68069 C11.0504,3.24849 11.5443,3.50009 11.9999,3.50009 C12.4554,3.50009 12.9493,3.24849 13.3562,2.68069 C13.5947,2.34797 14.0119,2.19418 14.4093,2.29252 Z M11.9999,7 C9.23852,7 6.99995,9.23858 6.99995,12 C6.99995,14.7614 9.23852,17 11.9999,17 C14.7614,17 16.9999,14.7614 16.9999,12 C16.9999,9.23858 14.7614,7 11.9999,7 Z M11.9999,9 C13.6568,9 14.9999,10.3431 14.9999,12 C14.9999,13.6569 13.6568,15 11.9999,15 C10.3431,15 8.99995,13.6569 8.99995,12 C8.99995,10.3431 10.3431,9 11.9999,9 Z" id="形状" fill="#9489F5"> </path> </g> </g> </g> </g></svg>';
                                        echo "<p><span class='key'>". $rowc["nom_condition"] ."(". $quantite . ")" . "</span> - ". $prix . " XAF $configure_svg </p>";
                                    }
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content elt_graphs">
                <div class="elt_head">
                    <h2>Graphe de Performance</h2>
                </div>
                <img src="Graphe_produit.jpeg" width="100%" height="70%" alt="Graphe_produit">  
            </div>
            <div class="content elt_history">
                <div class="elt_head">
                    <h2>Historique</h2>
                </div>
                <table>
                    <tr id="hist_head">
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Concerner</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>50</td>
                            <td>12-10-2023</td>
                            <td>Fournisseur</td>
                        </tr>
                        <tr>
                            <td>50</td>
                            <td>12-10-2023</td>
                            <td>Fournisseur</td>
                        </tr>
                        <tr>
                            <td>50</td>
                            <td>12-10-2023</td>
                            <td>Fournisseur</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
            <div class="prod_info">
                <div class="important product_names">
                    <div class="section_heading">
                        <h2>Fournisseur</h2> 
                    </div>
                    <div class="product_list">
                        <div class="product">
                            TECNO CAMON 17 PRO
                        </div>
                        <div class="product">
                            AMAZFIT 13 PRO
                        </div>
                        <div class="product">
                            TECNO CAMON 17 PRO
                        </div>
                        <div class="product">
                            TECNO CAMON 17 PRO
                        </div>
                    </div>
                </div>   

            </div>
    </section>
    <div id = "new_prod" class="form_page">
        <div class="form_content ">
            <div class="form_heading">
                <h2>Modifier Produit</h2>
                <button class="close" onclick="document.getElementById('new_prod').style.display='none'">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM8.96963 8.96965C9.26252 8.67676 9.73739 8.67676 10.0303 8.96965L12 10.9393L13.9696 8.96967C14.2625 8.67678 14.7374 8.67678 15.0303 8.96967C15.3232 9.26256 15.3232 9.73744 15.0303 10.0303L13.0606 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0303 15.0303C9.73742 15.3232 9.26254 15.3232 8.96965 15.0303C8.67676 14.7374 8.67676 14.2625 8.96965 13.9697L10.9393 12L8.96963 10.0303C8.67673 9.73742 8.67673 9.26254 8.96963 8.96965Z" fill="#5246dd"></path> </g></svg>
                </button>
            </div>
            <?php
                $pathmp = "../php/modifier_produit.php?prod_id=$prod_id" 
            ?>
            <form action= <?php echo $pathmp?> method="post" enctype="multipart/form-data">
                <div class="form_div">
                    <div class="image_upl">
                        <img id="upl_img" src=<?php echo $image?>>
                        <input id="prod_img" name="prod_img" type="file" onchange="preview_img()">
                    </div>
                    <div class="product_info">
                        <div class="field">
                            <label for="nom_prod">Nom:</label>
                            <input id="nom_prod" name = "nom_prod" type="text" placeholder="Entrez nom produit" value="<?php echo $nom ?>" >
                        </div>
                        <div class="field">
                            <label for="qte_stock">Quantite en stock</label>
                            <input id="qte_stock" name = "qte_stock" type="number" placeholder="Entrez Quantite en stock" value = <?php echo $qte_stock?> >
                        </div>
                        <div class="field">
                            <label for="seuil_rupt">Seuil de rupture</label>
                            <input id="seuil_rupt" name = "seuil_rupt" type="number" placeholder="Entrez seuil rupture" value = <?php echo $seuil_rupt ?> >
                        </div>
                        <div class="field">
                            <label for="prod_cat">Categorie</label>
                            <select name="prod_cat" id="prod_cat">
                                <?php 
                                    $sql = "SELECT * FROM categorie";
                                    $result = $conn->query($sql);
                                    if($result){
                                        while($row = $result->fetch_assoc()){
                                            $id_cat = $row["id_categorie"];
                                            if($id_cat == $categorie){
                                                echo "<option value='" . $id_cat . "'selected>" . $row["nom_categorie"] . "</option>";
                                            }
                                            else{
                                                echo "<option value='" . $id_cat . "'>" . $row["nom_categorie"] . "</option>";
                                            }
                                        }
                                    }

                                ?>
                            </select>
                        </div>
                        <div class="submit">
                            <input class="sub_but" type="submit" value="Modifier">
                            <input class="sub_but" type="reset" value="Anuller">
                        </div>
                    </div>
                </div> 
            </form>
        </div>
        
    </div>
    <div id = "add_qty" class="form_page">
        <div class="form_content small">
            <div class="form_heading">
                <h2>Augmenter Quantite</h2>
                <button class="close" onclick="document.getElementById('add_qty').style.display='none'">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM8.96963 8.96965C9.26252 8.67676 9.73739 8.67676 10.0303 8.96965L12 10.9393L13.9696 8.96967C14.2625 8.67678 14.7374 8.67678 15.0303 8.96967C15.3232 9.26256 15.3232 9.73744 15.0303 10.0303L13.0606 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0303 15.0303C9.73742 15.3232 9.26254 15.3232 8.96965 15.0303C8.67676 14.7374 8.67676 14.2625 8.96965 13.9697L10.9393 12L8.96963 10.0303C8.67673 9.73742 8.67673 9.26254 8.96963 8.96965Z" fill="#5246dd"></path> </g></svg>
                </button>
            </div>
            <form action="">
                <div class="form_div">
                    <div class="product_info">
                        <div class="field">
                            <label for="qte_classe">Quantite:</label>
                            <input id="qte_classe" type="number" placeholder="Entrez quantite Classement">
                        </div>
                        <div class="submit">
                            <input class="sub_but" type="submit" value="Ajouter">
                            <input class="sub_but" type="reset" value="Anuller">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
    <div id = "new_classe" class="form_page">
        <div class="form_content">
            <div class="form_heading">
                <h2>Conditionement Config</h2>
                <button class="close" onclick="document.getElementById('new_classe').style.display='none'">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM8.96963 8.96965C9.26252 8.67676 9.73739 8.67676 10.0303 8.96965L12 10.9393L13.9696 8.96967C14.2625 8.67678 14.7374 8.67678 15.0303 8.96967C15.3232 9.26256 15.3232 9.73744 15.0303 10.0303L13.0606 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0303 15.0303C9.73742 15.3232 9.26254 15.3232 8.96965 15.0303C8.67676 14.7374 8.67676 14.2625 8.96965 13.9697L10.9393 12L8.96963 10.0303C8.67673 9.73742 8.67673 9.26254 8.96963 8.96965Z" fill="#5246dd"></path> </g></svg>
                </button>
            </div>
            <?php
                $pathcdcfg = "../php/ajout_condition_prod.php?prod_id=$prod_id" 
            ?>
            <form action= <?php echo $pathcdcfg?> method="post">
                <div class="form_div">
                    <div class="product_info">
                        <div class="field">
                            <label for="nom_classe">Nom:</label>
                            <select name="nom_classe" id="nom_classe">
                                <?php
                                    $sql = "SELECT * FROM conditionement";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()){
                                        echo "<option value=" . $row["id_condition"] . ">" . $row["nom_condition"] . "</option>";
                                        
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="field">
                            <label for="qte_classe">Quantite:</label>
                            <input id="qte_classe" name = "qte_classe" type="number" placeholder="Entrez quantite Classement">
                        </div>
                        <div class="field">
                            <label for="prix_classe">Prix(FCFA):</label>
                            <input id="prix_classe" name = "prix_classe" step = "any" type="text" placeholder="Entrez prix Classement">
                        </div>
                        <div class="submit">
                            <input class="sub_but" type="submit" value="Ajouter">
                            <input class="sub_but" type="reset" value="Anuller">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    </div>

</body>
<script src="upload_img.js"></script>
</html>