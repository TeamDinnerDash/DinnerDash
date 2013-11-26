<?php

    require_once("LienModele.php");

	class Joueur {

        private $id;
        private $nom;
        private $prenom;
       	private $meilleurScore;
       	private $niveau


        function Joueur ($nom, $prenom, $meilleurScore, $niveau)
        {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->meilleurScore = $meilleurScore;
            $this->niveau = $niveau;
        }

    
        function getId ()
        {
            return $this->id;
        }
        function setId ($id)
        {
            $this->id=$id;
        }
        function getNom ()
        {
            return $this->nom;
        }
        function getPrenom ()
        {
            return $this->prenom;
        }
        function getMeilleurScore ()
        {
            return $this->meilleurScore;
        }
        function setMeilleurScore ($meilleurScore) {
        	return $this->meilleurScore= $meilleurScore;
        }
        function getNiveau ()
        {
            return $this->niveau;
        }
        function setNiveau ($niveau) {
        	return $this->niveau = $niveau;
        }

    }

    class ModeleJoueur {

    	static function createDataBaseJoueur(){
            $req="create table if not exists JOUEUR(id serial, nom varchar(32), prenom varchar(32), 
                                            meilleurScore integer, niveau integer,
                                            constraint pk_joueur primary key (nom, prenom));
                                            
                    create table if not exists JOUEUR_USERS(id serial, login varchar(32) UNIQUE, mdp varchar(32), creation boolean,
                    edition boolean, lecture boolean, constraint pk_users primary key (id));";
                                            
            global $connection;
            $creation= $connection->prepare($req);                              
            $creation->execute();
        }
        
        static function convertionTableJoueur($pers) {
            $joueur=new Joueur($pers->nom, $pers->prenom, $pers->meilleurScore, $pers->niveau);
            $joueur->setId($pers->id);
            return $joueur;
        }

        static function getListeJoueur ()
        {
            global $connection;
            $req="select * from JOUEUR;";
            $creation= $connection->prepare($req);
            $creation->execute();
            while ($joueur=$creation->fetch(PDO::FETCH_OBJ)){
                $liste_joueur[] = ModeleJoueur::convertionTablePersonne($joueur);
            }
            return $liste_joueur;
        }
        static function getJoueur($i)
        {
            global $connection;
            $req="select * from JOUEUR where id=$i;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $pers=$creation->fetch(PDO::FETCH_OBJ);
            if($pers){
                $pers = ModeleJoueur::convertionTablePersonne($pers);
                return $pers;
            }
            else{
                return NULL;
            }
            
        }

        static function ajoutePersonne ($p)
        {
            $req="insert into JOUEUR values (default,\"".$p->getNom()."\", \"".$p->getPrenom()."\", \"".$p->meilleurScore()."\", '".$p->getNiveau."');";
            global $connection;
            $creation= $connection->prepare($req);  
            $creation->execute();
            return true;
        }

        static function supprimePersonne ($index)
        {
            $req="delete from JOUEUR where id= ".$index.";";
            global $connection;
            $creation= $connection->prepare($req);  
            $creation->execute();
            return true;
        }

        static function modifiePersonne ($index, $p)
        {
            $req="update JOUEUR set nom=\"".$p->getNom()."\", prenom=\"".$p->getPrenom()."\", meilleurScore=\"".$p->getMeilleurScore()."\", niveau='".$p->getNiveau()."' where id=".$index.";";
            global $connection;
            $creation= $connection->prepare($req);
            $creation->execute();
            return true;
        }
        static function connection($login, $mdp){
            $req="select * from JOUEUR_USERS where login=\"$login\" AND password=\"$password\";";
            global $connection;
            $creation= $connection->prepare($req);
            $creation->execute();
            $pers=$creation->fetch(PDO::FETCH_OBJ);
            if ($login!=NULL){
                $_SESSION['login']=$login;
            }
        }
        static function deconnection(){
            unset($_SESSION); 
            VuePersonnes::vue_message("Vous ête bien déconnecté(e)");
        }


    }




?>