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

	// Constructeur
	// public function __construct($data)
	// {
	// 	$this->hydrate($this->idUser_message);
	// 	$this->getContentLinkHtmlentities();
	// }


	// --------------------Liste des getters------------------------------

    /**
    * @soap
    */
	public function getId() {
		return $this->id_user; // On récupère la propriété id_user de $this
	}
	/**
    * @soap
    */
	public function getLogin() {
		return $this->login_user;
	}
	/**
    * @soap
    */	/**
    * @soap
    */
	public function getHash()
	{
		return $this->hash_user;
	}
	/**
    * @soap
    */
	public function getColor()
	{
		return $this->color_user;
	}
	/**
    * @soap
    */
	public function getCreateDate() {
		return $this->create_user;
	}
	/**
    * @soap
    */
	public function getUpdate() {
		return $this->update_user;
	}
	/**
    * @soap
    */
	public function isAdmin() { // Un getter d'un booleen transforme le get en is
		return $this->isAdmin_user;
	}

	// --------------------Liste des setters-------------------------------
	/**
    * @soap
    */
	public function setLogin($login) {
		if (strlen($login) > 3 && strlen($login) < 31) {
			$this->login_user = $login;
		}
	}
	/**
    * @soap
    */
	public function setColor($color) {
		if (strlen($color) == 7) {
			$this->color_user = $color;
		}
	}
	/**
    * @soap
    */
	public function setUpdate($date) {
		if ($date > time() ) {
			$this->update_user = $date;
		}
	}
	/**
    * @soap
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
    */
	public function hydrate(array $data)
	{
	  foreach ($data as $key => $value)
	  {
	    $method = 'set'.ucfirst($key);
	    $method = preg_replace("/_user/","",$method);
	    if (method_exists($this, $method)) 
	    {
	      $this->$method($value);
	    }
	  }
	  return $this;
	}

	// --------------------verifier password ?---------------------
	/**
    * @soap
    */
	public function verifPassword($password)
	{
		if (!password_verify($password, $this->hash_user))
			throw new Exception("Mot de passe incorrect");
	}

	// --------------------modifier password ?---------------------
	/**
    * @soap
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
					throw new Exception("Ancien mot de passe incorrect");
			}
			else
				throw new Exception("Mot de passe est trop court (< 6 caractères)");
		}
		else
			throw new Exception("Les deux mots de passes ne correspondent");
	}

	/**
    * @soap
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