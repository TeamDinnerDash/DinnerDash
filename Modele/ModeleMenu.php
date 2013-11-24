<?php

	include ('MenuIngredients.php');

	class Menu {

		private $nom;
		private $ingredients;
		private $tmpPreparation;
		private $prix;
		
		function Menu ($nom, $ingredients, $tmpPreparation, $prix) {
			$this->nom=$nom;
			$this->ingredients=$ingredients;
			$this->tmpPreparation=$tmpPreparation;
			$this->prix=$prix;
			
		}

		function getNom ()
        {
            return $this->nom;
        }
        function getIngredients ()
        {
            return $this->prenom;
        }
        function getTmpPreparation ()
        {
            return $this->tmpPreparation;
        }
        function getPrix()
        {
            return $this->prix;
        }
    
	}


	class ModeleMenu {

		static function CreateDataBaseMenu () {
			$req = "create table if not exists MENU(nom varchar(32), ingredients varchar(32), tmpPreparation integer, 
                                            prix integer, 
                                            constraint pk_Menu PRIMARY KEY (nom),
                                            constraint pk_Menu FOREIGN KEY (ingredients) REFERENCES INGREDIENTS (Ingredients));

					

					INSERT INTO MENU (nom, ingredients, tmpPreparation, prix) VALUES ('Potage', ['tomate', 'creme'], '20', '10'),
																					('Couscous', [graine, legumes], '30', '15');";

					
			global $connection;
            $creation= $connection->prepare($req);                              
            $creation->execute();

                    
		}

		static function convertionTableMenu($m){
            $menu=new Menu($m->nom, $m->ingredients, $m->tmpPreparation, $m->prix);
            return $menu;
        }
        
         static function getListeMenu ()
        {
            global $connection;
            $req="select * from MENU;";
            $creation= $connection->prepare($req);
            $creation->execute();
            while ($menu=$creation->fetch(PDO::FETCH_OBJ)){
                $liste_menu[] = ModeleMenu::convertionTableMenu($menu);
            }
            return $liste_menu;
        }


         static function getNom ($n)
        {
            global $connection;
            $req="select * from MENU where nom=$n;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $menu=$creation->fetch(PDO::FETCH_OBJ);
            if($menu){
                $menu = ModeleMenu::convertionTableMenu($m);
                return $menu;
            }
            else{
                return NULL;
            }
		}
		
         static function getIngredientsMenu ($i)
        {
            global $connection;
            $req="select * from MENU where ingredients=$i;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $ingr=$creation->fetch(PDO::FETCH_OBJ);
            if($ingr){
                $ingr = ModeleMenu::convertionTableMenu($m);
                return $ingr;
            }
            else{
                return NULL;
            }
		}

        static function getTmpPreparation ($t) {

            global $connection;
            $req="select * from MENU where tmpPreparation=$t;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $tmp=$creation->fetch(PDO::FETCH_OBJ);
            if($tmp){
                $tmp = ModeleMenu::convertionTableMenu($m);
                return $tmp;
            }
            else{
                return NULL;
			}
		}

        static function getPrix ($p) {

            global $connection;
            $req="select * from MENU where prix=$p;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $prix=$creation->fetch(PDO::FETCH_OBJ);
            if($prix){
                $prix = ModeleMenu::convertionTableMenu($m);
                return $prix;
            }
            else{
                return NULL;
			}
		}


       
	}


?>


