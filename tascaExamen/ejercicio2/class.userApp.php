<?php

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
                return array(
                    "id" => "ID",
                    "nom" => "Nom", 
                    "group" => "Group",
                    "created" => "Created",
                    "lastupdated" => "LastUpdated",
                    "isactive" => "IsActive"
                );
            }
            
}

?>
