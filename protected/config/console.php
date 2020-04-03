<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	//'preload'=>array('log'),
		
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
	),

	// application components
	'components'=>array(
		
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=172.18.0.155;dbname=commart',
			'emulatePrepare' => true,
			'username' => 'jib999',
			'password' => 'jibxtranet999*',
			'charset' => 'utf8',
		),
		'db2'=>array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=172.18.0.155;dbname=commart-sticker',
			'emulatePrepare' => true,
			'username' => 'jib999',
			'password' => 'jibxtranet999*',
			'charset' => 'utf8',
			),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);