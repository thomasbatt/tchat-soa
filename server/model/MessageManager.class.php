<?php
class MessageManager extends ConnectionDB
{
	// Déclarer les propriétés
	private $dbConfig;

	public function __construct(array $dbConfig)
	{
		$this->dbConfig = $dbConfig;
		parent::__construct($this->dbConfig);
	}


	/**
    * @soap
    * @param integer
    * @return object
    */
	public function getById($Id)
	{
		$Id = intval($Id);
		$query = "SELECT * FROM message WHERE id_message=".$Id;
		$res = $this->db->query($query);
		if ($res)
		{
			$message = $res->fetchObject("Message", [$this->dbConfig]);
			if ($message)
				return $message;
			else
				throw SoapFault("Message: ", "Id message incorrect");
		}
		else
			throw SoapFault("Message: ", "Erreur interne");
	}
	/**
    * @soap
    * @param integer
    * @param string
    * @return object
    */
	public function create($idUser, $content)
	{
		$message = new Message($this->dbConfig);
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
				throw SoapFault("Message: ", "Erreur interne");
			}
		}
	}
	/**
    * @soap
    * @param integer
    * @return object
    */
 	public function getAll($limit)
 	{
 		$limit = intval($limit);
 		$query = "SELECT * FROM message ORDER BY create_message DESC LIMIT $limit ";
 		$res = $this->db->query($query);
 		try
		{
 			while ( $message = $res->fetchObject("Message", [$this->dbConfig]) )
				$messages [] = $message;
			return $messages;
		}
		catch (Exception $e)
		{
			throw SoapFault("Message: ", "Erreur interne");
		}
 	}

}
?>