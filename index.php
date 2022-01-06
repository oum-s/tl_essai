<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Teenlabs</title>
      <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="./css/style.css">
   </head>
<!-- NAVIGATEUR -->
   <body>
      <header>
         <div class="header-top">
            <div class="header-container">
                <div class="row">
            <!-- LOGO -->
            <nav>
                  <h1 class="logo"><img src="./img/tl.png" alt="logo"></h1>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="https://teenlabs.fr/" ">Accueil</a></li>
                    <li class="nav-item"><a href="https://teenlabs.fr/content/39-offrir" ">Des cadeaux</a></li>
                    <li class="nav-item""><a href="https://teenlabs.fr/2-les-activites" ">Les activites</a></li>
                    <li class="nav-item"><a href="https://teenlabs.fr/content/12-notre-reseau" ">Notre réseau</a></li>
                    <li class="nav-item"><a href="https://teenlabs.fr/blogs.html" ">Le blog</a></li>
                    <li class="nav-item"><a href="https://teenlabs.fr/nous-contacter" ">Nous contacter</a></li>
                    <li class="nav-item"><a href="https://teenlabs.fr/content/4-qui-sommes-nous" ">A propos</a></li>
            </ul>
            </nav>

                </div>
            </div>
         </div>
      </header>

<!-- CONTAINER -->
                <div class="container">
                    <section class="container-fluid">
                    <div class="row">
                    <!-- FORMULAIRE -->
                    <div class="col-md-6-first">
                        <h1><span>OBTENEZ UN BADGE POUR CHAQUE ACTIVITÉ RÉALISÉE
                        </span></h1><br>
                        
                        <form role="form" method="post" action="">
                            <div class="row">
                               <div class="form-group">
                                  <label for="domaines" class="domaines">Domaines </label>
                                  <select class="form-control" id="domaines" name="domaines"  onchange="this.form.submit()">
                                     <option selected="" disabled="">Selectionnez un domaine</option>
                                     <?php
                                        //Exemple de syntaxe de connexion à la base de données pour PHP et MySQL.
                                        //Se connecter à la base de données
                                        
                                        $hostname="localhost";
                                        $username="root";
                                        $password="";
                                        $dbname="teenlabs";
                                        $conn = mysqli_connect($hostname, $username, $password, $dbname); //Ouvre la connexion à la base
                                        /* change character set to utf8mb4 */
                                        printf("Initial character set: %s\n", $conn->character_set_name());
                                        $conn->set_charset("utf8mb4");
                                        printf("Current character set: %s\n", $conn->character_set_name());
                                        # Vérifier si des enregistrements existent
                                        
                                        $query = "SELECT * FROM domaines";
                                        
                                        $result = $conn->query($query);
                                        
                                        if($result){
                                                while($row = mysqli_fetch_array($result)){
                                                    $id = $row["id"];   
                                                    $name = $row["name"];
                                                        echo("<option id='".$id."' value='".$id."'");
                                                        if(isset($_POST['domaines'])){
                                                            if($_POST['domaines']==$id){
                                                                echo(" selected");
                                                            }
                                                                    
                                                        }
                                                        echo(">".$name."</option>");
                                                }
                                        }
                                        ?>
                                  </select>
                               </div>
                            </div>
                            <div class="row">
                               <div class="form-group">
                                  <label for="activites" class="activites">Activites </label>
                                  <select class="form-control" id="activites" name="activites">
                                     <option selected="" disabled="">Selectionnez une activitée</option>
                                     <?php
                                        # Vérifier si des enregistrements existent
                                        
                                        $query = "SELECT DISTINCT activites.id as act_id, activites.name as act_name FROM activites INNER JOIN activites_domaines on activites_domaines.id_activite=activites.id"
                                                . " INNER JOIN domaines on activites_domaines.id_domaine=domaines.id ";
                                        
                                        if(isset($_POST['domaines'])){
                                            $query = $query . " WHERE domaines.id = " . $_POST['domaines'];
                                        }
                                        
                                        $result = $conn->query($query);
                                        
                                        if($result){
                                                while($row = mysqli_fetch_array($result)){
                                                    $id = $row["act_id"];   
                                                    $name = $row["act_name"];
                                                        echo "<option id='".$id."' value='".$id."'>".$name."</option>";
                                                }
                                        }
                                        

                                        ?>	
                                  </select>
                               </div>
                            </div>
                         </form>
                         <img src="" alt="">
                    
                  <!-- AFFICHAGE BADGES -->
                    <section class="affichage-badges">
                     <div class="badges">
                     <?php
                                      $query = "SELECT DISTINCT domaines.id as dom_id, domaines.img as img FROM domaines INNER JOIN activites_domaines on activites_domaines.id_activite=domaines.id"
                                      ;
                              
                              if(isset($_POST['domaines'])){
                                  $query = $query . " WHERE domaines.id = " . $_POST['domaines'];
                              }
                              
                              $result = $conn->query($query);
                              
                              if($result){
                                      while($row = mysqli_fetch_array($result)){  
                                    $id = $row["dom_id"];
                                    $img = $row["img"];
                                              echo "<td><img src= ".$img."></td>";
                                      }
                              }
                              ?>	
                     </div><br>
                     <div class="description-badges">
                     <?php
                                      $query = "SELECT DISTINCT domaines.id as dom_id, domaines.descr as descr FROM domaines INNER JOIN activites_domaines on activites_domaines.id_activite=domaines.id"
                                      ;
                              
                              if(isset($_POST['domaines'])){
                                  $query = $query . " WHERE domaines.id = " . $_POST['domaines'];
                              }
                              
                              $result = $conn->query($query);
                              
                              if($result){
                                      while($row = mysqli_fetch_array($result)){  
                                    $id = $row["dom_id"];
                                    $descr = $row["descr"];
                                              echo "<td><p>.$descr.</p></td>";
                                      }
                              }
                              
                              mysqli_close($conn); //Refermer la connexion ouverte à la base
                              ?>	
                     </div>
                     </section>
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="col-md-6" style="padding: 20px;">
                        <p>
                        <h3>Bienvenue sur l’espace des Open Badges, géré par TeenLabs !</h3>
                        Nos Open Badges sont certifiés grâce au générateur Open Badge Factory, et créés à partir du DIGCOMP, le cadre de référence européen des compétences numériques.
                        Ce formulaire vous permettra de découvrir les badges correspondants aux activités de chaque domaine de compétences.<br>

                        <h3>Qu’est-ce qu’un Open Badge ?</h3>
                        Un badge est une image numérique contenant l'enregistrement d'informations, ou métadonnées, comme l’identité de l’organisme émetteur, les critères d'attribution ou encore les preuves justificatives. 
                        C'est une déclaration numérique claire, vérifiable et infalsifiable, relative à vos réalisations.<br>

                        <h3>A quoi ça sert ?</h3>
                        Vous pourrez prouver vos compétences à l'aide de badges qui certifient vos expériences et vos expertises ; renforcées par les organismes de formation et les personnes autour de vous qui vous reconnaissent.<br>

                        <h3>Comment ça marche ?</h3>
                        Véritables valorisations des compétences, ces badges permettent de créditer vos efforts de découvertes et de formations, ainsi que vos expériences diverses. Devenez réellement crédibles en développant peu à peu votre galerie de badges personnalisée, en fonction de vos préférences. Vous pourrez ainsi créer votre 1er CV pour appuyer toutes vos demandes auprès d’écoles, d'entreprises ou même gagner en crédibilité auprès de vos parents 😉<br>

                        <h3>Vous ne trouvez pas le Badge qui vous correspond ?</h3>
                        Vous avez aussi la possibilité de nous envoyer une activité que vous avez réalisée ou un projet auquel vous avez participé : nous l’étudierons et il est possible que nous développions un badge correspondant pour vous et ensuite le proposer à l’ensemble de la communauté TeenLabs ! 
                                            </p><br>
                     </div>


                    </div>
                    </section>
                    </div>
<!-- FOOTER -->
 <footer>              

      <div class="row_footer">
         <div class='footer_logo'>
            <img src="./img/tl_logo_footer.png" alt="logo_footer">
         </div>
         <section class="footer-item">
         <h4>Présentation</h4>
             <ul>
                <li><a href="https://teenlabs.fr/content/4-qui-sommes-nous">Qui sommes-nous ?</a></li>
                <li><a href="https://teenlabs.fr/content/18-manifeste">Le manifeste</a></li>
                <li><a href="https://teenlabs.fr/nous-contacter">Contact</a></li>
             </ul>                         
         </section>
         <section class="footer-item">
         <h4>Le site </h4>
            <ul>
                <li><a href="https://teenlabs.fr/">Accueil</a></li>
                <li><a href="https://teenlabs.fr/2-les-activites">Les activités</a></li>
                <li><a href="https://teenlabs.fr/content/12-notre-reseau">Le réseau</a></li>
                <li><a href="https://teenlabs.fr/blogs.html">Le Blog</a></li>
            </ul>                         
         </section>
         <section class="footer-item">
            <h4>Légal</h4>
            <ul>
               <li><a href="https://teenlabs.fr/content/2-mentions-legales">Mentions légales</a></li>
               <li><a href="https://teenlabs.fr/content/10-cgv">CGV</a></li>
               <li><a href="https://teenlabs.fr/content/11-cookies">Données personnelles et cookies</a></li>
            </ul>
         </section>
      </div>

      </footer>    

    </body>   
      </html>