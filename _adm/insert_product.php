<?php
include("../status/connected.php");
include("header_op.php"); 
include("../config.php");
include("configCSS_adm.html");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Insertion d'un produit</title>
  </head>
  
  <body>
	<h2>📥 Ajouter un nouvel article 📥</h2>

  <script>
List = new Array();
function Remplir(valeur){
  var sel="";
  sel ="<select size='1' name='souscat'>";
  // Parcourir le tableau
  for (var i=0;i<List.length;i++)
   {
     // tester si la ligne du tableau (Sous-catégorie) correspond à la valeur de la catéhorie
     if (List[i][1]==valeur)
     {
       // Ajouter une rubrique sous-catégorie au variable SEL
       sel= sel + "<option value="+List[i][0]+">"+List[i][2]+"</option>";
     }

   }
   sel =sel + "</select>";
   // Modifier le DIV scat par la nouvelle List à partir du variable SEL
   document.getElementById('scat').innerHTML=sel;
}
</script>
</head>
<body>

<form method="POST" action="Ajout6.php3">
  <select size="1" name="cat" OnChange="Remplir(cat.value)">
<?php
// Paramètres de la Connexion à la base MYSQL
$i=0; // variable de test
$j=0; // variable pour garder la valeur du premier enregistrement catégorie pour l'affichage

// Séléction de tous les enregistrements de la table Catégorie
$rq="Select * from categorie order by designation;";
$result= mysqli_query ($rq) or die ("Select impossible");

while ($dt=mysqli_fetch_row($result))
{
 // Remplir la liste déroulante des catégorie
 echo "\t\t<option value=".($dt[0]).">".($dt[1])."</option>";
 if ($i==0) { $j=$dt[0]; $i=1; } // garder la valeur du premier enregistrement
}

?>

</select><br><br>

<DIV id="scat">
<select size="1" name="souscat">
</select>
</DIV>

<?php

// Séléction de tous les enregistrements de la table Sous-Catégorie
$rq="Select * from sous_categorie order by designation;";
$result= mysqli_query ($rq) or die ("Select impossible");
// $i = initialise le variable i
$i=0;
while ($dt=mysqli_fetch_row($result))
{
 // Remplir le tableau (array) en javascript
 // ex : List[1]=new Array (1,1,"Sous-catégorie 1");
 // ex : List[2]=new Array (2,1,"Sous-catégorie 2");
 echo "<script>List[".$i."] = new Array(".($dt[0]).",".($dt[1]).",'".($dt[2])."');</script>";
 $i=$i+1; // Incrémentation de $i
}
echo "<script>Remplir ($j); </script>"; // Remplir la deuxième liste de choix avec les données
                                        // des sous-catégories en utilisant la valeur j
?>
<br><br>
  <input type="submit" name="Send" value="Envoyer">
</form>
  <!--
    <form action="insert_product.php" class="centre" method="POST">
        Catégorie : <br>
        <input type="text" name="category"> <br>
        
        Libellé : <br>
        <input type="text" name="label"> <br>
        
        Description : <br>
        <textarea name="description"></textarea> <br><br>

        Poids : <br>
        <input type="text" name="poids"> <br>

        Couleur : <br>
        <input type="text" name="couleur"> <br>

        Dimensions : <br>
        <input type="text" name="dimensions"> <br>

        Diamètre du filament : <br>
        <input type="text" name="diamètre_filament"> <br>

        Prix HT : <br>
        <input type="text" name="prix_HT"> <br>

        Précision : <br>
        <input type="text" name="précision"> <br>

        Température de transition vitreuse : <br>
        <input type="text" name="temperature_transi_vitreuse"> <br>

        Température de point de fusion : <br>
        <input type="text" name="temperature_point_de_fusion"> <br>
        
        Image : <br>
        <input type="text" name="image"> <br>

        <input type="submit" value="Insérer">

	<input type="button" onclick="location.href='./main.php';" value="Retour liste" />
    </form>

-->

<?php
if (!empty($_POST['category']) && (!empty($_POST['label'])) && !empty($_POST['description']) && !empty($_POST['poids']) && !empty($_POST['couleur']) && !empty($_POST['dimensions']) && !empty($_POST['diamètre_filament']) && !empty($_POST['prix_HT']) && !empty($_POST['précision']) && !empty($_POST['temperature_transi_vitreuse']) && !empty($_POST['temperature_point_de_fusion'])) {
	$sql = "INSERT INTO product (catégorie, libellé, description, poids, couleur, dimensions, diamètre_filament, précision, temperature_transi_vitreuse, temperature_point_de_fusion, prix_HT, image) VALUES ('".$_POST['category']."', '".$_POST['label']."', '".$_POST['description']."' , '".$_POST['poids']."' , '".$_POST['couleur']."' , '".$_POST['dimensions']."' , '".$_POST['diamètre_filament']."' , '".$_POST['précision']."' , '".$_POST['temperature_transi_vitreuse']."' , '".$_POST['temperature_point_de_fusion']."', '".$_POST['prix_HT']."' , '".$_POST['image']."')";
	if (mysqli_query($conn, $sql)) {
      		echo "Produit ajouté avec succès";
	} else {
      		echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
	}
}

if (empty($_POST['category'])) {
	echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Catégorie manquante !</div>';	
	}
if (empty($_POST['label'])) {
	echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Label manquant !</div>';	
	}
if (empty($_POST['description'])) {
	echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Description manquante !</div>';	
	}
if (empty($_POST['poids'])) {
	echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Poids manquant !</div>';	
	}
if (empty($_POST['couleur'])) {
	echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Couleur manquante !</div>';	
	}
if (empty($_POST['dimensions'])) {
	echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Dimensions manquantes !</div>';	
	}
if (empty($_POST['diamètre_filament'])) {
	echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Diamètre manquant !	</div>';	
	}
if (empty($_POST['prix_HT'])) {
	echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Prix hors taxe manquant !	</div>';	
	}
if (empty($_POST['précision'])) {
	echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Précision manquante !</div>';	
	}
if (empty($_POST['temperature_transi_vitreuse'])) {
	echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Temp transi vitreuse manquante !</div>';	
	}
if (empty($_POST['temperature_point_de_fusion'])) {
	echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Temp au point de fusion manquante !</div>';	
	}
if (empty($_POST['image'])) {
	echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Image manquante.</div>';
	}


?>




  </body>
</html>
