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

    /**
    * @soap
    * @param NULL
    * @return integer
    */
	public function getId() {
		return $this->id_user; // On récupère la propriété id_user de $this
	}
	/**
    * @soap
    * @param NULL
    * @return string
    */
	public function getLogin() {
		return $this->login_user;
	}
	/**
    * @soap
    * @param NULL
    * @return string
    */	/**
    * @soap
    * @param NULL
    * @return string
    */
	public function getHash()
	{
		return $this->hash_user;
	}
	/**
    * @soap
    * @param NULL
    * @return string
    */
	public function getColor()
	{
		return $this->color_user;
	}
	/**
    * @soap
    * @param NULL
    * @return string
    */
	public function getCreateDate() {
		return $this->create_user;
	}
	/**
    * @soap
    * @param NULL
    * @return string
    */
	public function getUpdate() {
		return $this->update_user;
	}
	/**
    * @soap
    * @param NULL
    * @return boolean
    */
	public function isAdmin() { // Un getter d'un booleen transforme le get en is
		return $this->isAdmin_user;
	}

	// --------------------Liste des setters-------------------------------
	/**
    * @soap
    * @param integer
    * @return object
    */
	public function setLogin($login) {
		if (strlen($login) > 3 && strlen($login) < 31) {
			$this->login_user = $login;
		}
	}
	/**
    * @soap
    * @param string
    * @return object
    */
	public function setColor($color) {
		if (strlen($color) == 7) {
			$this->color_user = $color;
		}
	}
	/**
    * @soap
    * @param integer
    * @return object
    */
	public function setUpdate($date) {
		if ($date > time() ) {
			$this->update_user = $date;
		}
	}
	/**
    * @soap
    * @param string
    * @return object
    */
	public function setAdmin($admin) {
		// methode 1
		if ($admin === true || $admin === false) {
			$this->admin_user = $admin;
		}
		// ou methode 2
		$this->admin_user = (bool)$admin; // (bool) permet de "caster" une variable en un type particulier, transformer n'importe quel type en booleen (ici)
	}

	// --------------------Liste des méthodes "autres"---------------------
	/**
    * @soap
    * @param object
    * @return object
    */
	public function hydrate($data)
	{
		foreach ($data as $property => $value)
		{
			if (property_exists($this, $property) ) 
			{
				$this->$property = $value;
			}
		}
	  return $this;
	}

	// --------------------verifier password ?---------------------
	/**
    * @soap
    * @param string
    * @return object
    */
	public function verifPassword($password)
	{
		if (!password_verify($password, $this->hash_user)){
			throw new SoapFault("User: ", "Mot de passe incorrect");
			// throw new Exception("Mot de passe incorrect");
		}
	}

	// --------------------modifier password ?---------------------
	/**
    * @soap
    * @param string
    * @param string
    * @param string
    * @return object
    */
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
					throw new SoapFault("User: ", "Ancien mot de passe incorrect");
			}
			else
				throw new SoapFault("User: ", "Mot de passe est trop court (< 6 caractères)");
		}
		else
			throw new SoapFault("User: ", "Les deux mots de passes ne correspondent");
	}

	/**
    * @soap
    * @param string
    * @param string
    * @return object
    */
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
					throw new SoapFault("User: ", "Mot de passe est trop court (< 6 caractères)");
			}
			else
				throw new SoapFault("User: ", "Les deux mots de passes ne correspondent");
		}
		else
			throw new SoapFault("User: ", "Impossible d'initialiser un mot de passe une seconde fois");
	}
}

?>