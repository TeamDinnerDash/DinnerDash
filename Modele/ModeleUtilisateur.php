<?php

    require_once("LienModele.php");

	class Utilisateur {

        private $id;
        private $nom;
        private $prenom;
    


        function Utilisateur ($id, $nom, $prenom)
        {
            $this->id= $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
           
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

        function setNom () {
            $this->id=$id;
        }

        function getPrenom ()
        {
            return $this->prenom;
        }
  
        function setPrenom () {
            $this->prenom=$prenom;
        }

    }

    class ModeleUtilisateur {

    	static function createDataBaseUtilisateur(){
            $req="create table if not exists UTILISATEUR (id serial, nom varchar(32), prenom varchar(32), 
                                            
                                            constraint pk_joueur primary key (id));
                                            
                    create table if not exists Utilisateurs_USERS(id serial, login varchar(32) UNIQUE, mdp varchar(32), creation boolean,
                    edition boolean, lecture boolean, constraint pk_users primary key (id));";
                                            
            global $connection;
            $creation= $connection->prepare($req);                              
            $creation->execute();
        }
        
        static function convertionTableUtilisateur($pers) {
            $util=new Utilisateur($pers->id, $pers->nom, $pers->prenom);
            $util->setId($pers->id);
            return $util;
        }

        static function getListeUtilisateur ()
        {
            global $connection;
            $req="select * from UTILISATEUR;";
            $creation= $connection->prepare($req);
            $creation->execute();
            while ($util=$creation->fetch(PDO::FETCH_OBJ)){
                $liste_utilisateur[] = convertionTableUtilisateur($util);
            }
            return $liste_utilisateur;
        }
        static function getUtilisateur($i)
        {
            global $connection;
            $req="select * from UTILISATEUR where id=$i;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $pers=$creation->fetch(PDO::FETCH_OBJ);
            if($pers){
                $pers = convertionTableUtilisateur($util);
                return $pers;
            }
            else{
                return NULL;
            }
            
        }

        static function ajouteUtilisateur ($p)
        {
            $req="insert into UTILISATEUR values (default,\"".$p->getNom()."\", \"".$p->getPrenom()."\");";
            global $connection;
            $creation= $connection->prepare($req);  
            $creation->execute();
            return true;
        }

        static function supprimeUtilisateur ($index)
        {
            $req="delete from JOUEUR where id= ".$index.";";
            global $connection;
            $creation= $connection->prepare($req);  
            $creation->execute();
            return true;
        }

        static function modifieUtilisateur ($index, $p)
        {
            $req="update personnes set nom=\"".$p->getNom()."\", prenom=\"".$p->getPrenom()."\", meilleurScore=\"".$p->getMeilleurScore()."\", niveau='".$p->getNiveau()."' where id=".$index.";";
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