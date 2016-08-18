<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	
	'connectionString' => 'mysql:host=localhost;dbname=movsens',
//	'emulatePrepare' => true,
	'username' => 'smobile_user',
	'password' => 'm0b1l3',
	 // 'connectionString' => 'mysql:host=localhost;dbname=movsens',
	 'emulatePrepare' => true,
//	 'username' => 'root',
//	 'password' => 'hola',
	 // 'username' => 'root',
	 // 'password' => '',
	'charset' => 'utf8',
	
);