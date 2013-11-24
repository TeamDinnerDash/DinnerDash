<?php

	class Ingredients {

		private $ingr;
		private $prix_ingr;

		function Ingredients ($ingr, $prix_ingr) {
			this->$ingr=$ingr;
			this->$prix_ingr=$prix_ingr;
		} 

		function getIngr () {
			return $this->$ingr;
		}

		function getPrix_ingr () {
			return $this->$prix_ingr;
		}
	}

	class ModeleIngredients {

		static function CreateDataBaseMenu () {
			$req = "create database if not exists INGREDIENTS(Ingredients varchar(32), ingredients_Prix integer,
																constraint pk_INGREDIENTS PRIMARY KEY (ingredients));

					INSERT INTO INGREDIENTS (ingredients, prix) VALUES ('tomate', '2')
																			('creme', '5')
																			('graine', '3')
																			('legumes', '8');";

					
				
				global $connection;
	            $creation= $connection->prepare($req);                              
	            $creation->execute();	
	            
		}

		static function convertionTableIngredients ($i) {
     	 	$ingred= new Ingredients($i->ingr, $i->prix_ingr);
       		return $ingred;
        }


        static function getListeIngredients () {
        	global $connection;
        	$req="selec * from INGREDIENTS;";
        	$creation= $connection->prepare($req);
        	$creation->execute();
        	while ($ingred=$creation->fetch(PDO::FETCH_OBJ)){
        		$liste_ingredients[] = ModeleMenu::convertionTableIngredients($ingred);
        	}
        }

         static function getIngredients ($i) {

            global $connection;
            $req="select * from INGREDIENTS where ingredients=$i;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $ingr=$creation->fetch(PDO::FETCH_OBJ);
            if($ingr){
                $ingr = ModeleMenu::convertionTableIngredients($i);
                return $ingr;
            }
            else{
                return NULL;
			}
		}
		
        static function getIngredients_Prix ($i) {

            global $connection;
            $req="select * from INGREDIENTS where ingredients_Prix=$i;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $prixr=$creation->fetch(PDO::FETCH_OBJ);
            if($prix){
                $prix = ModeleMenu::convertionTableIngredients($i);
                return $prix;
            }
            else{
                return NULL;
			}
		}
	}
	


?>