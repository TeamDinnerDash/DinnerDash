<?php

    require_once("LienModele.php");

	class Ingredients {

        private $numero;  
        private $ingr;
        private $quantite;
    	private $prix_ingr;

		function Ingredients ($numero, $ingr, $quantite, $prix_ingr) {
            $this->numero=$numero;
			$this->ingr=$ingr;
            $this->quantite=$quantite;
			$this->prix_ingr=$prix_ingr;
		} 

        function getNumero () {
            return $this->numero;
        }

		function getIngr () {
			return $this->ingr;
		}

        function getQuantite () {
            return $this->quantite;
        }

		function getPrix_ingr () {
			return $this->prix_ingr;
		}
	}

	class ModeleIngredients {

		static function CreateDataBaseMenu () {
			$req = "create database if not exists INGREDIENTS(Numero integer, Ingredients varchar(32), Quantite integer, Prix integer,
																constraint pk_INGREDIENTS PRIMARY KEY (Numero));

					INSERT INTO INGREDIENTS (Numero, Ingredients, Quantite, Prix) VALUES ('1', 'frites', '5', '1')
																			             ('2', 'creme', '2', '5')
																		              	('3', 'graine', '2' '3')
																		              	('4', 'legumes', '4' '8');
                                                                                        ('5', 'pain', '5', '2')
                                                                                        ('6', 'viande', '4', '10')
                                                                                        ('7', 'pates', '3', '5')
                                                                                        ('8', 'lardons', '3', '3')
                                                                                        ('9', 'riz', '2', '3') 
                                                                                         ('10', 'epices', '3', '4');";
                                                                                       

					
				
				global $connection;
	            $creation= $connection->prepare($req);                              
	            $creation->execute();	
	            
		}

		static function convertionTableIngredients ($i) {
     	 	$ingred= new Ingredients($i->numero, $i->ingr, $i->quantite, $i->prix_ingr);
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

        static function getNumero ($i) {

            global $connection;
            $req="select * from INGREDIENTS where Numero=$i;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $num=$creation->fetch(PDO::FETCH_OBJ);
            if($num){
                $num = ModeleMenu::convertionTableIngredients($i);
                return $num;
            }
            else{
                return NULL;
        }

        static function getQuantite ($i) {

            global $connection;
            $req="select * from INGREDIENTS where ingredients=$i;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $quant=$creation->fetch(PDO::FETCH_OBJ);
            if($quant){
                $quant= ModeleMenu::convertionTableIngredients($i);
                return $quant;
            }
            else{
                return NULL;
        }

         static function getIngredients ($i) {

            global $connection;
            $req="select * from INGREDIENTS where Ingredients=$i;";
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

        static function getPrix ($i) {

            global $connection;
            $req="select * from INGREDIENTS where Prix=$i;";
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
	


?>