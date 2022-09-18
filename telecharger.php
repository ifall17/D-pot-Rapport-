<?php
	require_once 'connexion.php';
 
	if(ISSET($_REQUEST['id'])){
		$id = $_REQUEST['id'];
		$query = $conn->prepare("SELECT * FROM inf_rapp WHERE id=?");
		$query->execute([$_REQUEST['id']]);
		$fetch = $query->fetch();
 
		header("Content-Disposition: attachment; filename=".$fetch['nom_rapport']);
		header("Content-Type: application/octet-stream;");
		readfile("img/".$fetch['rapport']);
	}
?>