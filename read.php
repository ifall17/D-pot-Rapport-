<?php
require_once 'connexion.php';
// Connectez-vous à la base de données MySQL
//$conn = pdo_connect_mysql();
// Obtenir la page via la requête GET (paramètre d'URL: page), si elle n'existe pas, la page est définie par défaut sur 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Nombre d'enregistrements à afficher sur chaque page
$records_per_page = 5;
// Préparez l'instruction SQL et obtenez les enregistrements de notre table de contacts, LIMIT déterminera la page
$stmt = $conn->prepare('SELECT * FROM inf_rapp ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Récupérer les enregistrements afin que nous puissions les afficher dans notre modèle.
$rapp = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Obtenez le nombre total de contacts, afin que nous puissions déterminer s'il devrait y avoir un bouton suivant et précédent
$num_rapp = $conn->query('SELECT COUNT(*) FROM inf_rapp')->fetchColumn();
?>











<!Doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@1.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #ADD8E6;">
    <div class="text-gray-900 bg-#3e3e3e-200">
    <div class="p-4 flex">
        <h1 class="text-3xl">
            Liste des étudiants et leur rapport
        </h1>
    </div>
    <div class="px-3 py-4 flex justify-center">
        <table class="w-full text-md bg-white shadow-md rounded mb-4">
            <tbody>
                <tr class="border-b">
                    <th class="text-left p-3 px-5">Name</th>
                    <th class="text-left p-3 px-5">Email</th>
                    <th class="text-left p-3 px-5">Rapport de Stage </th>
                    
                    <th></th>
                </tr>
                <?php foreach ($rapp as $rapp): ?>
                <tr class="border-b hover:bg-orange-100 bg-gray-100">
                    <td class="p-3 px-5"><?=$rapp['prenom']?></td>
                    <td class="p-3 px-5"><?=$rapp['email']?></td>
                    <td class="p-3 px-5"><?=$rapp['nom_rapport']?>
                        
                     </td>  

                    
                    <td class="p-3 px-5 flex justify-end"> <a href="telecharger.php?id=<?=$rapp['id']?>"><button type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Save</button></a>
                    <a href="delete.php?id=<?=$rapp['id']?>" class="trash"><i class="fas fa-trash fa-xs"><button type="button" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Supprimer</button></a>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
