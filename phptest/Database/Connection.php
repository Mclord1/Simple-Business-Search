<?php

class Connection
{
	
	public static function make($db)
	{
		try{
			return new PDO(
				$db['connection'].';dbname='.$db['name'],
				$db['user'],
				$db['password'],
				$db['options']
			);
		}
		catch(PDOException $e){
			die('Could not Connect: '.$e->getMessage());
		}
	}
}