<?php
require_once 'connexion.php';

// Vérifiez si les données POST ne sont pas vides
if (!empty($_POST)) {
    // Données de publication non vides insérer un nouvel enregistrement
    // Configurez les variables qui vont être insérées, nous devons vérifier si les variables POST existent sinon nous pouvons les vider par défaut
    $id = isset($_POST['email']) && !empty($_POST['email']) && $_POST['email'] != 'auto' ? $_POST['email'] : '';
    // Vérifiez si la variable POST "nom" existe, sinon la valeur par défaut est vide, fondamentalement la même pour toutes les variables




$file = $_FILES['file'];
     $erreur= array();
     $fileName = $_FILES['file']['name'];
     $fileTmpName = $_FILES['file']['tmp_name'];
     $fileSize = $_FILES['file']['size'];
     $fileError = $_FILES['file']['error'];
     $fileType = $_FILES['file']['type'];

     $fileExt = explode('.',$fileName);
     $fileActualExt = strtolower(end($fileExt));


     $allowed = array('pdf', 'pptx', 'ppt');

     if(in_array($fileActualExt, $allowed)=== false){
      $erreur[] = "Ce type de fichier n'est pas autoriser ici !,Veillez mettre des fichiers en pdf ou powerpoint";
 }
    
            if($fileSize < 90000000 && empty($erreur)== true) {
              $rapp = uniqid('', true).".".$fileActualExt;
              $desti =  './img/'.$rapp;
              move_uploaded_file($fileTmpName, $desti);
             
            
    




    $name = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    
    // Insérer un nouvel enregistrement dans la table des contacts
    $stmt = $conn->prepare('INSERT INTO inf_rapp VALUES (?,?, ?, ?,?)');
    $stmt->execute( [ null ,$name, $email, $rapp, $fileName]);
    // Message de sortie
    $msg = 'Créer avec succès!';}
    else{
            echo"Ce fichier n'est pas autorisé" ;
                  }
                }
?>

<!Doctype html>
<html>
<head>  
    <link rel="stylesheet" type="text/css" href="first.css">  
    </head> 

<body>
<div class="background">
  <div class="container">
    <div class="screen">
      <div class="screen-header">
        <div class="screen-header-left">
          <div class="screen-header-button close"></div>
          <div class="screen-header-button maximize"></div>
          <div class="screen-header-button minimize"></div>
        </div>
        <div class="screen-header-right">
          <div class="screen-header-ellipsis"></div>
          <div class="screen-header-ellipsis"></div>
          <div class="screen-header-ellipsis"></div>
        </div>
      </div>
      <div class="screen-body">
        <div class="screen-body-item left">
          <div class="app-title">
            <span>Dêpot</span>
            <span>Rapport</span>
          </div>
         
          
        </div>
        <form action = "index.php" method="post" enctype="multipart/form-data">
          <div class="screen-body-item">
            <div class="app-form">
              <div class="app-form-group">
                  <input class="app-form-control" placeholder="prenom et nom" name= "prenom">
            </div>
              <div class="app-form-group">
                <input class="app-form-control" placeholder="email" name ="email">
              </div>
            <div class="app-form-group">
              <input class="app-form-control" type= "file" name="file">
            </div>
            
            <div class="app-form-group buttons">
              <button class="app-form-button">CANCEL</button>
              <button class="app-form-button" name = "enregistrer">SEND</button>

              
            </div>
          </div>
        </div>
</form>
      </div>
    </div>
    <div class="credits">
Inspired By
     
        <svg class="dribbble" viewBox="0 0 200 200">
          <g stroke="#ffffff" fill="none">
            <circle cx="100" cy="100" r="90" stroke-width="20"></circle>
            <path d="M62.737004,13.7923523 C105.08055,51.0454853 135.018754,126.906957 141.768278,182.963345" stroke-width="20"></path>
            <path d="M10.3787186,87.7261455 C41.7092324,90.9577894 125.850356,86.5317271 163.474536,38.7920951" stroke-width="20"></path>
            <path d="M41.3611549,163.928627 C62.9207607,117.659048 137.020642,86.7137169 189.041451,107.858103" stroke-width="20"></path>
          </g>
        </svg>
        Aziz
      </a>
    </div>
  </div>
</div>
</body>
</html>