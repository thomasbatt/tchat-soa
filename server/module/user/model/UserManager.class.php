<?php
class UserManager
{
	// Déclarer les propriétés
	private $db;
    public $myvar1;
	public $myvar2;	


	// Constructeur
	public function __construct()
	{
		// $this->db = $db;
	 	$this->__wakeup(); // On appelle notre wakeup pour relancer notre ressource
	}

	public function __wakeup() {
		// $this->db = $db;
	 	// $this->resource = CodeToStartOurResourceUp();
	 	$config = [
			'host' => 'localhost',
			'port' => '3306',
			'login' => 'root',
			'password' => 'coworking',
			'bdd' => 'tchat',
		];
 		try
		{
		    $this->db = new PDO('mysql:dbname='.$config['bdd'].';host='.$config['host'], $config['login'], $config['password']);
		}
		catch (PDOException $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	public function __sleep() {
		 // On s'assure d'enlever $resource ici, ainsi nos données peuvent persister en session
		 // Si on oublie, la désérialisation lors de la prochaine requête échouera et notre objet
		 // SoapObject ne sera donc pas persistant entre les requêtes.
		 return array('myvar1','myvar2');
		 // return NULL;
	}
	/**
    * @soap
    * @param string
    * @return object
    */
	public function getByLogin($login)
	{
		$login = $this->db->quote($login);
		$query = "SELECT * FROM user WHERE login_user=".$login;
		$res = $this->db->query($query);
		if ($res)
		{
			$user = $res->fetchObject("User");
			if ($user)
				return $user;
			else
				throw new Exception("Login incorrect");
		}
		else
			throw new Exception("Erreur interne");
	}
	/**
    * @soap
    * @param integer
    * @return object
    */
	public function getById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM user WHERE id_user=".$id;
		$res = $this->db->query($query);
		if ($res)
		{
			$user = $res->fetchObject("User");
			if ($user)
				return $user;
			else
				throw new Exception("id incorrect");
		}
		else
			throw new Exception("Erreur interne");
	}
	/**
    * @soap
    * @param string
    * @param string
    * @param string
    * @return object
    */
	public function create($login, $pass1, $pass2)
	{
		$user = new User();
		$user->setLogin($login);
		$user->initPassword($pass1, $pass2);
		$user->setColor("#".dechex(rand(0,255)) . dechex(rand(0,255)) . dechex(rand(0,255)) );
		$login = $this->db->quote($user->getLogin());
		$hash = $this->db->quote($user->getHash());
		$color = $this->db->quote($user->getColor());
		$query = "INSERT INTO user (login_user, hash_user, color_user) VALUES(".$login.",".$hash.",".$color.")";
		try
		{
			$res = $this->db->exec($query);
		}
		catch (Exception $e)
		{
			throw new Exception("Erreur interne");
		}
		return $this->getByLogin($user->getLogin());
	}
	/**
    * @soap
    * @param integer
    * @return object
    */
 	public function getAll()
 	{
 		$query = "SELECT * FROM user ORDER BY update_user DESC, login_user ASC";
 		$res = $this->db->query($query);
 		try
		{
 			while ( $user = $res->fetchObject("User") )
				$users [] = $user;
			return $users;
		}
		catch (Exception $e)
		{
			throw new Exception("Erreur interne");
		}
 	}
	/**
    * @soap
    * @param integer
    * @return boolean
    */
 	public function isConnected($id)
 	{
 		$idVerif = intval($id);
 		$query = "SELECT login_user FROM user 
 					WHERE update_user > CURRENT_TIMESTAMP - 5 AND id_user = '".$idVerif."'";
 		$res = $this->db->query($query);
 		$count = $res->rowCount();
 		if ($count == 0) 
 			return FALSE;
 		else
 			return TRUE;
 	}
	/**
    * @soap
    * @param integer
    * @return object
    */
 	public function upDateConnected($id)
 	{
 		// $time = time();
 		$query = "UPDATE user 
 					SET update_user=CURRENT_TIMESTAMP 
 					WHERE id_user = '".$id."'";
 		$res = $this->db->exec($query);
 	}

}
?>