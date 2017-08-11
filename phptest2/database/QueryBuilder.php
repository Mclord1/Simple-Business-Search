<?php

class QueryBuilder
{
	protected $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	#get all from $table fetch as object of $class
	public function selectAll($table,$limit=null)
	{
		if($limit == null){
			$query = $this->pdo->prepare("select * from {$table}");

			$query->execute();

			return $query->fetchAll(PDO::FETCH_OBJ);
		}
		else{
			$query = $this->pdo->prepare("select * from {$table} limit {$limit}");

			$query->execute();

			return $query->fetchAll(PDO::FETCH_OBJ);
		}
	}
	public function insertAll($table, $cols,$values)
	{
		$sql = "INSERT INTO {$table} (";

		$countCol = count($cols);
		$countVal = count($values);

		for ($i=0; $i < $countCol; $i++) { 
			if($i != $countCol-1){
				$sql = $sql."$cols[$i],";
			}else{
				$sql = $sql."$cols[$i]";
			}
		}
		$sql = $sql.") VALUES (";
		for ($i=0; $i < $countVal; $i++) { 
			if($i != $countVal-1){
				$sql = $sql."'$values[$i]',";
			}else{
				$sql = $sql."'$values[$i]'";
			}
		}
		$sql = $sql.")";
		$query = $this->pdo->prepare($sql);
		
		$query->execute();

		return $query;
	}
	public function searchWhere($table,$string)
	{
		$searchInput = explode(" ",$string);

		$count = count($searchInput);

		$sql = "SELECT * FROM {$table} WHERE";                     

		for($i = 0;$i < $count;$i++)
		{
		    if($i != $count-1)
		        $sql = $sql.
		        " (name LIKE '%$searchInput[$i]%' OR
		          description LIKE '%$searchInput[$i]%') AND ";
		    else
		        $sql = $sql.
		        " (name LIKE '%$searchInput[$i]%' OR
		          description LIKE '%$searchInput[$i]%')";
		} 
		$query = $this->pdo->prepare($sql);

		$query->execute();

		return $query->fetchAll(PDO::FETCH_OBJ);
	}
	public function get($table, $col, $value)
	{
		$query = $this->pdo->prepare("select * from {$table} WHERE {$col} = '{$value}'");

		$query->execute();

		return $query->fetch(PDO::FETCH_OBJ);
	}
	public function getMany($table, $col, $value){
		$query = $this->pdo->prepare("select * from {$table} WHERE {$col} = '{$value}'");

		$query->execute();

		return $query->fetchAll(PDO::FETCH_OBJ);
	}
	public function logView($id)
	{
		$com = $this->pdo->prepare("select * from companies WHERE id = {$id}");

		$com->execute();

		$find = $com->fetch(PDO::FETCH_OBJ);
		if($find){			
			$select = $this->pdo->prepare("select exists(select * from businesses_views where company_id = {$id})");

			$check = $select->execute();


			if($check){
				$query = $this->pdo->prepare(
					"UPDATE businesses_views set views = views +1 where company_id = {$id}"
				);
			}
			else{				
				$query = $this->pdo->prepare(
					"INSERT INTO businesses_views (company_id, views) VALUES ({$id}, 1)"
				);
			}
			$up = $query->execute();
		}
	}
	public function auth($username,$password)
	{
		$check = $this->pdo->prepare("select * from users where username = '{$username}'");

		$check->execute();

		$pass = $check->fetch(PDO::FETCH_OBJ);

		if($pass && password_verify($password, $pass->password))
		{
			return $pass;

		}else{

			return false;

		}

	}
	public function isAdmin()
	{
		if(isset($_SESSION['auth']))
		{
			$auth = $_SESSION['auth'];
			$check = $this->pdo->prepare("select * from users where username = '{$auth->username}'");

			$check->execute();

			$pass = $check->fetch(PDO::FETCH_OBJ);
			if ($pass) {
				return true;
			}else{
				return false;
			}
		}
		return false;
	}

	public function regAdmin($user,$mail, $pass)
	{
		$username = mysqli_escape_string($user);

		$email = mysqli_escape_string($mail);

		$password = crypt($pass);

		$query = $this->pdo->prepare(
			"INSERT INTO users (username,email,password) VALUES ('{$username}','{$email}','{$password}')"
			);

		$query->execute();

		if($query == true)
			echo 'true';

		else
			echo 'false';

	}
	public function getALlViews()
	{
		$query = $this->pdo->prepare(
			"SELECT  company_id, name, views 
				FROM businesses_views
   				INNER JOIN companies
   				ON companies.id = businesses_views.company_id"
		);
		$query->execute();

		return $query->fetchAll(PDO::FETCH_OBJ);
	}
	public function test(){
		$answer = $this->get('categories','name','dentist');
		return $answer;
	}
}