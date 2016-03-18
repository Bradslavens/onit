<?php

require 'vendor/autoload.php';

class TestUser extends PHPUnit_Framework_TestCase
{
	function testCreateUser() 
	{
		$user = new User_model;

		$this->assertEquals(4, $user->add(2,2));
	}
}