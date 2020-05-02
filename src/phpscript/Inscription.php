<?php
	// Traitement de : formulaire 
	//
	if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['pass']) && !empty($_POST['mail']) && !empty($_POST['clan_name'])) {
		extract($_POST);
		
		$user = new User($_POST['login'], $_POST['pass'], $_POST['mail'], $_POST['clan_name'], 
						 $_POST['postal_code'], $_POST['town'], $_POST['country'], $_POST['description'], 
						 $_POST['quotation']);
		
		if (UserDB::insert($user))
			$_POST['valid'] = true;

		if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0)		
			move_uploaded_file($_FILES['avatar']['tmp_name'], './images/avatar/' . $user->login . '.jpg');
	}
	
	// Traitement de la confirmation d'inscription
	//
	if(isset($_GET["log"]) && isset($_GET["confirm_key"])) {
		$result = UserDB::confirmInscription($_GET["log"], $_GET["confirm_key"]);
		if ($result == 1)
			$_POST['confirmation'] = true;
		else
		if ($result == 0)
			$_POST['already'] = true;
		else
		if ($result == -1)
			$_POST['bad_log'] = true;
		else
		if ($result == -2)
			$_POST['bad_key'] = true;
	}
?>