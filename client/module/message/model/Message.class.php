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
	}
	
// ------------------------Déclarer les méthodes--------------------------

	// --------------------Liste des getters------------------------------

	public function getId() {
		return $this->id_message; // On récupère la propriété id_message de $this
	}

	public function getUser() {
		if ($this->user == null)
		{
			$manager = new UserManager($this->db);
			$this->user = $manager->getById($this->idUser_message);
		}
		return $this->user;
	}

	public function getContentLinkHtmlentities(){
		return $this->content_message;

		// $link = eregi_replace(
		// 	"( http|mailto|news|ftp|https)://(([-éa-z0-9\/\.\?_=@:~])*)",
		// 	"<a onclick=\"window.open(this.href); return false;\" href=\"\\1://\\2\">\\1://\\2</a>",
		//     " ".str_replace("&", "é", htmlentities($this->content_message) )
		// );
		// $link = strtr ($link, array_flip ( get_html_translation_table(HTML_ENTITIES) ) );

		// return $link;
	}

	public function getContent(){
		return $this->content_message;
	}

	public function getCreateDate() {
		return $this->create_message;
	}

	// --------------------Liste des setters-------------------------------
	public function setUser(User $user) {
		$this->idUser_message = $user->getId();
		$this->user = $user;
	}

	public function setContent($content) {
		if (strlen($content) > 1 && strlen($content) < 1023) {
			$this->content_message = $content;
		}
		else
			throw new Exception("erreur content");
	}
	// --------------------Liste des méthodes "autres"---------------------

	// --------------------verifier password ?---------------------

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