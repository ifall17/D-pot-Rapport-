<?php
require_once'connexion.php';

$msg = '';
// Vérifier que l'ID de contact existe
if (isset($_GET['id'])) {
    // Sélectionnez l'enregistrement qui va être supprimé
    $stmt = $conn->prepare('SELECT * FROM inf_rapp WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $rapp = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$rapp) {
        header('Location: read.php');
        exit;
    }
    // Assurez-vous que l'utilisateur confirme avant la suppression
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // L'utilisateur a cliqué sur le bouton "Oui", supprimer l'enregistrement
            $stmt = $conn->prepare('DELETE FROM inf_rapp WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            //$msg = 'Vous avez supprimé le Rapport!';
            header('Location: read.php');
        } else {
            // L'utilisateur a cliqué sur le bouton "Non", le redirige vers la page de lecture
            header('Location: read.php');
            exit;
        }
    }
} else {
    header('Location: read.php');
    exit('Aucun identifiant spécifié!');
}
?>


<div class="content delete">
    <h2>Effacer ce rapport #<?=$rapp['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Êtes-vous sûr de vouloir supprimer ce rapport #<?=$rapp['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$rapp['id']?>&confirm=yes">Oui</a>
        <a href="delete.php?id=<?=$rapp['id']?>&confirm=no">Non</a>
    </div>
    <?php endif; ?>
</div>