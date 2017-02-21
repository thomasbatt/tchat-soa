<?php
class MessageManager
{
	// Déclarer les propriétés
	private $db;

	// Constructeur
	public function __construct($db)
	{
		$this->db = $db;
	}
	/**
    * @soap
    */
	public function getById($Id)
	{
		$Id = intval($Id);
		$query = "SELECT * FROM message WHERE id_message=".$Id;
		$res = $this->db->query($query);
		if ($res)
		{
			$message = $res->fetchObject("Message", [$this->db]);
			if ($message)
				return $message;
			else
				throw new Exception("Id message incorrect");
		}
		else
			throw new Exception("Erreur interne");
	}
	/**
    * @soap
    */
	public function create($idUser, $content)
	{
		$message = new Message($this->db);
		$message->setUser($idUser);
		try
		{
			$message->setContent($content);
			// return $message;
			// exit;
		}
		catch (Exception $e)
		{
			$errorinput = $e; 	
		}
		if( !isset($errorinput) )
		{
			$IdUser = intval($message->getUser()->getId());
			$content = $this->db->quote($message->getContent());
			// var_dump($message);
			$query = "INSERT INTO message (idUser_message, content_message) VALUES('".$IdUser."',".$content.")";
			// var_dump($query);
			// exit;
			try
			{
				$res = $this->db->exec($query);
			}
			catch (Exception $e)
			{
				throw new Exception("Erreur interne");
			}
		}
	}
	/**
    * @soap
    */
 	public function getAll($limit)
 	{
 		$limit = intval($limit);
 		$query = "SELECT * FROM message ORDER BY create_message DESC LIMIT $limit ";
 		$res = $this->db->query($query);
 		try
		{
 			while ( $message = $res->fetchObject("Message", [$this->db]) )
				$messages [] = $message;
			return $messages;
		}
		catch (Exception $e)
		{
			throw new Exception("Erreur interne");
		}
 	}

}
?>