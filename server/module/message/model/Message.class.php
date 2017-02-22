<?php
// PascalCase pour le nom des classes
// camelCase pour le nom des variables
class Message
{
// ------------------------ Déclarer les propriétés-----------------------
	private $id_message;
	private $idUser_message;
	private $user;// valeur calculée -> composition
	private $content_message;
	private $create_message;
	private $db;

	// Constructeur
	public function __construct($db)
	{
		$this->db = $db;
		$this->setUser($this->idUser_message);
		$this->getContentLinkHtmlentities();
	}
	
// ------------------------Déclarer les méthodes--------------------------

	// --------------------Liste des getters------------------------------
	/**
    * @soap
    * @param NULL
    * @return integer 
    */
	public function getId() {
		return $this->id_message; // On récupère la propriété id_message de $this
	}
	/**
    * @soap
    * @param NULL
    * @return object 
    */
	public function getUser() {
		if ($this->user == null)
		{
			$manager = new UserManager($this->db);
			$this->user = $manager->getById($this->idUser_message);
		}
		return $this->user;
	}

	/**
    * @soap
    * @param NULL
    * @return string 
    */
	public function getContentLinkHtmlentities(){
		if( $this->content_message !== null){
			$this->content_message = preg_replace('/(http[s]{0,1}\:\/\/\S{4,})\s{0,}/ims', '<a href="$1" target="_blank">$1</a> ', $this->content_message);
		}

		return $this->content_message;
		
	}
	/**
    * @soap
    * @param NULL
    * @return string 
    */
	public function getContent(){
		return $this->content_message;
	}
	/**
    * @soap
    * @param NULL
    * @return integer 
    */
	public function getCreateDate() {
		return $this->create_message;
	}

	// --------------------Liste des setters-------------------------------
	/**
    * @soap
    * @param integer
    * @return string 
    */
	public function setUser($idUser) {
		if( isset($idUser) ){
			$manager = new UserManager($this->db);
			$this->user = $manager->getById($idUser);
		}
	}
	/**
    * @soap
    * @param string
    * @return string 
    */
	public function setContent($content) {
		if (strlen($content) > 1 && strlen($content) < 1023) {
			$this->content_message = $content;
		}
		else
			throw new Exception("erreur content");
	}


	// --------------------Liste des méthodes "autres"---------------------

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