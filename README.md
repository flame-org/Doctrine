Doctrine
========

Collection of classes for working with Doctrine2 on Flame framework

##Instalation

1. Add require into the composer.json

	"require": {
		"flame/doctrine": "@dev"
	}

2. Install dependencies
	
	composer install/update

3. Register **doctrine** extension into the bootstrap.php
	
	$configurator = new Flame\Config\Configurator;
	$configurator->registerExtension('doctrine', '\Flame\Doctrine\Config\Extension');

or

	$configurator = new Nette\Config\Configurator;
	$configurator->onCompile[] = function ($configurator, $compiler) {
			$compiler->addExtension('doctrine', new \Flame\Doctrine\Config\Extension);
		};