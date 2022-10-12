<?php
class Dbh
{
	private $host;
	private $user;
	private $pwd;
	private $dbname;

	protected function connect()
	{
		$this->host = "localhost";
		$this->user = "u289533873_mikeka";
		$this->pwd = "8085@Must.Upie";
		$this->dbname = "u289533873_chomora";
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		$pdo =  new PDO($dsn, $this->user, $this->pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		if (!$pdo) {
			$this->host = "localhost";
			$this->user = "root";
			$this->pwd = "";
			$this->dbname = "chomora";
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
			$pdo =  new PDO($dsn, $this->user, $this->pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

			return $pdo;
		} else {
			return $pdo;
		}
	}
}
