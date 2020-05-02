<?php
	abstract class UserDB {
        public static function insert(User $user) {			      
        	$resultat = mysql_query("INSERT INTO user (login,
												pass,
												clan_name,
												mail,
												postal_code,
												town,
												country,
												description,
												quotation
										 		)
							 			VALUES(	\"" . ucfirst($user->login) . "\", 
										 		\"" . $user->pass . "\", 
										 		\"" . $user->clan_name . "\", 
										 		\"" . $user->mail . "\",
										 		\"" . $user->postal_code . "\", 
										 		\"" . $user->town . "\",
										 		\"" . $user->country . "\", 
										 		\"" . $user->description . "\",
										 		\"" . $user->quotation . "\");");        	
        	        	
        	if ($resultat)
        		self::addKeyRegistration($user);
        	
        	return $resultat;
        }
        
		public static function update(User $user) {			      
			mysql_query("	UPDATE 	user 
        					SET 	pass = \"" . $user->pass . "\", 
									clan_name = \"" . $user->clan_name . "\",
									mail = \"" . $user->mail . "\",
									postal_code = \"" . $user->postal_code . "\",
									town = \"" . $user->town . "\",
									country = \"" . $user->country . "\",
									description = \"" . $user->description . "\",
									quotation = \"" . $user->quotation . "\"
							WHERE 	login = \"" . $user->login . "\";");
        }
        
       	private static function addKeyRegistration (User $user) {
			// Gnration alatoire d'une cl
			$confirm_key = md5(microtime(TRUE)*100000);
			
			// Insertion de la cl dans la base de donnes
			mysql_query("INSERT INTO valid_account (login,
													confirm_key
										 		   )
							 				VALUES ('" . ucfirst($user->login) . "', 
										 			'" . $confirm_key . "'
										 		   );");
				
        	// Prparation du mail contenant le lien d'activation
			$sujet = "[Hagrid's Magic Potions] Activation de votre compte";
     		$entete  = 'From: "Hagrid\'s Inscription"<inscription@HagridsMagicPotions.free.fr>'."\n"; 
     		$entete .= 'Reply-to: "no-reply"<no-reply@HagridsMagicPotions.free.fr>'."\n";
			$entete .= "Content-Type: text/html; charset=\"UTF-8\"; DelSp=\"Yes\"; format=flowed \r\n";
			$entete .= "Content-Disposition: inline \r\n";
			$entete .= "Content-Transfer-Encoding: 8bit \r\n";
			$entete .= "MIME-Version: 1.0";
			
			// Le lien d'activation est compos du login(log) et de la cl(cle)
			$message = "Bienvenue " . ucfirst($user->login) . ", sur Hagrid's Magic Potions,<br/><br/>".
			"Pour activer ton compte cliques sur le lien ci-dessous<br/>".
			"ou copies/colles le dans ton navigateur internet.<br/><br/>".
			"http://hagridsmagicpotions.free.fr/index.php?page=inscription&log=".urlencode(ucfirst($user->login))."&confirm_key=".urlencode($confirm_key)."<br/><br/><br/>".
			"---------------<br/><br/>" .
			"Ceci est un mail automatique, Merci de ne pas y r&eacute;pondre.<br/><br/>" .
			"Le Messager";
			
			$user->sendMail($sujet, $message, $entete);
       	}
       	
      	public static function confirmInscription($login, $confirm_key) {
      		$login = $login;
      		$confirm_key = $confirm_key;
      		      		
      		$result = mysql_query("	SELECT login, confirm_key, valid
      								FROM valid_account
      								WHERE login = '" . $login . "';");
      		
      		$data = mysql_fetch_assoc($result);
      		
			if(!empty($data["login"]))
				if($data["confirm_key"] == $confirm_key) {
					if($data['valid'] == "1") return 0;
										
						mysql_query("	UPDATE valid_account
      									SET valid = '1'
      									WHERE login = '" . $login . "';");
												
					 	$user = self::getUser($login);
					 
					 	$sujet = "[Hagrid's Magic Potions] Confirmation d'inscription";
					 	$entete  = 'From: "Hagrid\'s Inscription"<inscription@HagridsMagicPotions.free.fr>'."\n"; 
			     		$entete .= 'Reply-to: "no-reply"<no-reply@HagridsMagicPotions.free.fr>'."\n";
						$entete .= "Content-Type: text/html; charset=\"UTF-8\"; DelSp=\"Yes\"; format=flowed \r\n";
						$entete .= "Content-Disposition: inline \r\n";
						$entete .= "Content-Transfer-Encoding: 8bit \r\n";
						$entete .= "MIME-Version: 1.0";
					 
					 	$message = "Bienvenue ".$user->login.", dans la communaut&eacute; des " . $user->clan_name . "s,<br/><br/>".
								   "Ton inscription vient d'&ecirc;tre valid&eacute;e par le grand Hagrid lui-m&ecirc;me.<br/>".
								   "Il a enregistr&eacute; ton mot de passe : ". $user->pass . "<br/><br/>" .
								   "Profites de sa g&eacute;n&eacute;rosit&eacute; pour venir poster une superbe recette de potion.<br/><br/><br/>".
								   "---------------<br/>" .
								   "Ceci est un mail automatique, Merci de ne pas y r&eacute;pondre.<br/><br/>" .
								   "Le Messager";
					 
					$user->sendMail($sujet, $message, $entete);
					 			   	
			   		return 1;
			 	}
			  	// Cle invalide
				else return -2;
			// Login inexistant
			else return -1;
      	}
        
		public static function getRank(User $user) {
			$result = mysql_query("SELECT *
								FROM user U, clan C
								WHERE U.login = '" . $user->login . "'".
								"AND U.level = C.level
								AND U.clan_name = C.clan_name;");
			
			$data = mysql_fetch_assoc($result);			
			
			return $data['rank_name'];
		}
		
		public static function getUser($login) {
			if ($login == null || $login == "") return -1;
						
			$result = mysql_query("	SELECT *
						 			FROM user
						 			WHERE login = '" . $login . "';");
			
			$data = mysql_fetch_assoc($result);
												
			if(empty($data['login'])) return -1;
			if (self::getValid($login) == '0') return -1;
				
			$postal_code = empty($data['postal_code']) ? "" : $data['postal_code'];
			$town = empty($data['town']) ? "" : $data['town'];
			$country = empty($data['country']) ? "" : $data['country'];
   			$description = empty($data['description']) ? "" : $data['description'];
   			$quotation = empty($data['quotation']) ? "" : $data['quotation'];
			   					   		
			return new User($data['login'], $data['pass'], $data['mail'], $data['clan_name'], 
						 	$postal_code, $town, $country, $description, $quotation, $data['level']);			
		}
		
		public static function getValid($login) {			
			$result = mysql_query("	SELECT valid 
									FROM valid_account
      								WHERE login = '" . $login . "';");
					
			$data = mysql_fetch_assoc($result);
			
			return $data['valid'];
		}
		
		public static function sendPass($login, $mail) {
			$login = ucfirst(utf8_encode($login));
			$mail = utf8_encode($mail);
					
			$user = self::getUser($login);
			
			if ($user == -1) return -1;
 			if ($user->mail != $mail) return -2;
					 
		 	$sujet = "[Hagrid's Magic Potions] Recuperation de pass";
 			$entete  = 'From: "Hagrid\'s Lost Pass"<lost_pass@HagridsMagicPotions.free.fr>'."\n"; 
     		$entete .= 'Reply-to: "no-reply"<no-reply@HagridsMagicPotions.free.fr>'."\n";
			$entete .= "Content-Type: text/html; charset=\"UTF-8\"; DelSp=\"Yes\"; format=flowed \r\n";
			$entete .= "Content-Disposition: inline \r\n";
			$entete .= "Content-Transfer-Encoding: 8bit \r\n";
			$entete .= "MIME-Version: 1.0";
		 
		 	$message = "Bonjour ".$user->login.",<br/><br/>".
						"Voici ton mot de passe : " . $user->pass . "<br/>".
						"Tache de le garder en lieu sur.<br/><br/><br/>" .
						"---------------<br/>" .
						"Ceci est un mail automatique, Merci de ne pas y r&eacute;pondre.<br/><br/>" .
						"Le Messager";
		 
			$user->sendMail($sujet, $message, $entete);
		}
		
		public static function levelUp($login) {						
			
			$nbRecipe = RecipeDB::getNbRecipe($login);
			
			$nbStar = EvaluationDB::getStarSumByLogin($login);
			
			$totalExperience = $nbRecipe + $nbStar;
			
			$result = mysql_query("	SELECT * FROM experience;");
			
			$data = mysql_fetch_assoc($result);
		
			$level = 0;
			while($data = mysql_fetch_array($result))
				if ($totalExperience >= $data["experience"])
					$level = $data["level"];
					
			mysql_query("	UPDATE 	user 
        					SET 	level = \"" . $level . "\"
							WHERE 	login = \"" . $login . "\";");
			
			return $totalExperience + "  -  " + $level;
		}
    }
?>