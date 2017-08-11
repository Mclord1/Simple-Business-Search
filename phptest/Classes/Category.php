<?php
class Category
{
	protected $name;

	public function __construct($name)
	{
		$this->name = $name;
	}
	public function name()
	{
		return $this->name;
	}
}
