<?php

	class ControleurIngredients {

		static $baseModule ="index.php?module=interfaceDeGestionDesIngredients";

		static function controleur_liste_ingredients () {
		$liste_personnes = ModelePersonnes::getListePersonnes();
		
		$data = self::prepareDataListe($liste_personnes);
		$lien_ajout = self::$baseModule."&option=controleur_ajout";
		VuePersonnes::vue_liste($data, $lien_ajout);
	}






		static function prepareDataListe ($liste_ingredients)
		{
			//$data['lien_ajout'] = "index.php?option=ajout&id=$i";
			for ($i = 0; $i < count($liste_ingredients) ; $i++)
			{
				$id = $liste_ingredients[$i]->getNom();
	
				$data[$i]['ingredients'] = $liste_ingredients[$i]->getNom();
				$data[$i]['prix'] = $liste_ingredients[$i]->getIngredients_Prix();
		
			}
			return $data;
		}

	}



?>