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
	public function select($table, $parameters)
	{
		$sql = "SELECT * FROM {$table} WHERE ";

		$cols = array_keys($parameters);

		for ($i=0; $i < count($cols); $i++) { 
			if($i != count($cols)-1){
				$sql = $sql.$cols[$i]." = :".$cols[$i].' AND';
			}else{
				$sql = $sql.$cols[$i]." = :".$cols[$i];
			}
		}

		try {
			
			$query = $this->pdo->prepare($sql);

			$query->execute($parameter);

			return $query->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) {
			
			die('Oops!! Something went wrong while trying to select');

		}


	}
	public function selectClass($table,$class,$limit=null)
	{
		if($limit == null){
			$query = $this->pdo->prepare("select * from {$table}");

			$query->execute();

			return $query->fetchAll(PDO::FETCH_OBJ);
		}
		else{
			$query = $this->pdo->prepare("select * from {$table} limit {$limit}");

			$query->execute();

			return $query->fetchAll(PDO::FETCH_CLASS, $class);
		}
	}
	public function insert($table, $parameters)
	{
		$sql = sprintf(
			'INSERT INTO %s (%s) VALUES (%s)',
			$table,
			implode(',', array_keys($parameters)),
			':'.implode(', :', array_keys($parameters))
			);
		try {
			$query = $this->pdo->prepare($sql);

			$query->execute($parameters);

			return $this->find($table, 'id',$this->pdo->lastInsertId());

		} catch (Exception $e) {

			die("OOPS!! Something went wrong while inserting: ". $e->getMessage());
		}
		
	}
	public function update($table, $parameters,$id)
	{
		$sql = "UPDATE {$table} SET ";

		$cols = array_keys($parameters);

		for ($i=0; $i < count($cols); $i++) { 
			if($i != count($cols)-1){
				$sql = $sql.$cols[$i]." = :".$cols[$i].',';
			}else{
				$sql = $sql.$cols[$i]." = :".$cols[$i];
			}
		}
		$sql = $sql." WHERE id = {$id}";
		try {
			$query = $this->pdo->prepare($sql);
		
			$update = $query->execute($parameters);

			if($update = true){

				return true;
			}
			else
				return false;
			
		} catch (Exception $e) {
			die('Whoops!! Something went wrong with the update: '.$e->getMessage());
		}

	}
	//get a instace of a unique key in a table
	public function find($table, $col, $val)
	{
		$sql = sprintf(
			'select * from %s where %s = %s',
			$table,$col,$val);
		try {

			$query = $this->pdo->prepare($sql);
			
			$query->execute();
			
			return $query->fetch(PDO::FETCH_OBJ);
			
		} catch (Exception $e) {
			die('OOPS!! Something went wrong while trying to find'.$e->getMessage());
		}

	}

	#get all instances of a resource
	public function get($table, $col, $value)
	{
		$query = $this->pdo->prepare("select * from {$table} WHERE {$col} = '{$value}'");

		$query->execute();

		return $query->fetchAll(PDO::FETCH_OBJ);
	}

	public function delete($table, $parameters)
	{
		$sql = "DELETE FROM {$table} WHERE ";

		$cols = array_keys($parameters);

		for ($i=0; $i < count($cols); $i++) { 
			if($i != count($cols)-1){
				$sql = $sql.$cols[$i]." = :".$cols[$i].' AND ';
			}else{
				$sql = $sql.$cols[$i]." = :".$cols[$i];
			}
		}
		try {

			$query = $this->pdo->prepare($sql);
			
			$query->execute($parameters);
			
			return $query;
			
		} catch (Exception $e) {
			
			die('OOPS!! Something went wrong while removing this record'.$e->getMessage());
		}


	}
	public function detach_and_attach($table,$col1_val,$col1,$col2,$array)
	{
		//check is recoreds matching these exist
		$exists = $this->find($table,$col1,$col1_val);

		if($exists){
			//delete records not matching the updated one
			$delete_query = sprintf(
				"DELETE FROM %s WHERE %s = %s AND %s NOT IN (%s)",
				$table,$col1,$col1_id,$col2,
				implode(',', $array)
				);
			try {
				$query = $this->pdo->prepare($delete_query);

				$query->execute();			
				
			} catch (Exception $e) {

				die("Something went wrong with the delete statement".$e->getMessage());
			}
			
			//insert the new records
			foreach($array as $key => $col2_val){
				$insert_query = sprintf(
					"INSERT INTO %s (%s,%s) VALUES (%s,%s) ON DUPLICATE KEY UPDATE id = id",
					$table, $col1, $col2, $col1_val,$col2_val
					);
				try {

					$insert = $this->pdo->prepare($insert_query);

					$insert->execute();

				} catch (Exception $e) {
					
					die('Oops!! Something went wrong with the attach: '.$e->getMessage());
				}
			}
		}
		else{
			//insert the new records
			foreach($array as $key => $col2_val){
				$insert_query = sprintf(
					"INSERT INTO %s (%s,%s) VALUES (%s,%s) ON DUPLICATE KEY UPDATE id = id",
					$table, $col1, $col2, $col1_val,$col2_val
					);
				try {

					$insert = $this->pdo->prepare($insert_query);

					$insert->execute();

				} catch (Exception $e) {
					
					die('Oops!! Something went wrong with the attach: '.$e->getMessage());
				}
			}
		}
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

	public function logView($table,$foreign_column,$id)
	{
		$find = $this->find($table, 'id', $id);
		if($find){			
			$check = $this->find($table.'_views',$foreign_column,$id);
			if($check){
				$query = $this->pdo->prepare(
					"UPDATE {$table}_views set views = views +1 where {$foreign_column} = {$id}"
				);
			}
			else{				
				$query = $this->pdo->prepare(
					"INSERT INTO {$table}_views ({$foreign_column}, views) VALUES ({$id}, 1)"
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
			"SELECT  business_id, name, views 
				FROM businesses_views
   				INNER JOIN businesses
   				ON businesses.id = businesses_views.business_id"
		);
		$query->execute();

		return $query->fetchAll(PDO::FETCH_OBJ);
	}
	public function test(){
		$answer = $this->get('categories','name','dentist');
		return $answer;
	}
	public function getCategories($id){
		$query = $this->pdo->prepare(
			"SELECT  business_id, name
				FROM businesses_categories
   				INNER JOIN categories
   				ON categories.id = businesses_categories.category_id
   				WHERE business_id = {$id}"
		);
		$query->execute();

		return $query->fetchAll(PDO::FETCH_CLASS, 'Category');
	}
}