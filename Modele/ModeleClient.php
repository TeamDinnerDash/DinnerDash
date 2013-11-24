<?php

	require_once("LienModele.php");

	class Client {

		private $numClient;
		private $nbPersonne;
		private $choixMenu;
		private $tempsAttente;

		function Client ($numClient, $nbPersonne, $choixMenu, $tempsAttente) {
			$this->numClient=$numClient;
			$this->nbPersonne=$nbPersonne;
			$this->choixMenu=$choixMenu;
			$this->tempsAttente=$tempsAttente;
		}

		function getNumClient () {
			return $this->numClient;
		}
		function getnbPersonne () {}
			return $this->nbPersonne;
		}
		function getChoixMenu () {
			return $this->choixMenu;
		}
		function getTempsAttente () {
			return $this->tempsAttente;
		}
	}

	class ModeleClient {

		static function createDataBaseClient () {
			$req= "create data base if not exists CLIENT(numClient integer, nbPersonne integer, choixMenu varchar(32), tempsAttente integer,
														constraint pk_client PRIMARY KEY (numClient, nbPersonne),
                                            			constraint pk_client FOREIGN KEY (choixMenu) REFERENCES MENU (nom));";
			
			global $connection;
            $creation= $connection->prepare($req);                              
            $creation->execute();
		}

		static function convertionTableClient ($m){
            $client=new Client($m->numClient, $m->nbPersonne, $m->choixMenu, $m->tempsAttente);
            return $client;
        }

          static function getListeClient ()
        {
            global $connection;
            $req="select * from CLIENT;";
            $creation= $connection->prepare($req);
            $creation->execute();
            while ($client=$creation->fetch(PDO::FETCH_OBJ)){
                $liste_client[] = ModeleClient::convertionTableClient($client);
            }
            return $liste_client;
        }



             static function getNbPersonne($i)
        {
            global $connection;
            $req="select * from CLIENT where nbPersonne=$i;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $client=$creation->fetch(PDO::FETCH_OBJ);
            if($client){
                $client = ModeleClient::convertionTableClient($client);
                return $client;
            }
            else{
                return NULL;
            }

		    static function getChoixMenu ($i)
		    {
		        global $connection;
		        $req="select * from CLIENT where choixMenu=$i;";
		        $creation= $connection->prepare($req);      
		        $creation->execute();
		        $client=$creation->fetch(PDO::FETCH_OBJ);
		        if($client){
	            $client = ModeleClient::convertionTableClient($client);
                return $client;
		        }
		        else{
		            return NULL;
	            }

            static function getTempsAttente ($i) {
	            global $connection;
	            $req="select * from CLIENT where tempsAttente=$i;";
	            $creation= $connection->prepare($req);      
	            $creation->execute();
	            $client=$creation->fetch(PDO::FETCH_OBJ);
	            if($client) {
	                $client = ModeleClient::convertionTableClient($client);
	                return $client;
	            }
	            else{
	                return NULL;
	            }
	}

?>