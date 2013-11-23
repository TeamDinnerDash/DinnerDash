<?php

	class Table {

		private $numero;
		private $capacite;
		private $nbCient;

		function Table ($numero, $capacite, $nbClient) {
			$this->numero = $numero;
			$this->capacite = $capacite;
			$this->nbClient = $nbClient; 
		}

		function getNumero () {
			return $this->numero;
		}

		function getCapacite () {
			return $this->capacite;
		}
		function getNbClient () {
			return $this->nbClient;
		}
		function setNbClient ($nbClient) {
			return $this->nbClient = $nbClient;
		}

	}

	class ModeleTable {

		static function createDataBaseTable () {
			$req="create table if not exists TABLE( numero integer, capacite integer, nbClient integer,
												constraint pk_table primary key (numero));
					insert into Table (nom, capacite) VALUES ('1', '2'), ('2', '2'), ('5', '4'), ('6', '4'), 
															('8','6'), ('9','6'), ('10', '10');";
			global $connection;
            $creation= $connection->prepare($req);                              
            $creation->execute();
		}

		 static function convertionTableTable($tab){
            $table=new Table($tab->numero, $tab->capacite), $tab->nbClient;
            return $table;
        }


        static function getListeTable ()
        {
            global $connection;
            $req="select * from TABLE;";
            $creation= $connection->prepare($req);
            $creation->execute();
            while ($table=$creation->fetch(PDO::FETCH_OBJ)){
                $liste_table[] = ModeleTable::convertionTableTable($table);
            }
            return $liste_table;
        }

        static function getCapacite ($i)
        {
            global $connection;
            $req="select * from TABLE where numero=$i;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $cap=$creation->fetch(PDO::FETCH_OBJ);
            if($cap){
                $cap = ModeleTable::convertionTableTable($tab);
                return $cap;
            }
            else{
                return NULL;
            }

        static function getNbClient ($i)
        {
            global $connection;
            $req="select * from TABLE where numero=$i;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $cap=$creation->fetch(PDO::FETCH_OBJ);
            if($cap){
                $cap = ModeleTable::convertionTableTable($tab);
                return $cap;
            }
            else{
                return NULL;
            }


	}


?>