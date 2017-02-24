<?php
class ConnectionDB {

	protected $db;
	protected $host ,$port, $login, $password, $bdd;

	// Constructeur
	public function __construct(array $dbConfig)
	{
		$this->hydrateProperty($dbConfig);
	 	$this->__wakeup(); // On appelle notre wakeup pour relancer notre ressource
	}

	public function __wakeup() 
	{
	 	$this->dbConnect();
	}

	public function __sleep() {
		 // On s'assure d'enlever $resource ici, ainsi nos données peuvent persister en session
		 // Si on oublie, la désérialisation lors de la prochaine requête échouera et notre objet
		 // SoapObject ne sera donc pas persistant entre les requêtes.
		 return array('host','port','login','password','bdd');
	}

	private function dbConnect()
	{
 		try{
		    $this->db = new PDO('mysql:dbname='.$this->bdd.';host='.$this->host, $this->login, $this->password);
		}
		catch (PDOException $e)
		{
			throw new SoapFault("ConnectionDB: ", $e->getMessage());
		}
	}

	private function hydrateProperty(array $data)
	{
	  foreach ($data as $key => $value)
	  {
	    if (property_exists($this, $key) && $key != 'db') 
	    {
	      $this->$key = $value;
	    }
	  }
	}
}
