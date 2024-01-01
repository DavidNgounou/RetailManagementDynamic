<?php
    $client_id = $_GET["client_id"];
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'gest_stock';
    $conn = new mysqli($hostname,$username,$password,$dbname);
    if($conn->error){
        die("Connection Failed <br>");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>client details</title>
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
                    $sql = "SELECT * FROM client WHERE id_client = $client_id";
                    $result = $conn->query($sql);
                    $word_limit = 20;
                    if($result){
                       while($row = $result->fetch_assoc()){
                         if(strlen($row["nom_client"])>$word_limit){
                            echo("<h2>");
                            echo substr($row["nom_client"],0,$word_limit)."...";
                            echo("</h2>");
                         }
                         else{
                            echo("<h2>");
                            echo substr($row["nom_client"],0,$word_limit);
                            echo("</h2>");

                         }
                       }
                    }
                ?>
                </div>
                <div class="desc">
                    <div class="desc_img">
                    <?php
                            $sql = "SELECT * FROM client WHERE id_client = $client_id;";
                            $result = $conn->query($sql);
                            if($result){
                                while($row = $result->fetch_assoc()){
                                    $nom = ''.$row["nom_client"] . '';
                                    $image = "'../php/" . $row["c_image"] . "' alt='" . $nom ."'";
                                    echo "<img src='../php/" . $row["c_image"] . "' alt='" . $nom ."'>";
                                    $image = "'../php/" . $row["c_image"] . "' alt='" . $nom ."'";
                                    $adresse = $row["adresse"];
                                    $email = $row["email"];
                                    $numero = $row["numero"];
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
                                <svg onclick="document.getElementById('new_c').style.display='flex'" width=24px height=24px viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#9489F5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#9489F5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            </div>
                            <div class="details">
                                <p><span class="key">Email </span>- <?php echo $email ?> </p>
                                <p><span class="key">Addresse </span>- <?php echo $adresse ?> </p>
                                <p><span class="key">Telephone </span>- <?php echo $numero ?> </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="content elt_graphs">
                <div class="elt_head">
                    <h2>Graphe de Performance</h2>
                </div>
                <img src="Graphe_produit.jpeg" width="100%" height="60%" alt="graphe de Performance">
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
                            <td>client</td>
                        </tr>
                        <tr>
                            <td>50</td>
                            <td>12-10-2023</td>
                            <td>client</td>
                        </tr>
                        <tr>
                            <td>50</td>
                            <td>12-10-2023</td>
                            <td>client</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
            <div class="prod_info">
                <div class="important product_names">
                    <div class="section_heading">
                        <h2>client</h2> 
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
    <div id = "new_c" class="form_page">
        <div class="form_content">
            <div class="form_heading">
                <h2>Modifier client</h2>
                <button class="close" onclick="document.getElementById('new_c').style.display='none'">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM8.96963 8.96965C9.26252 8.67676 9.73739 8.67676 10.0303 8.96965L12 10.9393L13.9696 8.96967C14.2625 8.67678 14.7374 8.67678 15.0303 8.96967C15.3232 9.26256 15.3232 9.73744 15.0303 10.0303L13.0606 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0303 15.0303C9.73742 15.3232 9.26254 15.3232 8.96965 15.0303C8.67676 14.7374 8.67676 14.2625 8.96965 13.9697L10.9393 12L8.96963 10.0303C8.67673 9.73742 8.67673 9.26254 8.96963 8.96965Z" fill="#5246dd"></path> </g></svg>
                </button>
            </div>
            <?php
                $path = "../php/modifier_client.php?client_id=$client_id" 
            ?>
            <form action=<?php echo $path ?> method="post" enctype="multipart/form-data">
                <div class="form_div">
                    <div class="image_upl">
                        <img id="upl_img" src=<?php echo $image ?> alt="No image">
                        <input id="prod_img" name ="prod_img" type="file" onchange="preview_img()">
                    </div>
                    <div class="product_info">
                        <div class="field">
                            <label for="nom">Nom</label>
                            <input id="nom" name = "nom" type="text" placeholder="Entrez nom client" value="<?php echo $nom ?>">
                        </div>
                        <div class="field">
                            <label for="adresse">Adresse</label>
                            <input id="adresse" name="adresse" type="text" placeholder="Entrez addresse client" value="<?php echo $adresse ?>">
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="text" placeholder="Entrez email client" value = "<?php echo $email ?>">
                        </div>
                        <div class="field">
                            <label for="numero">Numero</label>
                            <input id="numero" name="numero" type="number" placeholder="Entrez numero client" value = <?php echo $numero ?>>
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