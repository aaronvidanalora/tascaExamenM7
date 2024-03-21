<?php
require("class.pdofactory.php");
require("abstract.databoundobject.php");
require("class.userApp.php");

print "Running...<br />";

$strDSN = "pgsql:dbname=usuaris;host=localhost;port=5432";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "postgres", array());
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$objUser = new UserApp($objPDO);

// Establecer valores para la nueva entrada
$objUser->setId(1); // Aquí debes proporcionar un valor adecuado para el ID
$objUser->setNom("John Doe");
$objUser->setGroup("Admin");
$objUser->setCreated(date("Y-m-d H:i:s"));
$objUser->setLastUpdated(date("Y-m-d H:i:s"));
$objUser->setIsActive(true);

print "Nombre: " . $objUser->getNom() . "<br />";
print "Grupo: " . $objUser->getGroup() . "<br />";
print "Fecha de creación: " . $objUser->getCreated() . "<br />";
print "Última actualización: " . $objUser->getLastUpdated() . "<br />";
print "Activo: " . ($objUser->getIsActive() ? 'Sí' : 'No') . "<br />";

print "Guardando...<br />";
$objUser->Save();

$id = $objUser->getID();
print "ID en la base de datos es " . $id . "<br />";

print "Destruyendo objeto...<br />";
unset($objUser);

print "Volviendo a crear objeto desde ID $id<br />";
$objUser = new UserApp($objPDO, $id);

print "Mostrando datos después de guardar:<br />";
print "Nombre: " . $objUser->getNom() . "<br />";
print "Grupo: " . $objUser->getGroup() . "<br />";
print "Fecha de creación: " . $objUser->getCreated() . "<br />";
print "Última actualización: " . $objUser->getLastUpdated() . "<br />";
print "Activo: " . ($objUser->getIsActive() ? 'Sí' : 'No') . "<br />";

print "Haciendo cambios...<br />";
$objUser->setNom("Jane Smith");
$objUser->setGroup("User");
$objUser->setLastUpdated(date("Y-m-d H:i:s"));
$objUser->setIsActive(true);
print "Guardando cambios...<br />";
$objUser->Save();

print "Mostrando datos después de editar:<br />";
print "Nombre: " . $objUser->getNom() . "<br />";
print "Grupo: " . $objUser->getGroup() . "<br />";
print "Fecha de creación: " . $objUser->getCreated() . "<br />";
print "Última actualización: " . $objUser->getLastUpdated() . "<br />";
print "Activo: " . ($objUser->getIsActive() ? 'Sí' : 'No') . "<br />";
// print "Marking for deletion <br />";
// $objUser->MarkForDeletion();
// unset($objUser);
?>

