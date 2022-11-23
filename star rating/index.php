<?PHP
// Licence
// Copyright © 2022 1two

// Vous pouvez modifier à souhait le script afin qu’il corresponde exactement à vos besoins.

// Le script est fourni « tel quel », sans garantie d’aucune sorte. En aucun cas, les auteurs ou les détenteurs du copyright ne seront responsables de toute réclamation, dommage ou autre responsabilité, que ce soit dans une action contractuelle, délictuelle ou autre, découlant de, ou en relation avec le script.

// Si vous utilisez ce script sur votre site Internet, vous êtes tenu, par courtoisie, de garder le lien présent vers la page d’accueil du site 1two.org, agissant comme un avis de droit d’auteur. Vous êtes autorisé à placer le lien à un autre endroit de votre/vos page(s), dans du contenu, une colonne ou le pied de page par exemple.

// Si vous souhaitez acheter le script afin de vous exempter de tout copyright et être autorisé à retirer le lien, vous pouvez faire le paiement de 10 euros via Paypal.
// Pour ce faire, rendez-vous sur cette page : https://www.1two.org/star-rating-system

// Si vous avez des doutes quant à l’utilisation de ce script, contactez-nous : https://www.1two.org/wiki-contact-p3
// Si vous souhaitez que nous apportions des modifications pour vous, comme un autre format d’étoiles, d’autres couleurs…, contactez-nous : https://www.1two.org/wiki-contact-p3

include('_connexion.php'); // Fichier de connexion à la base de données

function starRating($numStar, $mediaId, $starWidth) {
	global $bdd;
	$cookie_name = '1twoRatingTuto'.$mediaId; // Nom du cookie
	$nbrPixelsInDiv = $numStar * $starWidth; // Calcul de la largeur de la div en pixels
	
	$query = 'SELECT rate, nbrrate FROM 1two_star_rating WHERE media='.$mediaId.''; // On récupère la moyenne et le nombre de votes pour un média identifié par la variable $mediaId
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
	
	
	$getJSON = array('numStar' => $numStar, 'mediaId' => $mediaId);
	$getJSON = json_encode($getJSON);
 
	$starRating = '<div id="'.$mediaId.'" align="center">';
	$starRating .= '<div class="star_bar" style="width:'.$nbrPixelsInDiv.'px; height:'.$starWidth.'px; background: linear-gradient(to right, #ffc600 0px,#ffc600 '.$numEnlightedPX.'px,#ccc '.$numEnlightedPX.'px,#ccc '.$nbrPixelsInDiv.'px);" rel='.$getJSON.'>';
	for ($i=1; $i<=$numStar; $i++) {
		$starRating .= '<div title="'.$i.'/'.$numStar.'" id="star'.$i.'" class="star"';
		if( !isset($_COOKIE[$cookie_name]) ) $starRating .= ' onmouseover="overStar('.$mediaId.', '.$i.', '.$numStar.'); return false;" onmouseout="outStar('.$mediaId.', '.$i.', '.$numStar.'); return false;" onclick="rateMedia('.$mediaId.', '.$i.', '.$numStar.', '.$starWidth.'); return false;"';
		$starRating .= '></div>';
	}
	$starRating .= '</div>';
	$starRating .= '<div class="resultMedia'.$mediaId.'" style="font-size: small; color: grey">';
	if ( $select->rowCount() == 0 ) $starRating .= 'Pas encore noté - par <a href="https://www.1two.org" target="_blank">1two</a>';
	else { $starRating .= 'Note : ' . $average . '/' . $numStar . ' (' . $rate['nbrrate'] . ' votes) - par <a href="https://www.1two.org" target="_blank">1two</a>'; }
	$starRating .= '</div>';
	$starRating .= '<div class="box'.$mediaId.'"></div>';
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
echo starRating(3, 1, 44); // 3 étoiles, Media ID 1, 44px star image
echo '</p>';

echo '<p align="center">Exemple de système de notation avec <b>5 étoiles</b>';
echo starRating(5, 2, 44); // 5 étoiles, Media ID 2, 44px star image
echo '</p>';

echo '<p align="center">Exemple de système de notation avec <b>10 étoiles</b>';
echo starRating(10, 3, 44); // 10 étoiles, Media ID 3, 44px star image
echo '</p>';

// Essayez d’ajouter d’autres systèmes d’étoiles, par exemple : echo starRating(20, 157, 44); -> 20 étoiles, Media ID 157
?>

<!-- N’oubliez pas d’ajouter un lien vers la bibliothèque JavaScript jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script type="text/javascript" src="js/star-rating-tuto.js"></script>

</body>