<?php
include('../_connexion.php'); // Fichier de connexion à la base de données
 
if($_POST) {
	$mediaId = $_POST['mediaId'];
	$rate = $_POST['rate'];
	
	$expire = 5; // Durée de vie du cookie de 5 secondes. Mettre 24*30*3600 pour 1 mois
	setcookie('1twoRatingTuto'.$mediaId, 'rated', time() + $expire, '/');
	
	$query = 'SELECT id, rate, nbrrate FROM 1two_star_rating WHERE media='.$mediaId.'';
	$select = $bdd->prepare($query); 
	$select->execute();
	
	if ( $select->rowCount() > 0 ) {
		$result = $select->fetch();
		
		$update = $bdd->prepare('UPDATE 1two_star_rating SET rate = rate + '.$rate.', nbrrate = nbrrate + 1 WHERE media = '.$mediaId.'');
		try {
			$success = $update->execute();
			
			$newRate = $result['rate'] + $rate;
			$newNbrRate = $result['nbrrate'] + 1;
			
		} catch( Exception $e ){
			echo 'Query error: ' . $e->getMessage();
		}
			
		
	} else {
		
		$insert = $bdd->prepare('INSERT INTO 1two_star_rating (media, rate, nbrrate) VALUES(:media, :rate, :nbrrate)');
		try {
			$success = $insert->execute(array(
			'media'=>$mediaId,
			'rate'=>$rate,
			'nbrrate'=>1,
			));
			
			$newRate = $rate;
			$newNbrRate = 1;
		
		} catch( Exception $e ){
			echo 'Query error: ' . $e->getMessage();
		}

	}
	
	// CLOSE BDD
	$select = null;
	$bdd = null;
	
	$average = round ( $newRate / $newNbrRate, 2 );
			
	$dataBack = array('avg' => $average, 'nbrRate' => $newNbrRate);
	$dataBack = json_encode($dataBack);
	
	echo $dataBack;
}
?>