<?PHP
// Connexion serveur
try {
	$dns = 'mysql:host=localhost;dbname=db_3d'; // Mettez ici vos paramètres de connexion
	$user = 'root';
	$password = '';
	// Connection options
	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
	);
	// Initialize the connection
	$bdd = new PDO( $dns, $user, $password, $options );
} catch ( Exception $e ) {
	echo 'Connection to MySQL impossible: ' . $e->getMessage();
	die();
}
?>