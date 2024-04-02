<?php

include_once("class.pdofactory.php");
include_once("abstract.databoundobject.php");
include_once("./Logger/class.fileLoggerBackend.php");


class UserApp extends DataBoundObject {

        protected $ID;
        protected $Nom;
        protected $Group;
        protected $Created;
        protected $LastUpdated;
        protected $IsActive;



        protected function DefineTableName() {
                return("userapp");
        }

        protected function DefineRelationMap() {
                return(array(
                        "id" => "ID",
                        "nom" => "Nom",
                        "group" => "Group",
                        "created" => "Created",
                        "isactive" => "IsActive",
                        "lastupdated" => "LastUpdated"));
        }
}


print "Running...<br />";
$connectionString = "file:parse\prova.log";
$connectionStringP = "pgsql:dbname=usuaris;host=localhost;port=5432;user=postgres;password=postgres";

$urlData = parse_url($connectionString);

var_dump($urlData);

if (!isset($urlData['scheme'])) {
  throw new Exception("Invalid scheme connection.\n");
}

$fileName = 'Logger/class.' . $urlData['scheme'] . 'LoggerBackend.php';

include_once($fileName);

$classNameF = $urlData['scheme'] . 'LoggerBackend';

print "Class Name: " . $classNameF . "\n";

if (!class_exists($classNameF)) {
  throw new Exception("No loggind bakend available for " . $urlData['scheme']);
}

$logf = $classNameF::getInstance();
echo '<br> holaaa logf';
var_dump($logf);

//esto es para pgsql
$urlDataP = parse_url($connectionStringP);

var_dump($urlDataP);

if (!isset($urlDataP['scheme'])) {
  throw new Exception("Invalid scheme connection.\n");
}

$fileNameP = 'Logger/class.' . $urlDataP['scheme'] . 'LoggerBackend.php';

include_once($fileNameP);

$classNameP = $urlDataP['scheme'] . 'LoggerBackend';

print "Class Name: " . $classNameP . "\n";

if (!class_exists($classNameP)) {
  throw new Exception("No loggind bakend available for " . $urlDataP['scheme']);
}

$logp = $classNameP::getInstance();
echo '<br> holaaa logp';
var_dump($logp);

$strDSN = "pgsql:dbname=usuaris;host=localhost;port=5432";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "postgres",array());
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "....... - ".$classNameF;
 $objUserApp = new UserApp($objPDO,$logf,$classNameF,$logp,$classNameP);
 $now = date('Y-m-d H:i:s');



 $objUserApp->setNom('Marcos');
  $objUserApp->setGroup('Grupo 3');
  $objUserApp->setLastUpdated($now);
  $objUserApp->setIsActive(0);
  $objUserApp->Save();

 $objUserApp->fetNom('David');
 

// $objUserApp->Save();
// print "Saving...<br /> <br />";

// print "First user of the app: <br /> ";
// print "ID: " . $objUserApp->getID() . "<br />";
// print "Nom: " . $objUserApp->getNom() . "<br />";
// print "Group: " . $objUserApp->getGroup() . "<br />";
// print "Created: " . $objUserApp->getCreated() . "<br />";
// print "Is active?: " . $objUserApp->getIsActive() . "<br />";
// print "Last updated: " . $objUserApp->getLastUpdated() . "<br />";



// print "Updating...<br /> <br />";
// $objUserApp->setNom('Marcos');
// $objUserApp->setGroup('Grupo 3');
// $objUserApp->setLastUpdated($now);
// $objUserApp->setIsActive(0);

// print "First User app   updated: <br /> <br />";
// print "ID: " . $objUserApp->getID() . "<br />";
// print "Nom: " . $objUserApp->getNom() . "<br />";
// print "Group: " . $objUserApp->getGroup() . "<br />";
// print "Created: " . $objUserApp->getCreated() . "<br />";
// print "Is active?: " . $objUserApp->getIsActive() . "<br />";
// print "Last updated: " . $objUserApp->getLastUpdated() . "<br />";
// $objUserApp->Save();



//$objUserApp = new UserApp($objPDO,7);

/*
print "Deleting userapp: <br />";
print "Deleted userapp with id " . $objUserApp->getID() . "<br />";

$objUserApp->MarkForDeletion();
unset($objUserApp);

*/


?>