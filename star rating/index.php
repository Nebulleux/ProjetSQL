<?PHP
include('_connexion.php'); // Fichier de connexion à la base de données

function starRating($numStar, $id2, $starWidth) {
	global $bdd;
	$cookie_name = 'rating'.$id2; // Nom du cookie
	$nbrPixelsInDiv = $numStar * $starWidth; // Calcul de la largeur de la div en pixels
	
	$query = 'SELECT rate, nbrrate FROM rating WHERE idProduct='.$id2.''; // On récupère la moyenne et le nombre de votes pour un média identifié par la variable $mediaId

	$select = $bdd->prepare($query); 
	$select->execute();
	
	if ( $select->rowCount() > 0 ) {
		$rate = $select->fetch();
		$average = round($rate['rate'] / $rate['nbrrate'], 2);
		// Nombre de pixels à colorier en jaune
		$numEnlightedPX = round($nbrPixelsInDiv * $average / $numStar, 0);
	} else {
		$numEnlightedPX = 0;
	}
	
	
	$getJSON = array('numStar' => $numStar, 'mediaId' => $id2);
	$getJSON = json_encode($getJSON);
 
	$starRating = '<div id="'.$id2.'" align="center">';
	$starRating .= '<div class="star_bar" style="width:'.$nbrPixelsInDiv.'px; height:'.$starWidth.'px; background: linear-gradient(to right, #ffc600 0px,#ffc600 '.$numEnlightedPX.'px,#ccc '.$numEnlightedPX.'px,#ccc '.$nbrPixelsInDiv.'px);" rel='.$getJSON.'>';
	for ($i=1; $i<=$numStar; $i++) {
		$starRating .= '<div title="'.$i.'/'.$numStar.'" id="star'.$i.'" class="star"';
		if( !isset($_COOKIE[$cookie_name]) ) $starRating .= ' onmouseover="overStar('.$id2.', '.$i.', '.$numStar.'); return false;" onmouseout="outStar('.$id2.', '.$i.', '.$numStar.'); return false;" onclick="rateMedia('.$id2.', '.$i.', '.$numStar.', '.$starWidth.'); return false;"';
		$starRating .= '></div>';
	}
	$starRating .= '</div>';
	$starRating .= '<div class="resultMedia'.$id2.'" style="font-size: small; color: grey">';
	if ( $select->rowCount() == 0 ) $starRating .= 'Pas encore noté - par <a href="https://www.1two.org" target="_blank">1two</a>';
	else { $starRating .= 'Note : ' . $average . '/' . $numStar . ' (' . $rate['nbrrate'] . ' votes) - par <a href="https://www.1two.org" target="_blank">1two</a>'; }
	$starRating .= '</div>';
	$starRating .= '<div class="box'.$id2.'"></div>';
	$starRating .= '</div>';
	return $starRating;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr" dir="ltr">
<head>
	<title>1two Star Rating System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta charset="utf-8" />
	
	<style>
	.star { display: inline-block; background: url("design/star.png") no-repeat; width: 44px; height: 44px }
	.star_hover { display: inline-block; background: url("design/star.png") no-repeat; background-position: 0 -44px; width: 44px; height: 44px }
	</style>
	
</head>

<body>
<h1 align="center">A very precise jQuery Ajax star rating system tutorial</h1>
<?php
echo '<p align="center">Exemple de système de notation avec <b>3 étoiles</b>';
echo starRating(3, 1, 44); // 3 étoiles, ID 1, 44px star image
echo '</p>';

echo '<p align="center">Exemple de système de notation avec <b>5 étoiles</b>';
echo starRating(5, 2, 44); // 5 étoiles, ID 2, 44px star image
echo '</p>';

echo '<p align="center">Exemple de système de notation avec <b>10 étoiles</b>';
echo starRating(10, 3, 44); // 10 étoiles, ID 3, 44px star image
echo '</p>';

// Essayez d’ajouter d’autres systèmes d’étoiles, par exemple : echo starRating(20, 157, 44); -> 20 étoiles, Media ID 157
?>

<!-- N’oubliez pas d’ajouter un lien vers la bibliothèque JavaScript jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script type="text/javascript" src="js/star-rating-tuto.js"></script>

</body>