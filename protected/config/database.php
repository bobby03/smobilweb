<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	
	'connectionString' => 'mysql:host=158.97.91.139;dbname=movsens',
	 // 'connectionString' => 'mysql:host=localhost;dbname=movsens',
        'username' => 'smobile_user',
 	'password' => 'm0b1l3',
//	 'username' => 'root',
//	 'password' => 'hola',
//	  'username' => 'root',
//	  'password' => '',
	 'emulatePrepare' => true,
	'charset' => 'utf8',
	
);