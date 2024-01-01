<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'gest_stock';

    $conn = new mysqli($hostname,$username,$password,$dbname);
    if($conn->error){
        die("Connection failed:" . $conn->connect_error);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page client</title>
    <link rel="stylesheet" href="prodpage.css">
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <section class="prod_page">
        <div class="pg_content">
            <div class="prod_info">
                <div class="content product_names">
                    <div class="section_heading">
                        <h2>Client</h2> 
                        <svg onclick="document.getElementById('new_c').style.display='flex'" width= 24 height=24 viewBox="0 0 24 24" class="icon" fill="#c3bdff" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" stroke="#9489F5" stroke-width="1.5"></path> <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="#9489F5" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>             
                    </div>
                    <div class="product_list">
                    <?php
                        $sql = 'SELECT * FROM client';
                        $result = $conn->query($sql);
                        if(!$result){
                            die("Error executing query: ".$conn->error);
                        }
                        while ($row = $result->fetch_assoc()){
                            echo "<div class='product'><a href='client_details.php?client_id=" . $row["id_client"] . "' target='cdetails_frame'>" . $row["nom_client"]. "</a></div>";
                        }
                    ?>
                    </div>
                </div>
            </div>
            <iframe name="cdetails_frame" src="none_selected.html" frameborder="0" width="100%" height="100vh"></iframe>
        </div> 
        <!--End Page Content-->
    </section>
    <div id = "new_c" class="form_page">
        <div class="form_content">
            <div class="form_heading">
                <h2>Nouveau Client</h2>
                <button class="close" onclick="document.getElementById('new_c').style.display='none'">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM8.96963 8.96965C9.26252 8.67676 9.73739 8.67676 10.0303 8.96965L12 10.9393L13.9696 8.96967C14.2625 8.67678 14.7374 8.67678 15.0303 8.96967C15.3232 9.26256 15.3232 9.73744 15.0303 10.0303L13.0606 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0303 15.0303C9.73742 15.3232 9.26254 15.3232 8.96965 15.0303C8.67676 14.7374 8.67676 14.2625 8.96965 13.9697L10.9393 12L8.96963 10.0303C8.67673 9.73742 8.67673 9.26254 8.96963 8.96965Z" fill="#5246dd"></path> </g></svg>
                </button>
            </div>
            <form action="../php/ajouter_client.php" enctype="multipart/form-data" method="post">
                <div class="form_div">
                    <div class="image_upl">
                        <img id="upl_img" src="..\icons\no_image.jpeg" alt="No image">
                        <input id="prod_img" name="prod_img" type="file" onchange="preview_img()">
                    </div>
                    <div class="product_info">
                        <div class="field">
                            <label for="nom">Nom</label>
                            <input id="nom" name="nom" type="text" placeholder="Entrez nom client">
                        </div>
                        <div class="field">
                            <label for="adresse">Adresse</label>
                            <input id="adresse" name="adresse" type="text" placeholder="Entrez addresse en client">
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="text" placeholder="Entrez email client">
                        </div>
                        <div class="field">
                            <label for="numero">Numero</label>
                            <input id="numero" name = "numero" type="number" placeholder="Entrez numero client">
                        </div>
                        
                        <div class="submit">
                            <input class="sub_but" type="submit" name="submit" value="Ajouter">
                            <input class="sub_but" type="reset" value="Anuller">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    </div>

</body>
<script src="upload_img.js">
   
</script>
</html>