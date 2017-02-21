<?php
// PascalCase pour le nom des classes
// camelCase pour le nom des variables
class User 
{
// ------------------------ Déclarer les propriétés-----------------------
	private $id_user;
	private $login_user;
	private $hash_user;
	private $color_user;
	private $create_user;
	private $update_user;
	private $isAdmin_user;
	
// ------------------------Déclarer les méthodes--------------------------

	// --------------------Liste des getters------------------------------

	public function getId() {
		return $this->id_user; // On récupère la propriété id_user de $this
	}

	public function getLogin() {
		return $this->login_user;
	}

	public function getHash()
	{
		return $this->hash_user;
	}

	public function getColor()
	{
		return $this->color_user;
	}

	public function getCreateDate() {
		return $this->create_user;
	}

	public function getUpdate() {
		return $this->update_user;
	}

	public function isAdmin() { // Un getter d'un booleen transforme le get en is
		return $this->isAdmin_user;
	}

	// --------------------Liste des setters-------------------------------
	public function setLogin($login) {
		if (strlen($login) > 3 && strlen($login) < 31) {
			$this->login_user = $login;
		}
	}

	public function setColor($color) {
		if (strlen($color) == 7) {
			$this->color_user = $color;
		}
	}

	public function setUpdate($date) {
		if ($date > time() ) {
			$this->update_user = $date;
		}
	}

	public function setAdmin($admin) {
		// methode 1
		if ($admin === true || $admin === false) {
			$this->admin_user = $admin;
		}
		// ou methode 2
		$this->admin_user = (bool)$admin; // (bool) permet de "caster" une variable en un type particulier, transformer n'importe quel type en booleen (ici)
	}

	// --------------------Liste des méthodes "autres"---------------------

	// --------------------verifier password ?---------------------
	public function verifPassword($password)
	{
		if (!password_verify($password, $this->hash_user))
			throw new Exception("Mot de passe incorrect");
	}

	// --------------------modifier password ?---------------------
	public function editPassword($oldPassword, $newPassword1, $newPassword2)
	{
		if ($newPassword1 === $newPassword2)
		{
			$newPassword = $newPassword1;
			if (strlen($newPassword) > 5)
			{
				if ($this->verifPassword($oldPassword))
				{
					$this->hash_user = password_hash($newPassword, PASSWORD_BCRYPT, ["cost"=>12]);
				}
				else
					throw new Exception("Ancien mot de passe incorrect");
			}
			else
				throw new Exception("Mot de passe est trop court (< 6 caractères)");
		}
		else
			throw new Exception("Les deux mots de passes ne correspondent");
	}

	public function initPassword($newPassword1, $newPassword2)
	{
		if ($this->hash_user == null)
		{
			if ($newPassword1 === $newPassword2)
			{
				$newPassword = $newPassword1;
				if (strlen($newPassword) > 5)
				{
					$this->hash_user = password_hash($newPassword, PASSWORD_BCRYPT, ["cost"=>12]);
				}
				else
					throw new Exception("Mot de passe est trop court (< 6 caractères)");
			}
			else
				throw new Exception("Les deux mots de passes ne correspondent");
		}
		else
			throw new Exception("Impossible d'initialiser un mot de passe une seconde fois");
	}
}

// Tout ça n'a rien a foutre dans le fichier User.class.php, mais c'est plus pratique pour apprendre

// ------------------------------------------------------------------------
// --------------------On va INSTANCIER notre classe User------------------
// --------------------$user => objet--------------------------------------
// --------------------User => classe--------------------------------------
// --------------------Un objet est une instance d'une classe--------------
// ------------------------------------------------------------------------

// $user = new User();
// $user->setLogin("toto");
// $user->initPassword("password", "password");

// var_dump($user);


?>