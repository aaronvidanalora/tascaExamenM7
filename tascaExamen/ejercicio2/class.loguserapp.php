<?php


include_once("class.pdofactory.php");
include_once("abstract.databoundobject.php");
include_once("./Logger/class.fileLoggerBackend.php");
include_once("./Logger/class.pgsqlLoggerBackend.php");



class LogUserApp extends DataBoundObject {

        protected $IDUserApp;
        protected $IsActive;
        protected $Codi;
        protected $Regtime;
        protected $Comentari;



        protected function DefineTableName() {
                return("loguserapp");
        }

        protected function DefineRelationMap() {
                return(array(
                        "iduserapp" => "IDUserApp",
                        "isactive" => "IsActive",
                        "codi" => "Codi",
                        "regtime" => "Regtime",
                        "comentari" => "Comentari"
                        ));
        }
}



?>