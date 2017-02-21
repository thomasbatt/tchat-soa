<?php
class Voiture
{
	public static $version = "2016";
	private static $invisible = "cachecache";
	private $moteur;

	public function __construct()
	{
		$this->moteur = "rotor";
	}
	public function getMoteur()
	{
		return $this->moteur;
	}
	public static function getInvisible()
	{
		return self::$invisible;
	}
}
class Tesla extends Voiture
{
	const TYPE = "electrique";
	private $model;

	public function __construct()
	{
		parent::__construct();
		$this->model = "S";
	}
}
$tesla = new Tesla();
echo $tesla->getMoteur();
echo '<br>';
echo Tesla::TYPE;
echo '<br>';
echo Voiture::$version;
echo '<br>';
echo Voiture::getInvisible();
echo '<br>';
echo Voiture::$invisible;
?>