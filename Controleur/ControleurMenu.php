<?php

	class controleurMenu {

		static $baseModule ="index.php?module=interfaceDeGestionDuRestaurant";



		static function controleur_liste_menu () {
			$liste_menu = ModeleMenu::getListeMenu();
			
			$data = self::prepareDataListe($liste_menu);
			$lien_ajout = self::$baseModule."&option=controleur_liste_menu";
			VuePersonnes::vue_liste($data, $lien_ajout);
		}




		static function prepareDataListe ($liste_menu)
		{
		//$data['lien_ajout'] = "index.php?option=ajout&id=$i";
			for ($i = 0; $i < count($liste_menu) ; $i++)
			{
				$id = $liste_menu[$i]->getNom();
	
				$data[$i]['nom'] = $liste_menu[$i]->getNom();
				$data[$i]['ingredients'] = $liste_menu[$i]->getIngredientsMenu();
				$data[$i]['tmpPreparation'] = $liste_menu[$i]->getTmpPreparation();
				$data[$i]['prix'] = $liste_menu[$i]->getPrix();
				
			}
			return $data;
		}





	}		




?>