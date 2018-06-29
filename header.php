<?php
function autoloadClasses($classname)
{
	require 'class/' . $classname . '.class.php';
}
spl_autoload_register('autoloadClasses');

//Database connexion
$db = new PDO('mysql:host=localhost;dbname=file_system', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); //Alerte a chaque fois qu'une requete a �chou�.

//Manager's instanciation
$manager = new ManagerElement($db);

?>
